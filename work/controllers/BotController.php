<?php
namespace app\controllers;

use Yii;
use app\models\Bot;
use app\models\Botactions;
use app\models\Vkgroups;
use app\models\Group_counter;
use app\models\Mailinglist;
use app\models\Botcommand;
use app\models\BotcommandsHasVariables;
use app\models\KeyboardForm;
use app\models\RulesForBotcommands;
use app\models\SetRuleForm;
use app\models\VariablesForm;
use \VK\Client\VKApiClient;

class BotController extends DefController {
    
    function actionGroup_list(){
        $id = \Yii::$app->request->post("id");
        $groups = Vkgroups::find()->where(["bot_id"=>$id,"user_id"=>\Yii::$app->user->id])->asArray()->all();
        echo json_encode($groups);
    }
    
    function actionImport(){
        $id = \Yii::$app->request->get("id");
        $type=\Yii::$app->request->get("type");
        $bot = Bot::find()->where(["id"=> $id])->with("group")->one();
        if(!$bot)
            die("error");
        $list = Mailinglist::find()->select("user_id,city_name,country_name,sex")->where(["group_id"=>$bot->group->group_id])->all();
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/octet-stream');
        $headers->add('Content-Disposition', 'attachment; filename=group_users_'.$bot->group->group_id.".txt");
        if($type=="short"){
            $rlist = array_map(function($el){return $el->user_id;},$list);
        }else{
            $rlist =array_map(function($el){return ["user_id"=>$el->user_id,"city"=>$el->city_name,"country"=>$el->country_name,"sex"=>$el->sex];},$list);
        }
        echo json_encode($rlist);
    }
    
    
    function actionParsemembers(){
        $id = \Yii::$app->request->get("id");
        $bot = Bot::find()->where(["id"=> $id,"user_id"=>\Yii::$app->user->id])->with("group")->one();
        if(!$bot)
            die("error");
        $vkapi = new VKApiClient("5.130");
        
        $res = $vkapi->groups()->getById($bot->group->access_token,[
            "group_id" => $bot->group->group_id,
            "fields"   => "members_count"
        ]);
        $gcounter = Group_counter::findOne(["group_id"=>$bot->group->group_id,"type"=>Group_counter::TYPE_ALL]);
        if(!$gcounter){
            $gcounter = new Group_counter();
            $gcounter->group_id = $bot->group->group_id;
            $gcounter->name= "Все пользователи";
        }
        $gcounter->users = $res[0]["members_count"];
        $gcounter->updated = date("Y-m-d H:i:s");
        $gcounter->save();
        
        $offset = 1000;
        $one_req = 24000;
        for($i=0;$i<$res[0]["members_count"]/$one_req;$i++){
            $code =  '
            var members =[]; 
            var offset =0;
            while ( (offset + '.($one_req*$i).') < '.($one_req*($i+1)).'){
                members =   members + API.groups.getMembers(
                        {"group_id": '.$bot->group->group_id.',"fields":"sex,city,country", "v": "5.80", "sort": "id_asc", "count": '.$offset.', "offset": ('.($one_req*$i).' + offset)}
                    ).items;
                offset = offset + '.$offset.';
            }
            return members;';
            $users_with_info = $vkapi->getRequest()->post("execute", $bot->group->access_token,["code" => $code, "v"=>"5.80"]);
            var_dump($users_with_info);
            $users = array_map(function($el){return $el["id"];},$users_with_info);
            if(is_array($users)){
                $users_in_db = Mailinglist::find()->where(["group_id"=>$bot->group->group_id])->where(["<=","user_id",end($users)])->where([">=","user_id",$users[0]])->all();
                $users_in_buf =[];
                if($users_in_db)
                    $users_in_buf = array_map(function($el){return $el->user_id;},$users_in_db);
                $rnews = array_diff($users,$users_in_buf);
                $time=time();
                foreach($users_with_info as $el){
                    if(in_array($el["id"],$rnews)){
                        $e = new Mailinglist();
                        $e->group_id = $bot->group->group_id;
                        $e->user_id = $el["id"];
                        $e->sex = $el["sex"];
                        if(isset($el["city"]) and is_array($el["city"])){
                            $e->city_name = $el["city"]["title"];
                            $e->city_id = $el["city"]["id"];
                        }
                        if(isset($el["country"]) and is_array($el["country"])){
                            $e->country_name = $el["country"]["title"];
                            $e->country_id = $el["country"]["id"];
                        }
                        $e->save();
                    }
                }
                /*$rdelete = array_diff($users_in_buf,$users);
                if($rdelete)
                $db->conn->query("delete from groupusers where user_id in (".implode(",",$rdelete).") ");
               */
            }usleep(420000);
        }
        echo"ok";
    }
    
