<?php

namespace app\models;

use yii\base\Model;

class VariablesForm extends Model {
    
    public $name;
    public $description;
    public $type;
    public $kind;
    public $default;
    public $min;
    public $max;

    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Вы ничего не ввели'],
            [['name', 'description', "default"], 'string', 'max' => 255, 'tooLong' => 'Слишком много символов(не больше 255)'],
            [['type', 'kind', 'min', 'max'], 'string']
        ];
    }
    
}
