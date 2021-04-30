<?php
namespace app\models;
use yii\base\Model;

class RegisterForm extends Model{

	public $email;
	public $password;
	public $confirm_password;
	public function rules(){
		return [
			[["email","password","confirm_password"],"required","message"=>"Заполните поле"],
			["email","email","message"=>"Поле должно содержать корректный Email адрес"],
			["email","unique",'targetClass' =>User::className(),"message"=>"Email уже используется"],
			["password","compare","compareAttribute"=>"confirm_password","message"=>"Пароли должны совпадать"],
		];
	}
	public function attributeLabels(){
		return[
			"email"=>"Email",
			"password"=>"Пароль",
			"confirm_password"=>"Повтор пароля"

		];
	}
}
