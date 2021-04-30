<?php
use app\widgets\Submenu;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use app\components\MacrosHandler;
?>

<?= Submenu::widget(["left"=>
        [
            "<i class='fa fa-arrow-left' style='font-size:20px;'></i>"=>["class"=>"","href"=>Url::to(["/constructor"])],
           ($bot->group?"<img class='img-circle' style='float:left;margin-top:10px;margin-right:10px;' src='".$bot->group->img."'>":"").
            " <div class='' style='float:left;line-height: 18px;margin-top: 20px;margin-right: 20px;font-size: 14px;color: #24282D;'>".$bot->name."<br>".($bot->group?"<span style='font-size: 13px;
line-height: 12px;color: #24282D;'>".$bot->group->name."</span>":"")."</div>"=>["class"=>"","href"=>Url::to(["/constructor/edit","id"=>$bot->id])],
        ($bot->group?('<button class="writebotbtn" onclick="window.open(\'https://vk.com/club'.$bot->group->group_id.'\')"><img src="/img/vk.svg">
Написать боту</button>'):"")
        ],"right"=>[
            "Настройки"=>["class"=>"","href"=>Url::to(["/constructor/edit","id"=>$bot->id])],
            "Сценарий"=>["class"=>"active","href"=>Url::to(["/constructor/create"])],
            "Рассылка"=>["class"=>"","href"=>Url::to(["/constructor/create"])],
            "Статистика"=>["class"=>"","href"=>Url::to(["/bot","id"=>$bot->id])]
        
        ]]) ?>




<div class="col-lg-8 form-group" style="margin-right:-15px;margin-left:-15px;">
<h3>Отправленная рассылка</h3>
<p class="grey-text">Массовая рассылка по пользователям</p>
	<textarea class="form-control" readonly></textarea>
		
</div>

<div class="col-lg-4 leftblock" style="margin-top:20px;">
    <a href="<?=Url::to(["/constructor/commands","id"=>$bot->id])?>" class="t16">
        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.19926 9.13375L2.57342 5.5L6.19926 1.86625L5.08301 0.75L0.333008 5.5L5.08301 10.25L6.19926 9.13375Z" fill="#4B77A6"/>
        </svg>
        Назад
    </a>
	
	<div style="margin-top:35px;">
        <button class="btn btnvk" style="width:100%" onclick="console.log($('.answerbox>div:first-of-type').parent().parent().find('textarea'));$('.answerbox>div:first-of-type').parent().parent().find('textarea').val($('.answerbox>div:first-of-type').html());alert();$('#actionform').submit();">Копировать рассылку</button>
    
		
    </div>
	<div class="" style="margin-top:20px;text-align:center;">
		<i style="font-size:20px;" class="fa fa-group"></i>
		<b style="font-size:24px;">10 200</b> <span class="grey-text">получателей</span>
	</div>
	
	
	
	
	<div class="panel-vk">
        <b>Статус: </b> <div class="pull-right" style="color:#26C281;"><i class="fa fa-check"></i> Отправлена</div>
        <div style="margin-top:20px">Отправлена: 20 сентября 2020, 19:50</div>
    </div>
</div>