    function actionMailing(){
        try{
            $bot = Bot::find()->where(["id"=>\Yii::$app->request->get("id")])->with("groups")->one();
            if ($bot->user_id == \Yii::$app->user->id) {
                $groups = Vkgroups::find()->where(["bot_id"=>\Yii::$app->request->get("id")])->all();
                if ($groups) {
                    $gcounter =  Group_counter::find()->where(["group_id"=>$bot->groups[0]->group_id])->all();
            
                    return $this->render("mailing", compact("bot", "gcounter", "groups"));
                } else {
                    return $this->render("mailing", [
                    'bot'      => $bot,
                    'groups'   => null,
                    'gcounter' => null
                ]);
                }
            } else {
                throw new \yii\web\HttpException(404, 'Oops. Not Found');
            }
        } catch (yii\base\ErrorException $e) {
            throw new \yii\web\HttpException(404, 'Oops. Not Found');
        }
        
    }
	
    function actionEmailing(){
        $bot = Bot::find()->where(["id"=>\Yii::$app->request->get("id")])->with("group")->one();

        return $this->render("edit_mailing",compact("bot"));
    }
	
	/**
     * Проверяем бота если есть то делаем что-то
     * если не то на редирект
     *
     * @return void
     */
    function actionIndex(){
        $id = \Yii::$app->request->get("id");
        $bot = Bot::findOne(["id"=> $id,"user_id"=>\Yii::$app->user->id]);
        $groups = Vkgroups::find()->where(["bot_id"=>$id,"user_id"=>\Yii::$app->user->id])->all();
        $commands = Botcommand::find()->where(["bot_id"=>$id])->orderBy("uses","desc")->all();
        
        if(!$bot)
            return $this->redirect(["/constructor"]);
        return $this->render("history",compact("bot","groups","commands"));
    }
    /**
     * Функция для создания задач для бота
     * Добляет в бд команду
     *
     * @return void
     */
    function actionAction(){
        // Получаем данные по get запросу и с бд
        $id = \Yii::$app->request->get("id");
        $action_id = intval(\Yii::$app->request->get("action"));
        $bot = Bot::find()->where(["id"=> $id,"user_id"=>\Yii::$app->user->id])->with("groups")->one();
        
        $action = Botactions::findOne([
                "bot_id" => $id,
                "type"   => $action_id
            ]);
        /**
         * Если нету Бот-экшна то создаем его
         */
        if ($action) {
            $bufr = json_decode($action->text);
            if (!is_array($bufr)) {
                $action->text = [$action->text];
            } else {
                $action->text = $bufr;
            }
            if (!$bot) {
                return $this->redirect(["/constructor"]);
            }
            if (\Yii::$app->request->get("enabled")) {
                $action->enabled = 1-$action->enabled;
                $action->save();
                return "ok";
            }
                    
            if (\Yii::$app->request->method=="POST" and $action_id>=0) {
                if (!$action) {
                    $action = new Botactions();
                    $action->bot_id = $id;
                    $action->type = $action_id;
                }
                
                $action->text = json_encode(\Yii::$app->request->post("text"));
                $action->writemode = \Yii::$app->request->post("writemode");
                $action->save();
                $this->redirect(["/constructor/edit","id"=>$id]);
            }
                
            return $this->render("action", compact("bot", "action"));
    
        } else {
                $action = new Botactions();
                $action->bot_id = $id;
                $action->type = $action_id;
                $action->save();
                return $this->refresh();
            }
    }
	
