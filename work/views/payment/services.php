
<style>
    .table td,.table th{
        padding:10px 15px !important;
    }
    .table>tbody>tr> td{
        line-height:50px;
    }
    .transpanel a{
        font-size: 14px;
        line-height: 36px;
        padding: 0 23px;
        cursor: pointer;
        color: #25435b;
        display: block;
        overflow: hidden;
    }
    .transpanel{
        padding: 12px 0;
        /*border-radius:8px;
        border: 1px solid #dadada;*/
    }
</style>

<div class="col-lg-8" style="margin-left:-15px;">
    <h3 style="margin-top:0px;">Оплата</h3>
    <p class="grey-text">Выбор сообщества для оплаты</p>
    <div class="panel panel-default">
        <table class="table">

            <tr>
                <th class="firstc">#</th>
                <th>Сообщество</th>
                <th>Тариф</th>
                <th class="paid_label">Истекает</th>
                <th>Стоимость</th>
            </tr>
            <?php 
            if(!$groups){?>
            <tr>
                <td colspan="4">Нет данных для отображения</td>
            </tr>
            
            <?php }else{ foreach($groups as $group){ ?>
                <tr >
                    <td class="firstc">
                        <input type=checkbox>
                    </td>
                    <td >
                        <img class="img-circle" src="<?=$group->img?>">
                        <?=$group->name?>
                    </td>
                    <td ><?=$group->bot->tariff->name?></td>
                    <td class="paid_time"><?=$group->paid?></td>
                    <td ><?=$group->bot->tariff->price?> <span class="glyphicon glyphicon-ruble"></span></td>
                </tr>
            <?php }} ?>
        </table>
        <hr>
        <div style="padding:0px 10px;margin-bottom:20px;">
            <div style="float:left;">Сумма<br>
            <span style="font-size:18px;">0</span> руб.
            </div>
            <button class="btn btnvk nextstep" style="float: right;display: block;">Далее</button>
            <div class="clearfix"></div>
        </div>
        
    </div>
</div>
<div class="col-lg-4">
    <button class="btn btnvk savebtn" style="width:100%;"><span class="glyphicon glyphicon-ruble"></span> Пополнить баланс</button>
    <div class="transpanel panel-vk" style="height:80px">
        <span class="glyphicon glyphicon-ruble" style="font-size:30px;display:inline-block;margin:5px 10px;width:50px;"></span> 
        <p style="margin-bottom:0px;float:right;width:calc(100% - 70px);">Ваш баланс
        <span style="font-size:20px;margin-top:5px;margin-bottom:15px;"><?=\Yii::$app->user->identity->balance?></span>
        </p>
        
    </div>
</div>
<?php
$this->registerJS(<<<JS
$(".nextstep").click(function(){
    $(".paid_label").html("Срок оплаты");
    $(".paid_time").html("\
    <select>\
        <option value=1>1 месяц(560руб - 0%)</option>\
        <option value=3>3 месяц(560руб - 3%)</option>\
        <option value=6>6 месяц(560руб - 5%)</option>\
        <option value=12>12 месяц(560руб -10%)</option>\
    </select>");
    $(".firstc").remove()
})
JS
,\yii\web\View::POS_LOAD
);
