<?php

namespace app\models;

use yii\base\Model;

class SetRuleForm extends Model {
    
   public $var;
   public $value;
   public $when;
   public $rule_kind;
   public $rule; 

   public function rules()
   {
       return [
           [['var', 'value', 'when', 'rule', 'rule_kind'], 'required', 'message' => 'Вы ничего не ввели']
       ];
   }

}
