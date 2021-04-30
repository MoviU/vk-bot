<?php
use app\widgets\ProtectMenu;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
echo ProtectMenu::widget();
?>
<div class="col-lg-12">
	<?php $form=ActiveForm::begin(["method"=>"get","action"=>Url::to(["protect/users"])]);?>
		<input type=text name="search" placeholder="Email, id, или vkid для поиска">
		<button class="btn btn-sm btn-primary">Поиск</button>
		<a href="<?=Url::to(["/protect/users"]);?>" class="btn btn-sm btn-default">Сброс</a>
	<?php ActiveForm::end(); ?>
</div>
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-body">
    <?php if($users){?>
<table class="table">
	<tr>
		<th>Пользователь</th>
		<th>Управление</th>
	</tr>
	<?php if($users){
foreach($users as $user){ ?>
	
	<tr>
		<td><?=($user->email?$user->email:"<a href='https://vk.com/id".$user->auth_id."'>{$user->auth_id}</a>")?></td>
		<td>
			<a class="btn btn-primary btn-sm" href="<?=Url::to(["/protect/users/edit","id"=>$user->id])?>">Анкета</a>

			
		</td>
	</tr>
	<?php }}else{ ?>
<tr><td colspan="2">Нет пользователей</td></tr>
	<?php } ?>
</table><?php } ?>
    <?php if($groups){?>
<table class="table">
	<tr>
		<th>Группа</th>
		<th>Детали</th>
	</tr>
	<?php if($groups){
foreach($groups as $group){ ?>
	
	<tr>
		<td><?=$group->name?></td>
		<td>
			<a class="btn btn-primary btn-sm" href="<?=Url::to(["/protect/users/edit","id"=>$group->user->id])?>">Анкета</a>

			
		</td>
	</tr>
	<?php }}else{ ?>
<tr><td colspan="2">Нет пользователей</td></tr>
	<?php } ?>
</table><?php } ?>

</div>
</div>
</div>
