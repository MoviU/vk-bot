<?php
use app\widgets\ProtectMenu;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
echo ProtectMenu::widget();
?>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
    <div class="panel-heading">Подключенные группы</div>
<div class="panel-body">
        <table class="table">
           
            
            <?php if($user->groups){ foreach($user->groups as $group){ ?>
                <tr>
                <td><img src="<?=$group->img?>"></td>
                <td>
                    ID <?=$group->group_id?> 
                    <a class="btn btn-success btn-xs" href="https://vk.com/club<?=$group->group_id?>" target="_blank">
                     Перейти
                    </a><br>
                     <?=$group->name?>
                </td>
                </tr>
            <?php }}else echo"<tr><td colspan=2>Нет подключенных групп</td></tr>"; ?>
            </tr> 
        </table>
    </div></div>
    </div>
    <div class="col-lg-6">
            <div class="panel panel-default">
    <div class="panel-heading">Основная информация </div>
<div class="panel-body">
        <table class="table">
            
            <?php if($user->email){ ?>
            <tr>
                <td>Email</td>
                <td><?=$user->email?></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><button class="btn btn-primary btn-xs">Установить новый пароль</button></td>
            </tr>
            <?php  }else{?>
            <tr>
                
                <td colspan=2>Авторизован через соц. сеть</td>
            </tr>
                
            <?php  }?>
                <tr>
                <td>Баланс</td>
                <td><?=$user->balance?> <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changebalance">Изменить</button></td>
            </tr>
           </table>
           </div></div>
                    <div class="panel panel-default">
    <div class="panel-heading">Подключенные аккаунты</div>
<div class="panel-body">
          <table>
            <?php if($user->vk){ foreach($user->vk as $page){?>
            <tr >
                
                <td ><img src="<?=$page->avatar?>"></td>
                
                <td style="padding-left:10px;">
                    Id <?=$page->account_id?>
                    <br><?=$page->last_name." ".$page->first_name?>
                </td>
            </tr>
            <?php }} else{echo" Нет подключенных аккаунтов";}?>
          
            
        </table>
    </div>
    </div>
    </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="changebalance">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Изменение баланса</h5>

      </div>
      <div class="modal-body">
        <?php $f = ActiveForm::begin(); ?>
  
            <div class="form-group">
                <!-- <label>Баланс <?//=$user->balance?></label>
                <input type=text name="amount" class="form-control" placeholder="На сколько изменить сумму"> -->
                <?= $f->field($model, 'amount')->textInput([
                    "class"       => 'form-control',
                    'placeholder' => 'На сколько изменить сумму'
                ])->label('Баланс: ' . $user->balance) ?>
            </div>
            <button class="btn btn-primary">Сохранить</button>
        <?php ActiveForm::end(); ?>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
