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


<style>
	.inputbox .form-control{
		padding:5px 10px;
	}
	.inputbox input,.inputbox textarea,.inputbox select{
		background: #FFFFFF;
		border: 1px solid #D1D9E0;
		box-sizing: border-box;
		border-radius: 8px;
		padding:1% 2%;
	}
	.panel{
		border-radius: 8px;
	}
</style>

<div class="col-lg-8 form-group" style="margin-right:-15px;margin-left:-15px;">
<h3>Создание списка</h3>
<p class="grey-text">Сбор списка получателей рассылки</p>
	<div class="panel-default panel">
		<div class="panel-body">
			<div style="display: flex;
justify-content: space-around;padding:5px;" class="inputbox">
			<select>
				<option>Если</option>
			</select>
			<select>
				<option>Переменная</option>
			</select>
			<input type=text placeholder="Введите значение">
			<select>
				<option>=</option>
			</select>
			
			<input type=text placeholder="Значение переменной">
			</div>
			<button class="writebotbtn"><i class="fa fa-plus"></i> Добавить условие</button>
		</div>
	</div>
	<div class="panel-default panel ">
		<div class="panel-body inputbox">
		
			<div class="form-group">
				<input type=text class="form-control" placeholder="Название списка">
			</div>
			<div class="form-group">
				<textarea class="form-control" placeholder="Название списка"></textarea>
			</div>
			<input type=checkbox> Добавить пользователей<br>
			<div class="form-group" style="margin-top:10px;">
				<textarea class="form-control" placeholder="Ссылки или id страниц пользователей ВКонтакте. Каждая ссылка с новой строки."></textarea>
			</div>
			<input type=checkbox> Исключить пользователей
			<div class="form-group" style="margin-top:10px;">
				<textarea class="form-control" placeholder="Ссылки или id страниц пользователей ВКонтакте. Каждая ссылка с новой строки."></textarea>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-4 leftblock" style="margin-top:20px;">
    <a href="<?=Url::to(["/constructor/commands","id"=>$bot->id])?>" class="t16">
        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.19926 9.13375L2.57342 5.5L6.19926 1.86625L5.08301 0.75L0.333008 5.5L5.08301 10.25L6.19926 9.13375Z" fill="#4B77A6"/>
        </svg>
        Отмена
    </a>
	
	<div style="margin-top:35px;">
        <button class="btn btnvk" style="width:100%" onclick="console.log($('.answerbox>div:first-of-type').parent().parent().find('textarea'));$('.answerbox>div:first-of-type').parent().parent().find('textarea').val($('.answerbox>div:first-of-type').html());alert();$('#actionform').submit();">Собрать список</button>
    
		
    </div>
	
</div>