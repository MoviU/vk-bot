<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$items = [
    'positive' => 'Зеленый',
    'negative' => 'Красный',
    'primary'=>'Синий',
    'secondary'=>'Обычный'

];
$params = [
    'prompt' => 'Выберите цвет...'
];

$buttons = json_decode($keyboard)->buttons[0];
// return var_dump($buttons);
?>

<?php $f = ActiveForm::begin(["id"=>"actionform", 'options' => ['data-pjax' => true]]) ?>
    <?php if (!$buttons): ?>
        <div class="modal-button">

            <?= $f->field($model, 'label')->textInput([
                'value' => 'текст'
            ])->label('Текст') ?>
        </div>

    <?php else: ?>
        <?php foreach($buttons as $button): ?>   		
            <div class="modal-button">
                <?= $f->field($model, 'label')->textInput(['value' => $button->action->label])->label(false) ?>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

        <?=$f->field($model, 'color')->dropDownList($items, $params);?>
    
    <?=Html::submitButton('Сохранить', [
        'class' => 'btn btn-success'
    ]) ?>

<?php ActiveForm::end() ?> 
		<button class="modal-button-white"><i class="fa fa-plus"></i> Новая кнопка</button>