	function actionShowmailing(){
		$id = \Yii::$app->request->get("id");
        
        $bot = Bot::findOne(["id"=> $id,"user_id"=>\Yii::$app->user->id]);
		return $this->render("showel_mailing",compact("bot"));
	}
	function actionCreatemailing(){
		$id = \Yii::$app->request->get("id");
        
        $bot = Bot::findOne(["id"=> $id,"user_id"=>\Yii::$app->user->id]);
		return $this->render("create_list_mailing",compact("bot"));
	}   
    /**
     * Рендерим конструктор создания клавиатуры для команды
     *
     * @return mixed
     */
    public function actionKeyboardconstructor () {
        $command_id = \Yii::$app->request->get("id");
        $botcommand = Botcommand::findOne(['id'=>$command_id]);
        $model = new KeyboardForm();
        $keyboard = [
            "one_time" => true,
            "buttons" => [
                [
                    
                ]
            ]
        ];
        // $keyboard = [
        //     "one_time" => false,
        //     "buttons" => [
        //         [
        //             ["action" => [
        //                 "type" => "text",
        //                 "payload" => '{"button": "1"}',
        //                 "label" => "Фрукты?"
        //             ],
        //             "color" => "default"
        //             ],
        //         ]
        //     ]
        // ];
        /**
         * Если нету кавиатуры создаем ее
         */
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            // var_dump($_POST);
            // return var_dump($model);
            $keyboard['buttons'][0][0]["action"] = [
                            "type" => "text",
                            "payload" => '{"button": "1"}',
                            "label" => $model->label,
            ];
            $keyboard['buttons'][0][0]['color'] = $model->color;

            $botcommand->keyboard = json_encode($keyboard);
            $botcommand->save();
            return $this->redirect('/constructor/ecommand?id=' . $command_id);
        }
        return $this->renderPartial('keyboardConstructor', [
            'botcommand' => $botcommand,
            'model'      => $model,
            'keyboard'   => $botcommand->keyboard
        ]);
    
    }

    public function actionAddvar () {
        $command_id = \Yii::$app->request->get("command_id");
        $bot_id = \Yii::$app->request->get("bot_id");
        $model = new VariablesForm();

        $variables = BotcommandsHasVariables::findAll([
                'bot_id' => $bot_id,
                'command_id' => $command_id
            ]);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $var = new BotcommandsHasVariables();

            $var->name = $model->name;
            $var->type = $model->type;
            $var->kind = $model->kind;
            $var->bot_id = $bot_id;
            $var->command_id = $command_id;
            $var->description = $model->description;
            if ($model->type == BotcommandsHasVariables::VAR_INT_TYPE) {
                $var->default_int = $model->default ? $model->default : '0';
                $var->max_int = $model->max;
                $var->min_int = $model->min;
            } else {
                $var->default_str = $model->default ? $model->default : '';
            }
            $var->save();

            // var_dump($var);
            // return var_dump($model);
            

            return $this->redirect('/constructor/ecommand?id=' . $command_id);
        }

        return $this->renderPartial('varsConstructor', [
            'variables' => $variables,
            'model'     => $model
        ]);
    }

    public function actionSetrule () {
        try {
            $model = new SetRuleForm();
            $command_id = \Yii::$app->request->get("command_id");
            $com = Botcommand::findOne($command_id);
            $bot_id = \Yii::$app->request->get("bot_id");
            $bot = Bot::find()->where(["id"=>$bot_id, "user_id"=>\Yii::$app->user->id])->with("groups")->one();

            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                $rule = new RulesForBotcommands();

                $rule->when = $model->when;
                $rule->rule_kind = $model->rule_kind;
                $rule->rule = $model->rule;
                $rule->value = $model->value;        
                if ($model->rule_kind == 'variable') {
                    $rule->var_id = $model->var;
                }
                $rule->command_id = $command_id;
                $rule->save();

                $rule = RulesForBotcommands::findOne(['var_id' => $model->var]);
                $com->rule_id = $rule->id;
                $com->save();
                // return $this->redirect('/constructor/ecommand?id=' . $command_id);
            }
            return $this->renderAjax('setrule', [
                'model' => $model,
                'com' => $com,
                'bot' => $bot
            ]);
        } catch (yii\base\ErrorException $e) {
            throw new \yii\web\HttpException(404, 'Oops. Not Found');
        }
    }

}
