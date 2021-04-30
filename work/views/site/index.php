<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'BotVk';
?>
<div class="site-index">

    <div class="jumbotron site-header">
        <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                    <h1>Создайте лучшего бота для сообщества Вконтакте</h1>
                    <p class="lead" style="margin-bottom:30px;">Общение с клиентами и реклама товаров, отправка рассылок и выгодных предложений в пару кликов.
Экономьте свое время для грамотного развития бизнеса вместе с BotVK.</p>
<div class="jumblock">
    <a href="<?=Url::to("site/register")?>" class="white-a-btn" style="">Попробовать</a>
    <span class="white-text">7 дней бесплатно</span>
</div>
            </div>
        
            <div class="col-lg-6  col-md-6 headimg">
                <img style="max-width:100%;" src="/img/head.svg">
            </div>
            
        
            
    </div>
    
    
    </div>
    
    <div class="body-content">

       
    </div>
</div>
<div class="cfirst">
<div class="container ">
    <div class="row" style="margin-top: -100px;">
            <div class="col-lg-4  col-md-4">
                <div class="detailinfo">
                    <img src="/img/play.svg">
                    <b>Для развлечений</b>
                Приведите тысячи лояльных подписчиков в своё сообщество, развлекая пользователей с помощью бота.
                </div>
            </div>
            <div class="col-lg-4  col-md-4">
                <div class="detailinfo">
                    <img src="/img/comment.svg">
                    <b>Для консультаций</b>
                Дайте клиентам то, что они хотят — ответы на вопросы. Сократите количество персонала в отделе поддержки.
                </div>
            </div>
            <div class="col-lg-4  col-md-4">
                <div class="detailinfo">
                    <img src="/img/home.svg">

                    <b>Для бизнеса</b>
                    Автоматизируйте сбор заявок и продажи внутри бота. Настройте рассылки, цепочки и воронки, работающие вместо вас.
                </div>
            </div>
            
    
    </div>
    
    
    
    
        <center><h2 class="panelheader">Возможности BotVK</h2></center>
    <div class="row sec1">
        <div class="col-lg-4">
            <img src="/img/1.svg">
            <b>Конструктор сообщений</b>
            От простого текста до игры-квеста,
без программирования
        </div>
        <div class="col-lg-4">
            <img src="/img/2.svg">
            <b>Ключевые слова</b>
            Наборы случайных ответов, отправка любых медиафайлов и записей
        </div>
        <div class="col-lg-4">
            <img src="/img/3.svg">
            <b>Переменные</b>
            Сохраняйте ввод пользователя, считайте сумму заказа и отмечайте пройденные шаги
        </div>
        <div class="col-lg-4">
            <img src="/img/4.svg">
            <b>Макросы</b>
            Обращайтесь по имени и фамилии, называйте город или текущее время пользователя
        </div>
        <div class="col-lg-4">
            <img src="/img/5.svg">
            <b>Таргетинговые сообщения</b>
            Настройки реакций бота в зависимости от параметров пользователя (пола, города и тд)
        </div>
        <div class="col-lg-4">
            <img src="/img/6.svg">
            <b>Уведомления</b>
            Бот экспортирует нужные вам данные в личные сообщения или на email
        </div>
        <div class="col-lg-4">
            <img src="/img/7.svg">
            <b>Наглядная статистика</b>
            Полный набор инструментов для анализа пользователей бота
        </div>
        <div class="col-lg-4">
            <img src="/img/8.svg">
            <b>Стабильная работа</b>
            Мощные сервера: бот отвечает мгновенно и при любых нагрузках
        </div>
        <div class="col-lg-4">
            <img src="/img/9.svg">
            <b>Многое другое</b>
            Огромные возможности для создания вашего неповторимого бота сообщества
        </div>
    
    
    </div>
    </div>
    </div>

<div class="whiteblock">
    <div class="container">
        <div class="col-lg-7">
            <h2 class="panelheader leftheader" style="">Тарифные планы</h2>
            <p class="panellegend">Получите 7 дней доступа ко всем функциям после регистрации</p>
        </div>
        <div class="col-lg-12" style="margin:70px 0;">
            <?php if($tariffs){ foreach($tariffs as $tariff){?>
        <div class="col-lg-4 ">
            <div class="tariffblock">
        <span class="head"><?=$tariff->name?></span>
         <div class="pull-right pricetitle"> руб<hr> мес</div>
        <span class="pull-right price"><?=$tariff->price?> </span>
        <div>
            <center style="color:grey;font-size:13px;">
                Для сообществ до <?=$tariff->members?> тысяч подписчиков
            </center>
        </div>
        <hr>
       <ul>
           <?=($tariff->command?"<li>Ответы на команды</li>":"")?>
           <?=($tariff->media?"<li>Ответы на медиафайлы</li>":"")?>
           <?=($tariff->macros?"<li>Макросы</li>":"")?>
           <?=((count($tariff->modules())==$tariff->enm_count())?"<li>Доступны все плагины</li>":"<li>Доступны некоторые плагины</li>")?>
           
        </ul>
        
        
        <center><a href="<?=Url::to("site/register")?>" class="tariffbtn">Попробовать бесплатно</a></center>
        </div>
        </div>
        <?php }}else echo"<center>Нет данных о тарифах</center>";?>
    </div>
