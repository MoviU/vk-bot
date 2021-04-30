<?php

namespace app\models;

use yii\base\Model;

class KeyboardForm extends Model {
    
    public $label;
    public $color = 'secondary';

    public function rules()
    {

        return [
            [['label', 'color'], 'required', 'message' => 'Вы ничего не ввели']
        ];

    }
    
}
