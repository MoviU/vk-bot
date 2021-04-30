<?php
namespace app\controllers\protect;
use Yii;
use app\controllers\BaseController;
class FaqController extends BaseController{
    function actionIndex(){
        return $this->render("faq");
    }
    
}
