<?php
namespace app\controllers;

use Yii;
use app\models\Tariff;
use app\models\User;



class PricelistController extends DefController{

	public function actionIndex(){
		$tariffs = Tariff::find()->all();
		return $this->render("tariffs",["tariffs"=>$tariffs]);
	}
	public function actionRefill(){
		if(\Yii::$app->request->method=="POST"){
			$amount = \Yii::$app->request->post("amount");
			if($amount>0){
				$user = User::findOne(["id"=>\Yii::$app->user->id]);
				$user->balance+=$amount;
				$user->save();
				return $this->redirect("/pricelist/refill");
			}
		}
		return $this->render("refill");
	}

}

