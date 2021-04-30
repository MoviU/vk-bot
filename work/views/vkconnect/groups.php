<?php
use yii\helpers\Url;

?>
<h3>Подключение сообществ</h3>
<p>Вы можете подключать свои сообщества к нашей платформе.</p>
<div class="row">
    <div class="col-lg-12">
        <center>
            <a href="<?=$add_link?>" class="btn btn-primary">
                <i class="fa fa-plus"></i> 
                Подключить аккаунт
            </a>
        </center>
        <?php if(!empty($accounts)): ?> 
            <?php foreach($accounts as $account): ?>
                <?php if(isset($account)): ?>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="<?=Url::to(["vkconnect/grouplist","id"=>$account->id])?>">
                                    <img src="<?=$account->avatar?>">
                                    <?=$account->last_name." ".$account->first_name?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
