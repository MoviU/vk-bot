<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Request;
use app\models\Settings;

class BaseController extends Controller{

	public function init(){
		$c = Settings::find()->asArray()->one();
		\Yii::$app->params["contacts"] = $c;
		\Yii::$app->params["support"] = "https://vk.com";

	}


}