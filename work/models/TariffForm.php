<?php
namespace app\models;
use Yii;
use yii\base\Model;

class TariffForm extends Model {
    public $name;
    public $price;
    public $members;

    public function rules() {
        return [
            [["name", "price", "members"], "required", 'message' => 'Вы ничего не ввели'],
            [['name'], 'string', 'min' => 3, 'max' => 30, 'tooShort' => 'Слишком маленькое название', 'tooLong' => 'Название слишком длинное'],
            [["price", "members"], 'integer']
        ];
    }
    
}
