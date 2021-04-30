<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Botcommand extends ActiveRecord {
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * Table name
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{botcommand}}';
    }

}
