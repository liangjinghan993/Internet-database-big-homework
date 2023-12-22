<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 图片类
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $details
 * @property string|null $path
 * @property string|null $time
 * @property string|null $introduction
 * @property string|null $title
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['type', 'details', 'path', 'time', 'introduction', 'title'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Photo Name',
            'details' => 'Details',
            'path' => 'Path',
            'time' => 'Photo Time',
            'introduction' => 'Introduction',
            'title' => 'Title',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->type;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function getGTime()
    {
        return $this->time;
    }


    public function getIntroduction()
    {
        return $this->introduction;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     * @return PhotoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhotoQuery(get_called_class());
    }
}
