<?php
use app\widgets\Submenu;
use yii\helpers\Url;
?>
<style>

.menublock ul{
    padding-left:5px;
}
.menublock li:hover{
    background-color: #edf1f5;
}
.menublock li a{
    display: block;
    width: 100%;
    height: 100%;
    text-decoration: none;
}
.menublock li{
    text-overflow: ellipsis;
white-space: nowrap;
font-size: 14px;
line-height: 36px;
padding: 0 23px;
cursor: pointer;
color: #25435b;
list-style-type: none;
}
.menublock{
    /*position:fixed;*/
    background:white;
    margin-top:0px;
}
.table th,
.table td{
    text-align:center;
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
            "Сценарий"=>["class"=>"","href"=>Url::to(["/constructor/commands","id"=>$bot->id])],
            "Рассылка"=>["class"=>"","href"=>Url::to(["/bot/mailing","id"=>$bot->id])],
            "Статистика"=>["class"=>"active","href"=>Url::to(["/bot","id"=>$bot->id])]
        
        ]]) ?>
        <div class="col-md-8">
    <div class="panel panel-defaul">
            <div class="panel-body">
<table class="table t0">
    <tr>
        <th>Группа</th>
        <th>Сообщений</th>
        <th>Подписок</th>
        <th>Отписок</th>
    </tr>
    <?php if($groups){ foreach($groups as $group){?>
    <tr>
        <td><?=$group->name?></td>
        <td><?=$group->messages?></td>
        <td><?=$group->subscribe?></td>
        <td><?=$group->unsubscribe?></td>
    </tr>
    <?php }}?>

</table>
<table class="table t1 hide">
    <tr>
        <th>Команда</th>
        <th>Использовалась</th>
       
    </tr>
    <?php if($commands){ foreach($commands as $command){?>
    <tr>
        <td><?=$command->command?></td>
        <td><?=$command->uses?></td>
       
    </tr>
    <?php }}?>

</table>
</div>
</div>
</div>
<div class="col-lg-4">
    <div class="panel-vk menublock">
        <ul>
            <li><a href=".t0" class="toggle">Основное</a></li>
            <li><a href=".t1" class="toggle">Популярные команды</a></li>
        </ul>
    </div>
</div>
<?php
$this->registerJS(<<<JS
    $(".toggle").click(function(){
        $(".table").addClass("hide");
        $($(this).attr("href")).removeClass("hide");
        return false;
    });

JS
);
