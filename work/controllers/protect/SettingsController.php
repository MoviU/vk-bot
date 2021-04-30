<?php

namespace app\controllers\protect;

use Yii;
use app\controllers\BaseController;
use app\models\Settings;
class SettingsController extends BaseController{

	function actionIndex(){
		$post=\Yii::$app->request->post();
		if(key_exists("vkcontact",$post)){
			$c = Settings::find()->one();
			if(!$c){
				$c = new Settings();
			}
			$c->vkcontact = $post["vkcontact"];
			$c->email = $post["email"];
			$c->supportlink = $post["supportlink"];
			$c->save();
		}
		$contacts = Settings::find()->asArray()->one();
		
		
		
		return $this->render("basicsettings",["contacts"=>$contacts]);
	}

}
