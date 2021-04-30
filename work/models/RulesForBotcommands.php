<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rules_for_botcommands".
 *
 * @property int $id
 * @property string $when
 * @property int $var_id
 * @property string $rule
 * @property string $value
 */
class RulesForBotcommands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rules_for_botcommands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['when', 'var_id', 'rule', 'value'], 'required'],
            [['var_id'], 'integer'],
            [['when'], 'string', 'max' => 32],
            [['rule'], 'string', 'max' => 2],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'when' => 'When',
            'var_id' => 'Var ID',
            'rule' => 'Rule',
            'value' => 'Value',
        ];
    }
}
