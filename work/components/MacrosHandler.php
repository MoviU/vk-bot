<?php
namespace app\components;

use yii\base\BaseObject;
use app\controllers\ServerHandler;
class MacrosHandler extends BaseObject{
    static public $macro_list = array(
        "{name}","{surname}","{city}","{user_id}","{group_name}","{date}","{time}",
    );
    static public $macro_names = array(
        "Имя","Фамилия","Город","ID Пользователя","Название вашей группы","Дата","Время"
    );
    public $macro_data;
    function filter($user_id,$access_token,$text,$group_info){
        $vk=new \VK\Client\VKApiClient("5.120");
        $user_info = $vk->users()->get($access_token, [
            "user_ids"=>$user_id,
            "fields"=>"city",
           
        ]);
        $user_info = $user_info[0];
        $info = array();
        // $group_info->name,
        $info["first_name"] = $user_info["first_name"] ? $user_info["first_name"] : 'неизвестный';
        $info["last_name"] = $user_info["last_name"] ? $user_info["last_name"] : 'неизвестный';
        
        if (isset($user_info['city']['title'])) {
            $info['city'] = $user_info['city']['title'];
        } else {
            $info['city'] = 'неизвестный';
        }

        $this->macro_data = array($info["first_name"], $info["last_name"], $info["city"], $user_id, date("d.m.Y"), date("H:i:s"));
        $text = str_replace(self::$macro_list, $this->macro_data, $text);
        
        return $text;
    }
    static function options(){
        return array_combine(self::$macro_names, self::$macro_list);
    }
}
