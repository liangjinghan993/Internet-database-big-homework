<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 历史浏览量统计表
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%historical_views}}".
 *
 * @property int $id
 * @property string|null $time
 * @property int|null $count
 */
class HistoricalViews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%historical_views}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'count' => 'Count',
        ];
    }

    /**
     * {@inheritdoc}
     * @return HistoricalViewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoricalViewsQuery(get_called_class());
    }
}
