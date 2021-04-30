<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variables_has_data".
 *
 * @property int $id
 * @property int $var_id
 * @property string $data
 * @property int $session_id
 */
class VariablesHasData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variables_has_data';
    }

    /**
     * {@inheritdoc}
     */
    // public function rules()
    // {
    //     return [
    //         [['var_id', 'data', 'session_id'], 'required'],
    //         [['var_id', 'session_id'], 'integer'],
    //         [['data'], 'string'],
    //         [['var_id'], 'unique'],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'var_id' => 'Var ID',
            'data' => 'Data',
            'session_id' => 'Session ID',
        ];
    }
}
