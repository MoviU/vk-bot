<?php


namespace app\components;

use app\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

class AuthHandler{
    private $client;
    
    function __construct(ClientInterface $client){
        $this->client=$client;
    }
    public function handle(){
        $attr = $this->client->getUserAttributes();
        
        $id = ArrayHelper::getValue($attr, 'id');
        
        $user = User::find()->where(["auth_id"=>$id])->one();
        
        if($user){
          
            $user->save();
            \Yii::$app->user->login($user);
            
        }
        else{
            $user = new User();
            $user->auth_id = $id;
         
            $user->save();
            \Yii::$app->user->login($user);
        }
        return "work";
    }
    
}
