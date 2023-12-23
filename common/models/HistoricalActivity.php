<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 历史操作表
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "historical_activity".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $time
 * @property string|null $table_name
 * @property string|null $operation
 */
class HistoricalActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historical_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['time'], 'safe'],
            [['table_name'], 'string', 'max' => 255],
            [['operation'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'time' => 'Time',
            'table_name' => 'Table Name',
            'operation' => 'Operation',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivityQuery(get_called_class());
    }
}
