<?php
use yii\helpers\Url;
?>
<div class="col-lg-12">
    <?php if($groups){ foreach($groups as $group){?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="<?=$group["img"]?>">
                    <b><?=$group["name"]?></b>
                    <?php if($group["bot_id"] != $bot->id){?>
                    <a class="btn btn-primary" 
                        href="<?=Url::to(["/constructor/groupconnect","bot_id"=>$bot->id,"group_id"=>$group["id"]])?>">
                        <i class="fa fa-plus"></i> Подключить
                    </a>
                    <?php } ?>
                </div>
            </div>
        <?php }} ?>


</div>
