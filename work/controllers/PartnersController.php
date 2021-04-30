<?php
namespace app\controllers;

use Yii;




class PartnersController extends BaseController{

	public function actionIndex(){
		
		return $this->render("construct");
	}
	public function actionHistory(){
		
		return $this->render("history");
	}

}


