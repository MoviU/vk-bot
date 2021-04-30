<?php
use app\widgets\ProtectMenu;
use \yii\bootstrap\ActiveForm;
use yii\helpers\Html;

echo ProtectMenu::widget();
?>
<style>
    .box{
        padding-top:15px;
        padding-bottom:15px;
    }
    .box div{
        padding-left:15px;
    }
</style>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Редактирование тарифа <?=$tariff->name?>
        </div>
        <div class="panel-body">
            <?php $f = ActiveForm::begin()?>
            <div class="form-group">
                <?= $f->field($model, 'name')->textInput([
                    'class' => 'form-control',
                    'label' => 'Название тарифа',
                    'value' => $tariff->name
                ]) ?>
            </div>
            <div class="form-group">
            <?= $f->field($model, 'price')->textInput([
                    'class' => 'form-control',
                    'label' => 'Стоимость',
                    'value' => $tariff->price
                ]) ?>
            </div>
            <div class="form-group">
                <?= $f->field($model, 'members')->textInput([
                    'class' => 'form-control',
                    'label' => 'Макс. количество подписчиков',
                    'value' => $tariff->members
                ]) ?>
            </div>
            <!-- <button class="btn btn-primary">Сохранить</button> -->
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end()?>
            
        </div>
    </div>
    
</div>
<div class="col-lg-6 modules">
        <div class="panel panel-default">
            <div class="panel-heading">
                Разрешения
            </div>
            <div class="panel-body">
                <?php $methods = ActiveForm::begin() ?>
                <div><input type=checkbox <?=($tariff->command?"checked":"")?> name="command"> Ответы на команды</div>
                <div><input type=checkbox <?=($tariff->macros?"checked":"")?> name="macros"> Макросы</div>
                <div><input type=checkbox <?=($tariff->media?"checked":"")?> name="media"> Ответы на медиафайлы</div>
                <div class="box">
                    <label><b>Модули</b></label>
                    <?php if($tariff->modules): ?>
                        <div><input type=checkbox <?=($tariff->modules->joke?"checked":"")?> name="modules[joke]"> Случайная шутка</div>
                        <div><input type=checkbox <?=($tariff->modules->facts?"checked":"")?> name="modules[facts]"> Случайный факт</div>
                        <div><input type=checkbox <?=($tariff->modules->quote?"checked":"")?> name="modules[quote]"> Случайная цитата</div>
                        <div><input type=checkbox <?=($tariff->modules->signa?"checked":"")?> name="modules[signa]"> Сигна</div>
                        <div><input type=checkbox <?=($tariff->modules->keyboard?"checked":"")?> name="modules[keyboard]"> Клавиатура</div>    
                        <div><input type=checkbox <?=($tariff->modules->rules?"checked":"")?> name="modules[rules]">Условия отправки</div>    
                        <div><input type=checkbox <?=($tariff->modules->vars?"checked":"")?> name="modules[vars]">Создание переменных</div>    

                    <?php else: ?>
                        <div><input type=checkbox name="modules[joke]"> Случайная шутка</div>
                        <div><input type=checkbox name="modules[facts]"> Случайный факт</div>
                        <div><input type=checkbox name="modules[quote]"> Случайная цитата</div>
                        <div><input type=checkbox name="modules[signa]"> Сигна</div>

                    <?php endif ?>
                </div>
                
                <?php ActiveForm::end() ?>
            </div>
        </div>
	</div>
<?php $this->registerJS(<<<JS
    $(".modules input[type=checkbox]").click(function(){
        var data = $(".modules form").serializeArray();
        $.post("/protect/tariff/modules/?id={$tariff->id}",data).done(function(){});
    });
JS
);

?>
