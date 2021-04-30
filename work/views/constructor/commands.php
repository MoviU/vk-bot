<?php

use yii\web\View;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\widgets\Submenu;

$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css");
?>
<style>
    .commandblock .btn-default{
		background: #EDF2F7;
		border-radius: 8px;
		color: #4B77A6;
		width: 30px;
		height: 30px;
		padding: 0px;
		text-align: center;
		margin-bottom:5px;
	}
    .commandblock{
		padding:15px;
		border-radius: 8px;
	}
	.commandblock label.grey-text{
		color: #24282D;
		opacity: 0.5;
		font-size: 14px;
		line-height: 13px;
		margin-bottom: 10px;
		display:inline-block;
	}
	.searchcommand{
		background: #FFFFFF;
		border: 1px solid #D1D9E0;
		box-sizing: border-box;
		border-radius: 8px;
		width:100%;font-size: 15px;
		line-height: 14px;
		color: #24282D88;
		height:45px;
		padding:15px 20px;
	}
	.command-container .input-group-addon{
		background:white;
		border-right: 1px
		white solid;
		border-top-left-radius: 8px;
		border-bottom-left-radius: 8px;
	}
	.command-container .form-control.searchcommand {
		border-left: 0px;
	}
	.command-container .input-group{
		margin-bottom:20px;
		margin-top:20px;
	}
</style>
<?= Submenu::widget(["left"=>
        [
            "<i class='fa fa-arrow-left' style='font-size:20px;'></i>"=>["class"=>"","href"=>Url::to(["/constructor"])],
            ($bot->group?"<img class='img-circle' style='float:left;margin-top:10px;margin-right:10px;' src='".$bot->group->img."'>":"").
            " <div class='' style='float:left;line-height: 18px;margin-top: 20px;margin-right: 20px;font-size: 14px;color: #24282D;'>".$bot->name."<br>".($bot->group?"<span style='font-size: 13px;
line-height: 12px;color: #24282D;'>".$bot->group->name."</span>":"")."</div>"=>["class"=>"","href"=>Url::to(["/constructor/edit","id"=>$bot->id])],
        ($bot->group?('<button class="writebotbtn" onclick="window.open(\'https://vk.com/club'.$bot->group->group_id.'\')"><img src="/img/vk.svg">
Написать боту</button>'):"")
        
        ],"right"=>[
            "Конструктор"=>["class"=>"","href"=>Url::to(["/constructor/edit","id"=>$bot->id])],
            "Сценарий"=>["class"=>"active","href"=>Url::to(["/constructor/commands","id"=>$bot->id])],
            "Рассылка"=>["class"=>"","href"=>Url::to(["/bot/mailing","id"=>$bot->id])],
            "Статистика"=>["class"=>"","href"=>Url::to(["/bot","id"=>$bot->id])]
        
        ]]) ?>


<h3>Команды бота</h3>
<div class="row">

	<div class="col-lg-3">
	<div class="panel panel-default commandblock">
<div class="panel-body">
	<div class="row">
	<?php if(\Yii::$app->getSession()->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?= \Yii::$app->getSession()->getFlash('success') ?>
                </div>
        <?php endif; ?>
	</div>
		<small>Блок действия</small>
        <?php $f = ActiveForm::begin(); ?>
		<div class="form-group">
		<!-- <label>Команда</label>
		<input type="text" id="input-tags" class="form-control" name="command"> -->
		<?= $f->field($model, 'command')->textInput([
			'maxlength' => 255,
			'class'     => 'from-control',
			'id' 		=> 'input-tags'
		])->label('Команда') ?>
		</div>
		<div class="form-group">
		<!-- <label>Ответ</label>
		<input type="text" class="form-control" name="response"> -->
		<?= $f->field($model, 'response')->textInput([
			'maxlenght' => 255,
			'class'		=> 'form-control'
		])->label('Ответ') ?>
		</div>
        
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
		</div>
         <?php ActiveForm::end(); ?>
</div>
	</div>
	</div>
	
    
	<div class="col-lg-8 command-container">
		<div class="input-group">
		  <div class="input-group-addon"><i class="fa fa-search"></i></div>
		  <input type=text placeholder="Найти команду" class="form-control searchcommand ">
		</div>
		<div class="command_list">
	   
	   
		
		</div>
	</div>
	<!-- <div class="col-lg-4">
		<a href="<?//= Url::to(['/constructor/createcommand', 'id' => $id]) ?>"><button class="btn btnvk" style="width:100%;margin-top:20px;"><i class="fa fa-plus"></i> Создать команду</button></a>
	</div> -->
</div>
<?php
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js",
    ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs(<<<JS
var bot_id = $id;

function remove_BTN_E(){
	
	$(".btn-deletecom").click(function(){
		$.get("/constructor/removecommand",{command_id:$(this).data("id")}).done(function(data){
			$(".command_list").html(data);
			remove_BTN_E()
		});
	});
}


$(".searchcommand").keyup(function(){
	$.get("/constructor/ajaxcommand",{id:bot_id,search:$(this).val()}).done(function(data){
		$(".command_list").html(data);
		remove_BTN_E()
	});
	
});


$.get("/constructor/ajaxcommand",{id:bot_id}).done(function(data){
	$(".command_list").html(data);
	remove_BTN_E()
});

$('#input-tags').selectize({
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});
JS
,View::POS_LOAD
);
?>
