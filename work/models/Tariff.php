<?php

namespace app\models;
use yii\db\ActiveRecord;

class Tariff extends ActiveRecord {
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public function modules(){
        return (array)json_decode($this->modules);
    }

    public function enm_count(){
        return array_sum(array_values($this->modules()));
    }

    /**
     * Table name
     *
     * @return string
     */
    public static function tableName() {
        return "{{tariff}}";
    }   
}

