<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\Submenu;

if(\Yii::$app->session->hasFlash("success")){
		echo "<div class='alert alert-success'>".\Yii::$app->session->getFlash("success")."</div>";

}
?>
<?= Submenu::widget(["left"=>
        [
            "Конструктор"=>["class"=>"active","href"=>Url::to(["/constructor"])],
            "Группы"=>["class"=>"","href"=>Url::to(["/constructor/groups"])]
        
        ],
        "right"=>[
            "Мои сообщества (".$groupcount.")"=>["href"=>"javascript:;"]
        ]]) ?>
<div class="row templatelist">
	<div class="col-lg-3">
        <div class="templatebar">
        <button onclick="window.location.href='<?=Url::to(["/constructor/create"])?>'" style="text-align: center;color: #FFFFFF;" class="btn btn-primary" >
            <img src="/img/plus-o.svg" style="width:51px;height:51px;margin-bottom:25px;"><br>
Создать шаблон</button>
            </div>
            </div>
<?php if(!empty($bots)){
foreach($bots as $bot){
 ?>
<div class="col-lg-3">
   <div class=" templatebar">
		<div class="panel panel-default">
			<div class="panel-body">
                <div class="" style="height:calc(100% - 25px);overflow:hidden;"> 
                <div class="dropdown">
                <button class="btnabsolute dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-ellipsis-h"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="javascript:;" class="rename-btn" data-name="<?=$bot->name?>" data-id="<?=$bot->id?>"><span class="glyphicon glyphicon-pencil"></span> Переименовать</a></li>
                        <li><a href="javascript:;" class="grouplist-btn" data-id="<?=$bot->id?>"><span class="glyphicon glyphicon-eye-open"></span> Список групп</a></li>
                        <li><a href="<?=Url::to(["constructor/edit","id"=>$bot->id])?>"><span class="glyphicon glyphicon-edit"></span>  Редактировать</a></li>
                        <li><a href="<?=Url::to(["constructor/remove","id"=>$bot->id])?>"><span class="glyphicon glyphicon-trash"></span> Удалить</a></li>
                        
                      </ul>
                </div>
				<?php if(!$bot->groups){ ?>
				<h4 class="title" ><?=Html::encode($bot->name)?></h4>
<?php }else{ ?>
    <h4 class="title" style="font-weight:bold;font-size:18px;margin-bottom:5px;"><?=Html::encode($bot->name)?></h4>
    <?php foreach($bot->groups as $group){?>
    <small style="margin-bottom: 15px;font-size:13px;font-weight:normal;color:grey">Подключен к <?=$group->name?></small>
    <?php }} ?>
    
    </div>
<center>
    
<a class="btnaddgroup" href="<?=Url::to(["/constructor/groupconnect","bot_id"=>$bot->id])?>">
    <svg width="18" height="25" viewBox="0 -8 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6 7.5H3.75V5.25H2.25V7.5H0V9H2.25V11.25H3.75V9H6V7.5ZM13.5 8.25C14.745 8.25 15.7425 7.245 15.7425 6C15.7425 4.755 14.745 3.75 13.5 3.75C13.26 3.75 13.0275 3.7875 12.8175 3.855C13.245 4.4625 13.4925 5.1975 13.4925 6C13.4925 6.8025 13.2375 7.53 12.8175 8.145C13.0275 8.2125 13.26 8.25 13.5 8.25ZM9.75 8.25C10.995 8.25 11.9925 7.245 11.9925 6C11.9925 4.755 10.995 3.75 9.75 3.75C8.505 3.75 7.5 4.755 7.5 6C7.5 7.245 8.505 8.25 9.75 8.25ZM14.715 9.87C15.3375 10.4175 15.75 11.115 15.75 12V13.5H18V12C18 10.845 16.2225 10.1325 14.715 9.87ZM9.75 9.75C8.25 9.75 5.25 10.5 5.25 12V13.5H14.25V12C14.25 10.5 11.25 9.75 9.75 9.75Z" fill="#4B77A6"/>
    </svg>
    Подключить сообщество
</a>

    
</center> 
			</div>
		</div>
		</div>
</div>
<?php }} ?>
	</div>

</div>



<div class="modal fade" tabindex="-1" role="dialog" id="rename">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Изменение имени бота</h4>
      </div>
      <div class="modal-body">
        <?php ActiveForm::begin(); ?>
            <div class="form-group">
                <label>Новое имя</label>
                <input type=text name=name class="form-control">
                <input type=hidden name=id >
            </div>
            <button class="btn btn-primary">Изменить</button>
        <?php ActiveForm::end(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="group_list">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Подключенные группы</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$this->registerJS(<<<JS

    $(".rename-btn").click(function(){
        var id = $(this).data("id");
        $("#rename input[name=id]").val(id);
        $("#rename input[name=name]").val($(this).data("name"));
        $("#rename").modal("show");
    });
    
    $(".grouplist-btn").click(function(){
        var id = $(this).data("id");
        $.post("/bot/group_list",{id:id}).done(function(data){
            var jdata = JSON.parse(data);
             $("#group_list .modal-body").html("");
             if(jdata){
                $(jdata).each(function(i,el){
                    $("#group_list .modal-body").append("<div style='padding:5px;'><img src='"+el.img+"'> "+el.name+"</div>");
                });
            }else
                $("#group_list .modal-body").html("Нет данных");
            $("#group_list").modal("show");
        });
        
    });
JS
);?>
