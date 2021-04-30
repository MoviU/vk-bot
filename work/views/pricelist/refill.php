<?php
use yii\bootstrap\ActiveForm;
?>
<?php ActiveForm::begin() ?>
	<div class="form-group">
		<label>Сумма пополнения</label>
		<input type=text name=amount class="form-control">
	</div>
	<button class="btn btn-primary">Пополнить</button>
<?php ActiveForm::end() ?>