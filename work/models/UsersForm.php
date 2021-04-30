<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UsersForm extends Model {
    public $amount;

    public function rules()
    {
        return [
            [['amount'], 'required', 'message' => 'Вы ничего не ввели'],
            [['amount'], 'integer', 'max' => 9999999999, 'message' => 'Слишком большой баланс. Не больше 10 цифр']
        ];
    }
}