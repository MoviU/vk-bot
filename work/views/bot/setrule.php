<?php

use app\models\BotcommandsHasVariables;
use yii\base\View;
use yii\bootstrap\ActiveForm as BootstrapActiveForm;
use yii\bootstrap\Html as BootstrapHtml;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View as WebView;
use yii\widgets\ActiveForm;

$vars = BotcommandsHasVariables::find()->where(['bot_id' => $bot->id, 'command_id' => $com->id])->all();
$items = ArrayHelper::map($vars, 'id', 'name');
$rules = [
    'var' => 'Переменная',
    'user_id' => 'id пользователя',
    'like' => 'Лайк записи',
    'repost' => 'Репост записи',
    'sex' => 'Пол',
    'city' => 'Город',
    'country' => 'Страна',
    'age' => 'Возраст',
    'name' => 'Имя',
    'birth_day' => 'День рождения',
    'week_day' => 'День недели',
    'current_date' => 'Текущая дата',
    'subscriber' => 'Подписчик',
    'family' => 'Семейное положение',
    'polytic' => 'Политическое положение',
    'alcohol' => 'Положение к алкоголю',
    'smoke' => 'Положение к курению',
];
?>
<?php $f = ActiveForm::begin(['options' => ['data' => ['pjax' => true]]]) ?>
            <div class="row">
            <div class="col-sm-2">
            <?= $f->field($model, 'when')->dropDownList([
                'if' => 'Если'
            ])->label(false) ?>
            </div>
            <div class="col-sm-2 var">
                <?= $f->field($model, 'rule_kind')->dropDownList($rules)->label(false) ?>
            </div>

            <div class="col-sm-3" id="variable">
            <?= $f->field($model, 'var')->dropDownList($items)->label(false) ?>

            </div>
            <div class="col-sm-2" id="rules">
            <?= $f->field($model, 'rule')->dropDownList([
                '==' => '=',
                '!=' => "≠",
                '>' => ">",
                '<' => '<', 
                '<=' => '≤',
                '>=' => '≥'
            ])->label(false) ?>
            </div>
            <div class="col-sm-2" id="rules2">
            <?= $f->field($model, 'rule')->dropDownList([
                'yes' => 'поствлен',
                'no'  => 'не поставлен'
            ])->label(false) ?>
            </div>
            <div class="col-sm-3" id="value">
            <?= $f->field($model, 'value')->textInput(['id' => 'test'])->label(false) ?>

            </div>
            <div class="col">
                <?= BootstrapHtml::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            </div>
            <?php ActiveForm::end() ?>
<?php
    $this->registerJsFile('/js/setrule.js');
?>