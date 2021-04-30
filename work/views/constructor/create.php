<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


    ?>
<div class="row">
	<div class="col-lg-3">
        <div class="templatebar">
        <button style="text-align: center;color:  #4B77A6;" class="panel" data-toggle="modal" data-target="#createbot">
            <img src="/img/plus-ow.svg"><br>
Создать пустой шаблон
        </button>
        </div>
    </div>
		
`	<?php if(!empty($bots)){
		foreach($bots as $bot){
 ?>
<div class="col-lg-3">
   <div class=" templatebar">
		<a href="">
				<small>Создан: <?=$bot->timeaction?></small>
				<h4 class="title"><?=Html::encode($bot->name)?></h4>
<small>Команд: 0<br>Сообществ: 0</small><hr>
<center>
<a class="btn btn-success btn-xs" href="<?=Url::to(["constructor/edit","id"=>$bot->id])?>"><span class="glyphicon glyphicon-edit"></span> Редактировать</a>
<button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Удалить</button>

</center>
<a></a>
			</div>
		</div>
		
<?php }} ?>
	</div>

</div>


<div class="modal fade" tabindex="-1" role="dialog" id="createbot">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Новый бот</h4>
      </div>
      <div class="modal-body">
		<?php ActiveForm::begin(); ?>
			<div class="form-group">
				<label>Имя бота</label>
				<input class="form-control" type="text" maxlength="40" name="botname" value="Бот №<?=$number?>">
			</div>
			<div class="form-group">
				<button class="btn btn-primary">
					<span class="glyphicon glyphicon-play-circle"></span> Создать
				</button>
			</div>
		<?php ActiveForm::end(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


