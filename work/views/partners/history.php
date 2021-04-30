<style>
    .circleblock{
        border-radius:1000px;
        background:#229999;
        color:white;
        text-align:center;
    }
</style>

    <div class="col-lg-8">
        <!--<h4>До повышения выплат</h4>
         <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
            40%
          </div>
        </div> -->
        <div class="form-group">
            <label>Ваша партнерская ссылка</label>
            <input type=text readonly class="form-control" value="https://google.com/partner/1323">
        </div>
        
        <table class="table">

	<tr>
		<th>Дата</th>
		<th>Пользователь</th>
		<th>Заработано</th>
		
	</tr>
	<tr>
		<td colspan="3">Нет данных для отображения</td>
	</tr>
</table>
    </div>
    
<div class="col-lg-4">
    <button class="btn btnvk savebtn" style="width:100%;"><span class="glyphicon glyphicon-ruble"></span> Управление балансом</button>
    <div class="transpanel panel-vk" style="height:80px">
        <span class="glyphicon glyphicon-ruble" style="font-size:30px;display:inline-block;margin:5px 10px;width:50px;"></span> 
        <p style="margin-bottom:0px;float:right;width:calc(100% - 70px);">Реферальный баланс 
        <span style="font-size:20px;margin-top:5px;margin-bottom:15px;"><?=\Yii::$app->user->identity->balance?></span>
        </p>
        
    </div>
    <div class="transpanel panel-vk" style="height:80px;margin-top:10px;">
        <span class="glyphicon glyphicon-user" style="font-size:30px;display:inline-block;margin:5px 10px;width:50px;"></span> 
        <p style="margin-bottom:0px;float:right;width:calc(100% - 70px);">Пользователей
        <span style="font-size:20px;margin-top:5px;margin-bottom:15px;"><?=\Yii::$app->user->identity->balance?></span>
        </p>
        
    </div>
    <div class="transpanel panel-vk" style="height:80px;margin-top:10px;">
        <span class="glyphicon glyphicon-stats" style="font-size:30px;display:inline-block;margin:5px 10px;width:50px;"></span> 
        <p style="margin-bottom:0px;float:right;width:calc(100% - 70px);">Ставка
        <span style="font-size:20px;margin-top:5px;margin-bottom:15px;">10%</span>
        </p>
        
    </div>
</div>

