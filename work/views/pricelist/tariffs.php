<?php

?>
<link href="/css/tariff.css" rel="stylesheet">
<div class="row">
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
            <!--  <li>Фильтры для рассылки</li>
           <li>Уведомления о сообщениях</li>
            <li>Отправка записей и видео</li>
            <li>Клавиатура команды</li>
            <li>Ответ в комментариях</li>
            <li>Ветвление команд</li>
            
            <li>Макросы</li>
            <li>Все плагины кроме оплаты</li>
        
        -->
        </ul>
        
        
        <center><button class="tariffbtn">Попробовать бесплатно</button></center>
        </div>
        </div>
        <?php }}else echo"<center>Нет данных о тарифах</center>";?>
    
</div>
