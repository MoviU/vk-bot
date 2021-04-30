<?php
namespace app\models;
use yii\db\ActiveRecord;

class Bot extends ActiveRecord{
    
	public function getGroup(){
        return $this->hasOne(Vkgroups::className(),["bot_id"=>"id"]);
    }
	public function getGroups(){
        return $this->hasMany(Vkgroups::className(),["bot_id"=>"id"]);
    }
	public function getTariff(){
        return $this->hasOne(Tariff::className(),["id"=>"tariff_id"]);
    }
	

}

