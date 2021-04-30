<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use app\widgets\Submenu;
use yii\helpers\Url;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://vk.com/js/api/xd_connection.js?2"  type="text/javascript"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="/css/jquery-confirm.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <style>
        @media (max-width:400px){
            .navbar-nav li{
                text-align:center;
            }
        }
        .navbar-inverse .navbar-nav > li > a:hover,.navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover,.navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus {
            color:black;
        }
        
    </style>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
   
    <?php
    NavBar::begin([
        'brandLabel' => "<img class='pull-left' src='".Url::to(["@web/img/logo.svg"])."'> <span class='pull-left'>".Yii::$app->name."</span>",
        'brandUrl' => Yii::$app->homeUrl,
        //"brandImage"=>,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    ?>
      

    
    <?php
    echo Nav::widget([
        "encodeLabels"=>false,
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => 
            
            Yii::$app->user->isGuest ? ([
                
					['label' => 'Главная', 'url' => ['/site/index']],
					['label' => 'Партнерам', 'url' => ['/site/partners']],
					['label' => 'Тарифы', 'url' => ['/site/price']],
					
				
            ]) : ([
					['label' => 'Конструктор', 'url' => ['/constructor']],
					['label' => 'Тарифы и оплата', 'url' => ['/pricelist']],
					/*['label' => "Финансы <span class='badge badge-success'>".\Yii::$app->user->identity->balance."</span>", 'items' => [
							["label"=>"Пополнить ","url"=>["/payment"]],
							["label"=>"История","url"=>["/payment/history"]],
						]],*/
					
					['label' => 'Партнерам', 'items' => [
							["label"=>"О программе","url"=>["/partners"]],
							["label"=>"Детали","url"=>["/partners/history"]],
						]],
                    /*['label' => 'Вк Connect', 'items' => [
							
							["label"=>"Группы","url"=>["/vkconnect/groups"]],
						]],*/
                    ['label' => 'FAQ', 'url' => ['/manual']],
					['label' => 'Поддержка', 'url' => \Yii::$app->params["support"]],
					
]
				)
        ,
    ]);
    
    echo Nav::widget([
        "encodeLabels"=>false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => 
            
            Yii::$app->user->isGuest ? ([
                    ['label' => 'Войти', 'url' => ['/site/login']],
					["label"=>"Регистрация","url"=>["/site/register"],"linkOptions"=>["class"=>"regbtn"]]
            
             ]) : ([
    
                    
                    ['label' => '<svg style="padding-top: 5px;" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.5 6.06667V4.16667C17.5 3.25 16.75 2.5 15.8333 2.5H4.16667C3.24167 2.5 2.5 3.25 2.5 4.16667V15.8333C2.5 16.75 3.24167 17.5 4.16667 17.5H15.8333C16.75 17.5 17.5 16.75 17.5 15.8333V13.9333C17.9917 13.6417 18.3333 13.1167 18.3333 12.5V7.5C18.3333 6.88333 17.9917 6.35833 17.5 6.06667ZM16.6667 7.5V12.5H10.8333V7.5H16.6667ZM4.16667 15.8333V4.16667H15.8333V5.83333H10.8333C9.91667 5.83333 9.16667 6.58333 9.16667 7.5V12.5C9.16667 13.4167 9.91667 14.1667 10.8333 14.1667H15.8333V15.8333H4.16667Z" fill="white"/>
<path d="M13.3333 11.25C14.0236 11.25 14.5833 10.6904 14.5833 10C14.5833 9.30964 14.0236 8.75 13.3333 8.75C12.6429 8.75 12.0833 9.30964 12.0833 10C12.0833 10.6904 12.6429 11.25 13.3333 11.25Z" fill="white"/>
</svg>'.\Yii::$app->user->identity->balance.'&#8381;', 'url' => ['/payment']],
                    ['label' => '<img style="width:50px;height:50px;" class="img-circle" src="/img/default.png"> 
                    ', 'items' => [
							
							["label"=>"Профили","url"=>["/vkconnect/groups"]],
							["label"=>"Выход","url"=>["/site/logout"]],
						]]
                ])
    ]);
    
    NavBar::end();
    ?>
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
      
        
            
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; All right reserve <?= date('Y') ?></p>

        <p class="pull-right">
		
		<?=\Yii::$app->params["contacts"]["vkcontact"]?><br> <!--<?=\Yii::$app->params["contacts"]["email"]?>-->
		
		</p>
    </div>
</footer>
  
<?php $this->endBody() ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/jquery-confirm.min.js"></script>
<script type="text/javascript">
window.onload = function() {
    VK.init(function() {
     // API initialization succeeded
     // Your code here
	 alert('ok');
  }, function() {
    location.href=location.href;
}, '5.130');

};
</script>
</body>
</html>
<?php $this->endPage() ?>
