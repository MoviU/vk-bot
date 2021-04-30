<?php

namespace app\models;

use yii\base\Model;

class BotcommandForm extends Model {
    
    public $command;
    public $response;

    public function rules()
    {
        
        return [
            [['command', 'response'], 'required', 'message' => 'Вы ничего не ввели'],
            ['command', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Не меньше 2 симоволов', 'tooLong' => 'Не больше 255 символов'],
            ['response', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Не меньше 2 симоволов', 'tooLong' => 'Не больше 255 символов'],
        ];

    }
    
}
