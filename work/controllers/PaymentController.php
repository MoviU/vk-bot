<?php
namespace app\controllers;

use Yii;

use app\models\Vkgroups;


class PaymentController extends DefController{

	public function actionServices(){
		
		return $this->render("construct");
	}
	public function actionIndex(){
		$groups = Vkgroups::find()
                            ->where(["user_id"=>\Yii::$app->user->id])
                            ->where([">","bot_id","0"])
                            ->with(["bot","bot.tariff"])->all();
		return $this->render("services",["groups"=>$groups]);
	}
	public function actionHistory(){
		
		return $this->render("history");
	}

}

