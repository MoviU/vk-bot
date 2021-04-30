<?php
namespace app\models;
use yii\db\ActiveRecord;


class Vkgroups extends ActiveRecord{
    
    function getUser(){
        return $this->hasOne(User::className(),["id"=>"user_id"]);
    }
    function getBot(){
		return $this->hasOne(Bot::className(),["id"=>"bot_id"]);
	}
}
