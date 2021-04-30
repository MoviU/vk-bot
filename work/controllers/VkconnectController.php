<?php
namespace app\controllers;

use Yii;
use app\controllers\protect;
use app\models\User;
use app\models\Vkaccount;
use app\models\Vkgroups;

class VkconnectController extends BaseController{
    private const VERSION = '5.130';
    /**
     * Показывает страницу для подключения аккаунта/бота
     *
     * @return $this->render("groups")
     */
    function actionGroups(){
        $vk=new \VK\OAuth\VKOAuth(VkconnectController::VERSION);
        $display = \VK\OAuth\VKOAuthDisplay::PAGE; 
        $client_id = 7830167; 
        $redirect_uri = "http://185.130.104.235/vkconnect/connect";    
        $scope = [
         \VK\OAuth\Scopes\VKOAuthUserScope::WALL, 
         \VK\OAuth\Scopes\VKOAuthUserScope::GROUPS,
         \VK\OAuth\Scopes\VKOAuthUserScope::OFFLINE,
         \VK\OAuth\Scopes\VKOAuthUserScope::EMAIL,
        ];
        $response_type="code";
        $browser_url = $vk->getAuthorizeUrl($response_type, $client_id, $redirect_uri, $display, $scope); 
        $pages = Vkaccount::find()->where(["user_id"=>\Yii::$app->user->id])->all();
        return $this->render("groups", [
            "add_link" => $browser_url,
            "accounts" => $pages
        ]);
    }
    /**
     * Подключение аккаунта ВК к системе сайта
     *
     * @return void
     */
    function actionConnect(){
        try {
            $vk = new \VK\OAuth\VKOAuth(VkconnectController::VERSION);
            $client_id = 7830167;
            $client_secret = 'cAamfQeawQ9fyn34NPFq';
            // redirect_uri должен совпадать с первым redirect_uri в actionGroups
            $redirect_uri = 'http://185.130.104.235/vkconnect/connect';
            $code = \Yii::$app->request->get('code');
            if ($code) {
                // echo '<pre>';
                // echo $client_id . '<br>';
                // echo $client_secret . '<br>';
                // echo $redirect_uri . '<br>';
                // var_dump( $code );
                // try {
                $response = $vk->getAccessToken($client_id, $client_secret, $redirect_uri, $code);
                // } catch (\VK\Exceptions\VKClientException $e) {
                //     var_dump($e);
                //     die();
                // }
                // var_dump($response);
                // die();
                // echo '<pre>';
                if (isset($response['access_token'])) {
                    $access_token = $response['access_token'];
                    $user_id = $response['user_id'];
                    $current_user = User::findOne(\Yii::$app->user->id);
                    $current_user->auth_id = $user_id;
                    $current_user->save();
                
                    //$state = $response['state'];
                    $r = Vkaccount::find()->where(["account_id"=>$user_id])->one();
                    if (empty($r)) {
                        $r = new Vkaccount();
                        $r->account_id = $user_id;
                    }
                    $r->access_token = $access_token;
                    $vk = new \VK\Client\VKApiClient();
                    $response = $vk->users()->get($access_token, array(
                'user_ids' => array($user_id),
                'fields' => array( 'photo'),
            ));
                    $r->user_id = \Yii::$app->user->id;
                    $r->first_name = $response[0]['first_name'];
                    $r->last_name = $response[0]['last_name'];
                    $r->avatar = $response[0]['photo'];
                    $r->save();
            
                    return $this->redirect(["/vkconnect/groups"]);
                } else {
                    foreach ($response as $key => $val) {
                        if (strpos($key, "access_token_")!==false) {
                            $vkgr =  Vkgroups::findOne([
                                    "group_id"=>str_replace("access_token_", "", $key),
                                    "user_id"=>\Yii::$app->user->id
                                ]);
                            if (!$vkgr) {
                                $vkgr =  new Vkgroups();
                                $vkgr->user_id = \Yii::$app->user->id;
                                $vkgr->group_id = str_replace("access_token_", "", $key);
                            }
                            $vkgr->access_token = $val;
                            $vkgr->save();
                            return $this->redirect(["/vkconnect/groups"]);
                            break;
                        }
                    }
                }
            }
    
            return $this->redirect('/vkconnect/groups');
        } catch (\VK\Exceptions\VKClientException $e) {
            throw new \yii\web\HttpException(404, 'Oops. Not found');
        }
    }
    
