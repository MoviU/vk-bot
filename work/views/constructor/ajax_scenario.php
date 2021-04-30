
<?php
use yii\helpers\Url;
$counter = 0;
if(!empty($actions)){ foreach($actions as $action){
	$counter++;	 
?>
<div class="panel panel-default commandblock">
			<div class="panel-body">
				<div class="row">
				<div class="col-md-6">
						<div class="form-group">
						<label class="grey-text">Правило</label><br>
							Сообщение в точности совпадает с <b>
								<?php 
									$commands = explode(",", $action->command);
									if (count($commands) > 4) {
										for ($i = 0; $i < 4; $i++) {
											$sep = ', ';
											if ($i == 3) {
												$sep = '...';
											}
											echo $commands[$i] . $sep;
										}
									} else {
										foreach ($commands as $command) {
											$sep = ', ';
											if ($command == $commands[count($commands) - 1]) {
												$sep = '';
											}
											echo $command . $sep;
										}
									} 
								?>
							</b>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
						<label class="grey-text">Содержимое:</label><br>
						<div style="
border: 1px solid #4B77A6;display:inline-block;
box-sizing: border-box;font-size: 13px;
line-height: 12px;
border-radius: 50px;padding:8px 10px;color: #4B77A6;"><?=mb_substr($action->response,0,15).(mb_strlen($action->response)>15?"...":"")?></div>
						</div>
						
						<!--<input type="text" class="form-control" name="response" value="<?=$action->response?>">
						<input type=hidden name=id value="<?=$action->id?>">
						<input type=checkbox name="enabled" <?=($action->enabled?"checked":"")?> > 
						<?=($action->enabled?" Команда включена":" Команда выключена")?>
						<hr>
						-->
						
					</div>
					<div class="col-md-1">
						<button class="btn btn-default" onclick="window.location.href='<?=Url::to(["/constructor/ecommand","id"=>$action->id])?>'">
							<i class="fa fa-edit"></i>
						</button>
						
						<button class="btn btn-default btn-deletecom " data-id="<?=$action->id?>">
							<i class="fa fa-trash"></i>
						</button>
					</div>
					
		</div>
			</div>
		</div>
		
	<?php }}?>