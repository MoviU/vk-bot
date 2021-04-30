<?php

use yii\base\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
  
$type_items = [
    '0' => 'Число',
    '1' => 'Строка'
];
$kind_items = [
    '0' => 'Нормальная',
    '1' => 'Глобальная'
];
?>
<div class="modal-body">
<div class="col-sm-8">
<table class="table t1">
    <thead>
    <tr>
        <th>Название</th>
        <th>Тип</th>
        <th>По умолчанию</th>
        <th>Описание</th>
       
    </tr>

    </thead>
    <tbody>


<?php if ($variables): ?>
    <?php foreach($variables as $var): ?>
        <tr>
            <td><?=$var->name?></td>
            <td>
                <?php
                    if($var->type == '0') {
                        echo 'Число';
                    } else {
                        echo 'Строка';
                    }
                ?>
            </td>
            <td><?=$var->default_int ? $var->default_int : $var->default_str?></td>
            <td><?=$var->description?></td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
    <td>Нету значений</td>
    <td>Нету значений</td>
    <td>Нету значений</td>
    <td>Нету значений</td>
    <?php endif;?>
</tbody>
</table>
</div>
<div class="col-sm-4">
    <?php $f = ActiveForm::begin(['method' => 'POST', 'options' => [
                'class' => 'form-group',
                'data' => ['pjax' => true]
            ]]) ?>

        <?= $f->field($model, 'name')->textInput(['class' => 'form-control'])->label('Название') ?>
        <?= $f->field($model, 'description')->textInput([
            'placeholder' => 'Например, баланс',
            'class' => 'form-control'
        ])->label('Описание') ?>
        <?= $f->field($model, 'type')->dropDownList($type_items, ['class' => 'form-control'])->label('Тип переменной') ?>
        <?= $f->field($model, 'kind')->dropDownList($kind_items, ['class' => 'form-control'])->label('Вид переменной') ?>
        <?= $f->field($model, 'default')->textInput(['class' => 'form-control'])->label('Значение по-умолчанию') ?>
        <?= $f->field($model, 'min')->input([
            'type' => 'number',
            'class' => 'form-control',
            'placeholder' => 'нет'
        ])->label('Мин. значение:')?>
        <?= $f->field($model, 'max')->input([
            'type' => 'number',
            'class' => 'form-control',
            'placeholder' => 'нет'
        ])->label('Макс. значение:')?>
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    
    <?php ActiveForm::end()?>

</div>
</div>
    <div class="modal-footer">


    </div>
