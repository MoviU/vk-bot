<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body{
            background: #E5E5E5;
        }
        .site-login{
            margin:auto;
            float: none;
            background: #FFFFFF;
            padding:40px;
            /* Shadow 1 */
            box-shadow: 0px 10px 30px rgba(75, 119, 166, 0.15);
            border-radius: 8px;
            
            
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height:150%;

            /* Black */
            color: #24282D;
            
            
            
        }
        .logo-text{
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: bold;
            font-size: 20px;
            line-height: 19px;
            text-transform: uppercase;
            

            float: left;
            
        }
        
        .site-login .block-header a{
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: bold;
            font-size: 18px;
            line-height: 17px;

            /* Blue vk */
            color: #4B77A6;
        }
        .site-login .block-header span,.site-login .block-header a{
            line-height: 50px;
            /* Blue vk */
            color: #4B77A6;
            display: flex;
            align-items: center;
            margin-left: 8px;
        }
        .site-login hr{
            background: #D1D9E0;
        }
        .site-login center{
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 13px;
            
            align-items: center;
            text-align: center;

            /* Black */
            color: #24282D;
            opacity: 0.7;
        }
        .site-login .delimeter{
            position:relative;
            border-bottom: 1px solid gray;
            margin-top: 35px;
            margin-bottom: 35px;
        }
        
        
        .site-login .orlabel{
            position: absolute;
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 15px;
            align-items: center;
            text-align: center;
            color: #24282D88;
            top: -10px;
            background: white;
            padding: 4px 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .authvk{
            margin-top: 20px;
            background: #FFFFFF;
            padding: 8px 25px;
            /* Blue vk */
            border: 1px solid #4B77A6;
            box-sizing: border-box;
            border-radius: 50px;
            line-height:24px;
            height: 45px;
        }
        .authvk span{
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: bold;
            font-size: 17px;
            padding-left:7px;
            display: flex;
            align-items: center;
            text-align: center;

            /* Blue vk */
            color: #4B77A6;
        }
        
        .form-group .form-control{
            background: #FFFFFF;
            border: 1px solid #D1D9E0;
            box-sizing: border-box;
            border-radius: 8px;
            height:50px;
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: normal;
            font-size: 15px;
            line-height: 14px;
            /* Black */
            color: #24282D;
        }
         .form-group .form-control:hover, .form-group .form-control:active, .form-group .form-control:focus{
            background: #FFFFFF;

            /* Blue vk */
            border: 1px solid #4B77A6;
            box-sizing: border-box;
            border-radius: 8px;
        }
        .authsend{
            /* Blue vk */
            background: #4B77A6;
            border-radius: 30px;
            font-family: Gotham Pro;
            width:100%;
            align-items: center;
            text-align: center;
            font-family: Gotham Pro;
            font-style: normal;
            font-weight: bold;
            font-size: 17px;
            line-height: 16px;
            color: #FFFFFF;
            padding-top:17px;
            padding-bottom:17px;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
   
  


    <div class="container">
      
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