</div>
</div>






<div class="cfirst" style="padding:70px 0;">
    <div class="container">
        <h2 class="panelheader leftheader">Плагины BotVK</h2>
        <p class="panellegend">Интерактивные функции для бота ВКонтакте</p>
        <div class="row" style="margin-top:90px;">
            <div class="col-lg-4 col-md-4">
                <div class="pluginblock">
                    <img src="/img/plugin1.svg">
                    <div>
                        <small>Интерактивный плагин</small>
                        <b>Перевод денег</b>
                        Позвольте пользователям бота оплатить покупку с помощью карты или Яндекс.Денег.
                    </div>
                </div>
            
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="pluginblock">
                    <img src="/img/plugin2.svg">
                    <div>
                        <small>Для заработка на боте</small>
                        <b>Анонимный чат</b>
                        Анонимный чат между пользователями ваших сообществ.
                    </div>
                </div>
            
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="pluginblock">
                    <img src="/img/plugin3.svg">
                    <div>
                        <small>Интерактивный плагин</small>
                        <b>Выдача ключей и скидок</b>
                        Раздача купонов, ключей и скидок в ограниченном количестве.
                    </div>
                </div>
            
            </div>
        
        
        </div>
    
    </div>


</div>



<div class="whiteblock" >
    <div class="container">
        <h2 class="panelheader">Как создать бота VK в 3 шага?</h2>
        <div class="row stepblock">
            <div class="col-lg-4 col-md-4">
                <img src="/img/step1.svg">
                Войдите в BotVK и подключите сообщества, в которых нужен бот
            </div>
            <div class="col-lg-4 col-md-4">
                <img src="/img/step2.svg">
                Настройте бота сами или используйте один из готовых шаблонов.
            </div>
            <div class="col-lg-4 col-md-4">
                <img src="/img/step3.svg">
                Пообщайтесь с ботом и расскажите о его появлении подписчикам!
            </div>
            <div class="col-lg-12 col-md-12">
                <center>
                    <a href="<?=Url::to("site/register")?>" class="tariffbtn">Попробовать бесплатно</a>
                </center>
            
            </div>
        </div>
    
    
    </div>


</div>





<div class="cfirst" style="padding-bottom:100px">
    <div class="container">
        <h2 class="panelheader ">За 3 года работы в BotVK были созданы сотни тысяч ботов</h2>
        
        <div class="row">
            <div class="col-lg-3 ">
                <div class="iconstat">
                    <span class="numcount">+300</span><small>тыс.</small>
                    <div>пользователей</div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="iconstat">
                    <span class="numcount">+400</span><small>тыс.</small>
                    <div>ботов создано</div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="iconstat">
                    <span class="numcount">+250</span><small>млн.</small>
                    <div>диалогов с пользователями</div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="iconstat">
                    <span class="numcount">+300</span><small>млрд.</small>
                    <div>сообщений отправлено</div>
                </div>
            </div>
        
        
        </div>
    
    </div>


</div>




<div class="whiteblock" >
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <h2 class="panelheader leftheader">Испытайте BotVK бесплатно в течение 7 дней</h2>
            </div>
            <div class="col-lg-5 col-md-5">
                <a href="<?=Url::to("site/register")?>" class="tariffbtn">Попробовать бесплатно</a>
            </div>
        </div>
    </div>


</div>




<div class="cfirst" style="padding:70px 0;">
    <div class="container">
        <h2 class="panelheader leftheader" style="margin-bottom:30px;">Мощные боты для вашей группы </h2>
        <div class="row">
            <div class="col-lg-12 col-md-12 seotext">
                Боты сообществ далеко не новый инструмент повышения интереса аудитории к сообществу. 
                Множество ботов принимают миллионы сообщений прямо сейчас. С сервисом BotVk любой пользователь сможет создать своего бота, и сразу начать пользоваться. Сервис имеет интуитивный интерфейс, при этом сохраняет мощность, позволяя создать уникальный инструмент для развлечений или монетизации сообществ.<br> Вы избавляете себя от многих проблем связанных с созданием ботов, мы взяли их на себя! Подключив сообщество вам лишь необходимо настроить нужные функции: отправка пользователям сообщения в ответ на команды, или реакции на медиафайлы и многие другие.  
            
                <br>
                Данная платформа по созданию ботов является мощным инструментом, для создания уникального бота в несколько шагов и с минимальными затратами. Тарифы рассчитаны на различные сообщества как по посещаемости так и по функциям, что позволит вам не переплачивать, при этом получить максимум от использования нашего сервиса.
            
            </div>
        
        </div>
    
    
    </div>


</div>
