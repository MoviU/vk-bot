<?php
use app\widgets\ProtectMenu;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
echo ProtectMenu::widget();
?>
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
<div class="panel-body">
		<table class="table">
			<tr><th>Тариф</th><th>Цена</th><th></th></tr>

<?php if(!empty($tariffs)){ foreach($tariffs as $tariff){ ?>
<tr>
	<td><?=$tariff->name?></td>
	<td><?=$tariff->price?></td>
	<td>
		<a href="<?=Url::to(["protect/tariff/remove","id"=>$tariff->id])?>">
			<span class="glyphicon glyphicon-trash"></span>
		</a>
		<a href="<?=Url::to(["protect/tariff/edit","id"=>$tariff->id])?>">
			<span class="glyphicon glyphicon-pencil"></span>
		</a>
	</td>
</tr>
<?php  }}else{echo"<tr><td colspan=3>Нет тарифов</td></tr>";}?>

		</table>
<center><button class="btn btn-primary" data-toggle="modal" data-target="#tariffbox">Добавить</button></center>
	</div>
	</div>
	</div>
    
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="tariffbox">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Новый тариф</h4>
      </div>
      <div class="modal-body">
        <?php ActiveForm::begin(); ?>
			<div class="form-group">
				<label>Название</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label>Цена</label>
				<input type="text" name="price" class="form-control">
			</div>
<div class="form-group">
				<button class="btn btn-primary">Сохранить</button>
			</div>
		<?php ActiveForm::end(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
