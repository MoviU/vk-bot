<?php

namespace app\controllers;
use Yii;

class DefController extends BaseController{
    public function init(){
        parent::init();
        
    }

	
public function behaviors(){
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
    ];
}
    
}
