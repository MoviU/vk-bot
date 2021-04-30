<?php

use yii\helpers\Url;
?>
<h3>Сообщества аккаунта</h3>
<p>Вы можете подключать свои сообщества предоставив доступ.</p>
<div class="row">
    <div class="col-lg-3">
        <div class="panel panel-default">
                <div class="panel-body">
                    <img src="<?=$account->avatar?>">
                    <?=$account->last_name." ".$account->first_name?>
                </div>
        </div>
        
    </div>
    <div class="col-lg-9">
        <h6>Найдено сообществ: <?=$groups["count"]?></h6>
        <?php if($groups["count"]>0){ foreach($groups["items"] as $group){?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="<?=$group["photo_50"]?>">
                    <b><?=$group["name"]?></b>
                    <?php if(!$group["connect"]){ ?>
                    <a href="<?=Url::to(["vkconnect/addgroup","profile_id"=>$account->account_id,"group_id"=>$group["id"]])?>" class="btn pull-right btn-success"><i class="glyphicon glyphicon-plus"></i> Подключить</a>
                    <?php }else{ ?>
                        <a href="<?=Url::to(["vkconnect/addcallback","group_id"=>$group["id"]])?>" class="btn pull-right btn-success"><i class="glyphicon glyphicon-plus"></i> Добавить сервер</a>
                    
                        <span class="badge pull-right" style="background:green; color:white;"><i class="fa fa-check"></i> Подключено</span>
                    <?php } ?>
                    
                </div>
            </div>
        <?php }} ?>
    </div>
</div>
