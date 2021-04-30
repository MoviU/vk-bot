<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<link href="/css/tariff.css" rel="stylesheet">
    <style>
	
        @font-face {
 font-family: "Gotham Pro";
 src: url("/fonts/GothamPro.eot") format("eot"),
        url("/fonts/GothamPro.ttf") format("ttf"),
        url("/fonts/GothamPro.woff") format("woff");
}
        *{
            font-family: 'Gotham Pro' !important; 
        }
        .navbar-inverse.navbar-fixed-top{
            background: #4B77A6;
            border-bottom:#4B77A6;
            height: 80px;
        }
        body{
            font-family: Gotham Pro;
            font-style: normal;
        }
        .navbar-inverse .navbar-brand{
            font-weight: bold;
            font-size: 20px;
            line-height: 50px;
            text-transform: uppercase;

            color: #FFFFFF;
        }
        .collapse.navbar-collapse{
            height:100% !important;
        }
        .navbar .container, .navbar-nav.nav, .navbar-nav.nav li, .navbar-nav.nav li a{
            height:35px !important;
            line-height:80px;;
        }
        .navbar-nav.nav li a{
            font-size: 16px;
            line-height: 9px;
height: 35px;
margin-top: 20px;
            color: #FFFFFF;
        }
        .navbar-inverse .navbar-nav > .active > a{
            background: #00000055;
            
            border-radius: 50px;
        }
        
        .regbtn{
            background: #FFFFFF;
box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.2);
border-radius: 30px;
color: #4B77A6 !important;
        }
        .site-header{
            background: linear-gradient(180deg, #4D7CAD 0%, #0A4583 100%);
            color:white;
            text-align:left;
        }
        .site-header .container{
            padding-top:70px;
        }
        .site-header h1{
            font-weight: 900;
            font-size: 42px;
            line-height: 130%;
            color:white;
        }
        .site-header p{ 
            font-size: 16px;
            line-height: 150%;
            /* or 24px */
            color: #FFFFFF;
        }
        .detailinfo{
            background: #FFFFFF;
            border-radius: 8px;
            padding:30px;
            font-size: 18px;
            line-height: 150%;
            color: #24282Dcc;
            height:320px;
        }
        .detailinfo img{
            display:block;
        }
        .detailinfo b{
            font-weight: 900;
            font-size: 24px;
            line-height: 130%;
            color: #24282D;
            padding-bottom: 17px;
            padding-top: 17px;
            display: inline-block;
        }
       
        .panelheader{
            font-weight: 900;
            font-size: 42px;
            line-height: 130%;

            /* identical to box height, or 55px */
            text-align: center;

            /* Black */
            color: #24282D;
            margin-bottom:70px;
            margin-top:70px;
        }
        .cfirst{
            background: #F5F6F8;
        }
        .jumbotron {
            margin-bottom:0px;
        }
        .sec1{
            
        }
        .sec1 img{
            width:100px;
            display:inline-block;
        }
         .sec1 b{
             margin-top:20px;
             display:block;
              font-style: normal;
            font-weight: bold;
            font-size: 20px;
            line-height: 130%;
            text-align: center;
            color: #24282D;
        }
        .sec1  > div{
            height:270px;
            text-align:center;
           font-style: normal;
font-weight: normal;
font-size: 16px;
line-height: 150%;

/* or 24px */
text-align: center;

/* Black */
color: #24282D;
        }
        
        
        .togglepanel{
           
            background: rgba(36, 40, 45, 0.05);
            border-radius: 100px;
            padding:15px 20px;
            
        }
        
        .togglepanel button{
            border:0px;
            min-width:130px;
            height: 50px;
            padding:15px 23px;
            background:transparent;
            font-weight: bold;
            font-size: 16px;
            line-height: 130%;
            
        }
        .bluebtn{
            /* Blue vk */
            background: #4B77A6 !important;
            border-radius: 25px;
            color: #FFFFFF;
        }
        
        
    .footer{
        height:auto;
        color:white;
        background:#4B77A6;
    }
    .footer > div{
        /*background:url(/img/653a5b3540c4198a201f073d4876f851.png);*/
    }
    .wrap {
        
        padding:0px;
    }
    
    
    
    
    
    
    .leftheader{
        margin:0px;
        text-align:left;
    }
    .panellegend{
        font-size: 18px;
        line-height: 130%;
        color: #24282D;
    }
    .seotext{
        font-size: 16px;
        line-height: 150%;
        color: #24282D;
    }
    
    .iconstat{
        background: #FFFFFF;
        box-shadow: 0px 10px 30px rgba(75, 119, 166, 0.15);
        border-radius: 8px;
        padding-top:50px;
        padding-bottom:50px;
        padding-left:30px;
        
    }
    .iconstat small,.iconstat .numcount{
        color: #4B77A6;
    }
    .iconstat small{
        vertical-align: top;
        font-size: 16px;
        line-height: 19px;
    }
    .iconstat .numcount{
        font-weight: 900;
        font-size: 52px;
        line-height: 50px;
    }
    .stepblock > div{
        text-align:center;
        font-weight: bold;
        font-size: 18px;
        line-height: 150%;
        text-align: center;
        color: #24282D;
    }
    .stepblock img{
        display: block;
        max-width: 80%;
        margin: auto;
        margin-bottom:25px;
        
    }
    .pluginblock img{
        width:100%;
    }
    .pluginblock div{
        padding:40px 30px;
    }
    .pluginblock{
        margin:0px;
        background:white;
        box-shadow: 0px 10px 30px rgba(75, 119, 166, 0.15);
        border-radius: 8px;
        font-size: 16px;
        line-height: 150%;
        color: #24282D;
        min-height:406px;
    }
    .pluginblock small{
        font-size: 14px;
        line-height: 13px;
        color: #24282D;
        opacity: 0.7;
        display:inline-block;
        margin-bottom:10px;
    }
    .pluginblock b{
        font-weight: 900;
        font-size: 24px;
        line-height: 23px;
        color: #24282D;
        display:inline-block;
        width:100%;
        margin-bottom:10px;
    }
    .footer ul{
        margin-top:15px;
        padding-left:0px;
    }
    .footer li{
        madding-bottom:5px;
        list-style-type: none;
        font-size: 14px;
        line-height: 150%;
        color: #FFFFFF;
    }
    .footer{
        padding-bottom:100px;
    }
    
    .footer li{
        font-size: 16px;
        line-height: 24px;
        color: #FFFFFF88;
        
    }
    .footer ul li a{
        font-size: 16px;
        line-height: 24px;
        color: #FFFFFF;
        
    }
    .navbar-inverse .navbar-nav > li > a.regbtn:hover{

        background:white;
    }
    .white-a-btn,.white-a-btn:focus,.white-a-btn:hover{
        background:white;
        padding:21px 30px;
        color: #4B77A6;
        font-size: 19px;
        line-height: 18px;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.3);
        border-radius: 30px;
        display: inline-block;
        cursor:pointer;
        text-decoration: none;
    }
   
    .white-text{
        font-size: 19px;
        line-height: 18px;
        color: #FFFFFF;
    }
	.jumblock a{
		margin-right:20px;
	}
	@media (max-width:480px){
		.headimg{
			margin-bottom: 30px;
			margin-top: 30px;
			
		}
		.detailinfo{
			margin-top: 30px;
		}
		.jumblock a, .jumblock span{
			
			margin: auto;
			margin-right: auto;
			margin-top: auto;
			display: block;
			float: none;
			width: 190px;
			margin-top: 20px;
			text-align: center;

		}
		.tariffblock{
			margin-left: -30px;
			margin-right: -30px;
			margin-bottom: 30px;
		}
		.pluginblock{
			margin-top: 30px;
		}
		.stepblock >div{
			margin-top: 30px;
		}
		 .collapse.navbar-collapse ,.navbar-nav.nav{
			 height:auto !important;
			 
			 background: white none repeat scroll 0% 0%;
		 }
		 .collapse.navbar-collapse{
			 
		 }
		 .collapse.navbar-collapse ul a{
			 color:black;
			 
		 }
		 .navbar-header{
			 height: 80px;
		 }
		 
		 .navbar-inverse .navbar-nav > .active > a {
			 border-radius:0px;
		 }
		 .regbtn{
			 box-shadow:none;
		 }
	}
    .tariffbtn,.tariffbtn:hover{
        color:white;
        text-decoration:none;
        display:inline-block;
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
					['label' => 'Тарифы', 'url' => ['/pricelist']],
					['label' => "Финансы <span class='badge badge-success'>".\Yii::$app->user->identity->balance."</span>", 'items' => [
							["label"=>"Пополнить ","url"=>["/payment"]],
							["label"=>"История","url"=>["/payment/history"]],
						]],
					['label' => 'FAQ', 'url' => ['/manual']],
					['label' => 'Партнерам', 'items' => [
							["label"=>"О программе","url"=>["/partners"]],
							["label"=>"Детали","url"=>["/partners/history"]],
						]],
                    ['label' => 'Вк Connect', 'items' => [
							
							["label"=>"Группы","url"=>["/vkconnect/groups"]],
						]],
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
    
    
                    ['label' => 'Выход', 'url' => ['/site/logout']]
                ])
    ]);
    
    NavBar::end();
    ?>

    
      


        <?= $content ?>
    
