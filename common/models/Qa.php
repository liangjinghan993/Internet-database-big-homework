<?php

/**
 * Team: 抵制核污水小队
 * Created by 尚然.
 * 问答表
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "qa".
 *
 * @property int $id
 * @property string|null $question
 * @property string|null $answer
 * @property int|null $status
 * @property int|null $priority
 */
class Qa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'priority'], 'integer'],
            [['question', 'answer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'status' => 'Status',
            'priority' => 'Priority',
        ];
    }

    /**
     * {@inheritdoc}
     * @return QaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QaQuery(get_called_class());
    }
}