        /**
         * Group List
         *
         * @return void
         */
    function actionGrouplist(){
        try {
            $id = (int)\Yii::$app->request->get("id");
            if ($id) {
                $acc = Vkaccount::findOne(["id"=>$id]);
                if (\Yii::$app->user->id == $acc->user_id) {
                    $vk = new \VK\Client\VKApiClient(VkconnectController::VERSION);
                    $resp = $vk->groups()->get($acc->access_token, array(
                        "user_id"=> $acc->account_id,
                        "filter"=>"admin",
                        "extended"=>1
                    ));
                    $vkgrs =  Vkgroups::find()->select("group_id,id")->where(["user_id"=>\Yii::$app->user->id])->all();
                    
                    foreach ($resp["items"] as $key => $group) {
                        foreach ($vkgrs as $vkac) {
                            try {
                                if ($group["id"]==$vkac->group_id) {
                                    $resp["items"][$key]["connect"] = true;
                                    if (!$vkac->name or !$vkac->img) {
                                        $id = $vkac->id;
                                        $vkac1 = Vkgroups::findOne(["id"=>$vkac->id]);
        
                                        if ($vkac1) {
                                            if ($group["name"]) {
                                                $vkac1->name = $group["name"];
                                            }
                                            if ($group["photo_50"]) {
                                                $vkac1->img = $group["photo_50"];
                                            }
                                            $vkac1->save();
                                        }
                                    }
                                }
                            } catch (\VK\Exceptions\Api\VKApiGroupAuthException $e) {
                                $group = Vkgroups::findOne(["id"=>$id]);
                                $group->delete();
                                $this->goBack();
                            } 
                        }  
                        
                        if (!isset($resp["items"][$key]["connect"])) {
                            $resp["items"][$key]["connect"] = false;
                        }
                    } 
                }
                    
                    return $this->render("/vkconnect/grouplist", ["account"=>$acc,"groups"=>$resp]);
                } else {
                    throw new \yii\web\HttpException(404,'Oops.');
                }
            return $this->redirect("/constructor");
        } catch (\yii\base\ErrorException $e) {
            throw new \yii\web\HttpException(404, 'Oops. Not found');
        }
    }

    function actionAddgroup(){
        $profile_id = (int)\Yii::$app->request->get("profile_id");
        $group_id = (int)\Yii::$app->request->get("group_id");
        
        $acc = Vkaccount::findOne(["account_id"=>$profile_id,"user_id"=>\Yii::$app->user->id]);
        if ($acc) {
            $vk=new \VK\OAuth\VKOAuth(VkconnectController::VERSION);
            $display = \VK\OAuth\VKOAuthDisplay::PAGE; 
            $client_id = '7830167'; 
            $client_secret = 'cAamfQeawQ9fyn34NPFq';
            $redirect_uri = 'http://185.130.104.235/vkconnect/connect'; 
            $group_ids = [$group_id];
            $scope = [
                \VK\OAuth\Scopes\VKOAuthGroupScope::MANAGE,
                \VK\OAuth\Scopes\VKOAuthGroupScope::MESSAGES,
                \VK\OAuth\Scopes\VKOAuthGroupScope::PHOTOS ,
                \VK\OAuth\Scopes\VKOAuthGroupScope::DOCS ,
            
            ];
            
            $browser_url = $vk->getAuthorizeUrl("code", $client_id, $redirect_uri, $display, $scope, "", $group_ids); 
            $this->redirect($browser_url);
            /**/
            
            // echo"ok";
        }
    }
    /**
     * Addcallback function
     *
     * @return $this->redirect('/vkconnect/groups');
     */
    function actionAddcallback(){
        $group_id = \Yii::$app->request->get("group_id");
        if ($group_id) {
            $group = Vkgroups::findOne(["user_id"=>\Yii::$app->user->id,"group_id"=>$group_id]);
            if ($group) {
                try {
                    $vk = new \VK\Client\VKApiClient(VkconnectController::VERSION);
                    $secret = $this->generateRandomString(30);
                    $resp = $vk->groups()->getCallbackConfirmationCode($group->access_token, ["group_id"=>$group->group_id]);
                    var_dump($resp);
                    $group->code = $resp["code"];
                    $group->save();
                    $resp = $vk->groups()->addCallbackServer($group->access_token, array(
                        "group_id"=>$group->group_id,
                        "url"=>'http://185.130.104.235/vkc/bot',
                        "title"=>"Vk-Bot",
                        "secret_key"=>$secret
                    ));
                    var_dump($resp);
                    $group->server_id = $resp["server_id"];
                
                    $group->secret_key  = $secret;
                    $group->save();
                    $resp=$vk->groups()->setCallbackSettings($group->access_token, array(
                    "api_version"   => self::VERSION, 
                    "group_id"      => $group->group_id,
                    "server_id"     => $group->server_id,
                    "message_new"   => 1,
                    "group_join"    => 1,
                    "group_leave"   => 1,
                    "message_allow" => 1,
                ));
                    var_dump($resp);
                    // echo 'very good';
                } catch (\VK\Exceptions\Api\VKApiGroupAuthException $e) {
                    $group = Vkgroups::findOne(["group_id"=>$group->group_id]);
                    $group->delete();
                    $this->goBack();
                }
                // echo 'ok';
            } else {
                throw new \yii\web\HttpException(404, 'Oops. Not found');
            }
        
            return $this->redirect('/vkconnect/groups');
        }
    }

    protected function generateRandomString($length = 10) {
    
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
};
