<?php
use yii\helpers\Url;

?>

<div class="adminmenu">
	<ul>
		<li><a class="btn-primary btn btn-xs" href="<?=Url::to(["protect/users"])?>">Пользователи</a></li>
		<li><a class="btn-primary btn btn-xs" href="<?=Url::to(["protect/settings"])?>">Настройки сайта</a></li>
        <li><a class="btn-primary btn btn-xs" href="<?=Url::to(["protect/tariff"])?>">Тарифы</a></li>
	</ul>

</div>
