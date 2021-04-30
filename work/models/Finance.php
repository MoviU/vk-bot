<?php
namespace app\models;
use yii\db\ActiveRecord;

class Finance extends ActiveRecord{
    const STATUS_COMPLETE=1;
    const STATUS_WAIT=0;
    const TYPE_REFILL=0;
    const TYPE_WITHDRAW=1;
    
}