</div>

<footer class="footer">
    <div>
    <div class="container">
        <div class="col-lg-12 col-md-12">
            <img class='pull-left' src="<?=Url::to(["@web/img/logo.svg"])?>"> 
            <span class='pull-left' style="font-size: 20px;padding-bottom:30px; padding-left:15px;line-height: 50px;text-transform: uppercase;"><?=Yii::$app->name?></span>
            <div class="clearfix"></div>
            
            

© Bot-VK, 2016-2020.

Все материалы данного сайта являются объектами авторского права (в том числе дизайн). Запрещается копирование, распространение (в том числе путем копирования на другие сайты и ресурсы в Интернете) или любое иное использование информации и объектов без предварительного согласия с правообладателями.
            
        </div>
        <!--<div class="col-lg-3 col-md-3">
            <ul>
                <li>О нас</li>
                <li><a href="">Тарифы</a></li>
                <li><a href="">Партнерам</a></li>
                <li><a href="">Топ-групп</a></li>
                <li><a href="">Контакты</a></li>
                <li><a href="">Обратная связь</a></li>
            
            </ul>
        </div>
        <div class="col-lg-3 col-md-3">
            <ul>
                <li>Документы</li>
                <li><a href="">Оферта</a></li>
                <li><a href="">Политика конфиденциальности</a></li>
                <li><a href="">Правила и условия</a></li>
                <li><a href="">Антиспам-политика</a></li>
                
            </ul>
        
        </div>
        <div class="col-lg-3 col-md-3">
            
        
        </div>-->
            
        
    </div>
</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
