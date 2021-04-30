<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "botcommands_has_variables".
 *
 * @property int $id
 * @property string $name
 * @property string $type 0 - int. 1 - str
 * @property string $kind 0 - normal. 1 - global. 2 - dynamic
 * @property string|null $default_int
 * @property string|null $default_str
 * @property int|null $max_int
 * @property int|null $min_int
 * @property int $bot_id
 * @property int $command_id
 * @property string $description
 */
class BotcommandsHasVariables extends \yii\db\ActiveRecord
{
    const VAR_INT_TYPE = 0;
    const VAR_STR_TYPE = 1;
    const VAR_NORMAL_KIND = 0;
    const VAR_GLOBAL_KIND = 1;
    const VAR_DYNAMIC_KIND = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'botcommands_has_variables';
    }

    /**
     * {@inheritdoc}
     */
    // public function rules()
    // {
    //     return [
    //         [['name', 'type', 'kind', 'bot_id', 'command_id', 'description'], 'required'],
    //         [['bot_id', 'command_id'], 'integer'],
    //         [['name', 'default_int', 'default_str', 'description', 'max_int', 'min_int'], 'string', 'max' => 255],
    //         [['type', 'kind'], 'string', 'max' => 1],
    //         [['name'], 'unique'],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'kind' => 'Kind',
            'default_int' => 'Default Int',
            'default_str' => 'Default Str',
            'max_int' => 'Max Int',
            'min_int' => 'Min Int',
            'bot_id' => 'Bot ID',
            'command_id' => 'Command ID',
            'description' => 'Description',
        ];
    }
}
