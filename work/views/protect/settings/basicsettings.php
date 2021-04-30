<?php
use app\widgets\ProtectMenu;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
echo ProtectMenu::widget();
?>
<div class="col-lg-12">
    <div class="panel panel-default">
    <div class="panel-heading">
        Базовые настройки сайта
        </div>
<div class="panel-body">


	<div class="">
	<?php $form = ActiveForm::begin();?>
		<div class="form-group">
			<label>Ссылка на поддержку</label>
			<input type="text" name="supportlink" value="<?=$contacts["supportlink"]?>" class="form-control">
		</div>
		<div class="form-group">
			<label>Контакты(VK)</label>
			<input type="text" name="vkcontact" value="<?=$contacts["vkcontact"]?>" class="form-control">
		</div>
		<div class="form-group">
			<label>Контакты(Email)</label>
			<input type="text" name="email" value="<?=$contacts["email"]?>" class="form-control">
		</div>
<div class="form-group"><button class="btn btn-primary">Сохранить</button></div>
	<?php ActiveForm::end();?>
	</div>

</div>
</div>
</div>
