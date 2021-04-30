<?php
use yii\helpers\Url;
use app\widgets\Submenu;

?>
<style>
	.nav-tabs > li{
		
		border-bottom:2px solid transparent;
		
	}
	.nav-tabs > li a{
		color: #24282D;
		border:0px;
		opacity: 0.7;
		pading-bottom:10px;
		background:transparent;
		font-size: 20px;
		line-height: 130%;
	}
	.nav-tabs > li.active{
		border-bottom:2px solid #4B77A6;
	}
	.nav-tabs > li.active>a,.nav-tabs > li.active>a:hover,.nav-tabs > li.active>a:focus,.nav-tabs > li.active>a:active{
		color: #4B77A6;
		opacity: 1;
		border:0px;
		pading-bottom:10px;
		background:transparent;
		
	}
	.partdetail{
		color: #24282D;
		opacity: 0.7;
		font-size: 16px;
		line-height: 15px;
	}
	.table > tbody > tr > th{
		color: #24282D;
		opacity: 0.7;
	}
	.table > tbody > tr > th{
		border-top: 1px solid #D1D9E000;;
	}
	.table > tbody > tr > td{
		border-top: 1px solid #D1D9E0;;
		padding-top:15px;
		padding-bottom:15px;
		line-height:30px;
	}
	.tab-pane h3{
		color: #24282D;
		font-size: 28px;
		line-height: 120%;
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
            "Рассылка"=>["class"=>"active","href"=>Url::to(["/bot/mailing","id"=>$bot->id])],
            "Статистика"=>["class"=>"","href"=>Url::to(["/bot","id"=>$bot->id])]
        
        ]]) ?>

<!--
<a href="<?=Url::to(['/bot/parsemembers',"id"=>$bot->id])?>" class="btn btn-primary">
    Собрать пользователей для рассылки
</a>
<a href="<?=Url::to(['/bot/import',"id"=>$bot->id])?>" class="btn btn-primary">
    Импорт собранных пользователей
</a>
<div class="">
<table class="table">
    <tr>
        <th>Название</th>
        <th>Пользователей</th>
    </tr>
    <?php if($gcounter){ foreach($gcounter as $counter){?>
    
    <tr>
        <td><?=$counter->name?></td>
        <td><?=$counter->users?></td>
    </tr>
        
    <?php }}else echo" <tr><td colspan=2>Для начала нужно собрать базу пользователей</td></tr>";?>
</table>

</div>-->
<div class="col-md-8">
	<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Рассылки</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Списки</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
		<h3>Отправленные рассылки</h3>
		<p  class="partdetail">История рассылок по подписчикам</p>
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table">
					<tr>
						<th>Сообщение</th>
						<th>Получателей</th>
						<th>Дата</th>
					</tr>
					<tr>
						<td>Привет. Покупай скорее! Скидки!</td>
						<td>10 365</td>
						<td>30 сентября 2020, 12:00</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
    <div role="tabpanel" class="tab-pane" id="profile">
		<h3>Списки</h3>
		<p class="partdetail">Группы пользователей для таргетинговой рассылки</p>
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table">
					<tr>
						<th>Название</th>
						<th>Пользователей</th>
						<th></th>
						
					</tr>
					<tr>
						<td>Все пользователи</td>
						<td>10 365</td>
						<td>
							<button class="writebotbtn" onclick="window.location.href='<?=Url::to(["/bot/emailing", "id" => $bot->id])?>'" style="padding:9px 15px;margin-top:0px;font-size: 13px;
line-height: 12px;">Создать рассылку</button> 
							<button class="writebotbtn" style="padding:9px 15px;margin-top:0px;font-size: 13px;
line-height: 12px;">Обновить</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
   
  </div>

</div>
</div>
<div class="col-lg-4">
	<button class="btn btnvk" style="width:100%;margin-top:20px;">
		<svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M0.839674 12L14.833 6L0.839674 0L0.833008 4.66667L10.833 6L0.833008 7.33333L0.839674 12Z" fill="white"/>
		</svg>

		Создать рассылку
	</button>
	<button class="btn btnvk-o" style="width:100%;margin-top:20px;" data-toggle="modal" data-target="#createlist">
		<i class="fa fa-group"></i>
		Создать список
	</button>
	<div class="" style="margin-top:20px;">
		<i class="fa fa-info" style="width: 23px;
			height: 23px;
			border: 2px #4B77A6 solid;
			text-align: center;
			font-size: 17px;color: #4B77A6;
			border-radius: 50px;"></i>
		<p style="float: right;width: calc(100% - 37px);color: #24282D;opacity: 0.8;">
			Пользователи в любой момент могут отписаться от рассылок командой /отписаться — напоминайте им об этом.
		</p>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="createlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Загрузка списка рассылки</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <?php if($groups){ 
					foreach($groups as $group){  ?>
				<div class="col-md-4" style="border: 2px #4b77a6 solid; padding: 3px;">
					<img src="<?=$group->img?>">
					<b><?=$group->name?></b>
				</div>
				<?php } 
		} ?>
          </div>
          
          
          <label>Прогресс</label>
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            0%
          </div>
        </div>
        <hr>
        <p><center>Создать список </center></p>
        <button class="btn btn-primary btnvk">По подписчикам</button>
        <button class="btn btn-primary btnvk">По диалогам</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>

      </div>
    </div>
  </div>
</div>

<?php 
if ($groups) {
	$this->registerJS(<<<JS
    function listusers( id, bar) {
       $("#bccfon").show();
       var users = [];
       $.ajax({
           url: "https://api.vk.com/method/messages.getDialogs?count=200&access_token={$bot->groups[0]->access_token}&v=5.120",
           method: "POST",
           dataType: 'jsonp'
       }).success(function(data) {
           console.log(data);
           $("#count").html(data.response.count);
           var count = data.response.count;
           var tim = 1;
           for (var i = 0; i < count; i += 200) {
               setTimeout(getusbyid, 300 * tim, users, i, token, count, bar);
               tim++;
           }
           setTimeout(loaduserstoserver, 300 * tim+2000, users, id, bar);
       });
   }
	function getusersbygroup(users, i, all, bar) {
       $.ajax({
           url: "https://api.vk.com/method/groups.getMembers?group_id={$bot->groups[0]->group_id}&count=200&offset=" + i + "&access_token={$bot->groups[0]->access_token}&v=5.120",
           method: "POST",
           async: false,
           dataType: 'jsonp',
           success: function(fdata) {
              for (var t = 0; t < 200; t++) {
                           if (typeof fdata.response.items[t] === 'undefined') break;
                           users.push(fdata.response.items[t]);
                       }
			   $("#bccfon .text").html("<div style='text-align: center;'><br>Собрано "+users.length+" из "+all+".</div>");
               console.log(users.length);
			   bar.animate(users.length/all);
           }
       });
	}
JS
);

}
