<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\Submenu;
?>
<?= Submenu::widget(["left"=>
        [
            "Конструктор"=>["class"=>"","href"=>Url::to(["/constructor"])],
            "Группы"=>["class"=>"active","href"=>Url::to(["/constructor/groups"])]
        
        ]]
        ) ?>
<div class="row templatelist">
<?php //var_dump($groups[0]->bot); die;?>
<?php if(!empty($groups)){
foreach($groups as $group){
 ?>
<div class="col-lg-3">
   <div class=" templatebar">
		<div class="panel panel-default">
			<div class="panel-body">
                 <div class="dropdown">
                <button class="btnabsolute dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-ellipsis-h"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<?php if($group->bot){?>
                        <li><a href="javascript:;" class="paid" data-price="<?=($group->bot->tariff?$group->bot->tariff->price:0)?>"><span class="glyphicon glyphicon-pencil"></span> Оплатить</a></li>
                        <li><a href="javascript:;" onclick="$.confirm({
    title: 'Подтверждение действия',
    content: 'Оплаченный период будет потерян без возврата средств.',
    buttons: {
        confirm: {
        text:'Подтвердить',
        action:function () {
            window.location.href='?untie=<?=($group->id)?>';
        }},
        cancel: {
        text:'Отменить',
        action:function () {
            
        }},
        
    }
});"><span class="glyphicon glyphicon-off"></span> Отвязать от бота</a></li>
                        
                        <?php }else{?>
                            <li><a href="<?=Url::to(['/constructor'])?>"><span class="glyphicon glyphicon-resize-small"></span> Привязать</a></li>
                        <?php } ?>
                      </ul>
                </div>
				
                
                <div class="" style="height:calc(100%);display: flex;
flex-direction: column-reverse;
justify-content: center;
align-content: center;
align-items: center;"> 
       <?php if($group->bot){         ?>
    <?=(strtotime($group->paid)>time()?"<p class='badge badge-success'>Оплачен до ".$group->paid."</p>":"<p class='badge badge-danger'  style='margin-top:5px;'>Неоплачен</p>")?>
    <small><?=($group->bot->tariff_id?"":"Тариф не выбран")?></small>
    <small >Привязан к <?=Html::encode($group->bot->name)?></small>

    <?php } ?>
    <h4 class="title" style="font-weight:bold;font-size:18px;margin-bottom:5px;"><?=Html::encode($group->name)?></h4>
    <br>
    <img class="img-circle" src="<?=$group->img?>">
    
    </div>

			</div>
		</div>
		</div>
</div>
<?php }} else{echo"<center>Нет подключенных групп. <br> Для подключения перейдите к настройкам профиля. <br><a href='/vkconnect/groups'>Перейти</a></center>";}?>
	</div>

</div>



<div class="modal" tabindex="-1" role="dialog" id="paybot">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		<h5 class="modal-title">Оплата тарифа</h5>
        
      </div>
      <div class="modal-body">
        <div class="lowbalance">
			<center>Недостаточно средств для оплаты.</center>
		</div>
		<div class="normalbalance">
			Для оплаты тарифа с вашего внутреннего счета будет списано  <span class="price"></span> руб.
			<br>
			Вы уверены что хотите произвести оплату?<br>
			<button class="btn btn-primary">Подтвердить списание</button>
		</div>
		
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
<?php
$balance = \Yii::$app->user->identity->balance;
$this->registerJS(<<<JS
$("a.paid").click(function(){
	var price = $(this).data("price");
	var user_balance = {$balance}
	if(user_balance>=price){
		$("#paybot .lowbalance").hide();
		$("#paybot .normalbalance").show();
	}else{
		$("#paybot .lowbalance").show();
		$("#paybot .normalbalance").hide();
	}
	$("#paybot .price").html(price);
	$("#paybot").modal("show");
});

JS
);
?>
