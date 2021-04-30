<?php

namespace app\controllers;
use app\components\ImageWork;

class TestController extends \yii\web\Controller{
    
    function actionIndex(){
        // $img = new ImageWork();
        // $img->loading("5","5_3");
        // return "ok";
        // return phpinfo();
        throw new \yii\web\HttpException(404, 'Oops. Not found.');
    }
}
