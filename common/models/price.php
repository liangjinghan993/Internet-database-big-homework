<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 物价表
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property string|null $item_name
 * @property float|null $price
 * @property string|null $measurement
 * @property string|null $img_path
 * @property string|null $introduction
 * @property int|null $currency
 * @property string|null $t_class
 * @property string|null $title
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'currency'], 'integer'],
            [['price'], 'number'],
            [['item_name', 'measurement', 'img_path', 'introduction', 't_class', 'title'], 'string', 'max' => 255],
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
            'item_name' => 'Item Name',
            'price' => 'Price',
            'measurement' => 'Measurement',
            'img_path' => 'Img Path',
            'introduction' => 'Introduction',
            'currency' => 'Currency',
            't_class' => 'T Class',
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
    public function getItemName()
    {
        return $this->item_name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getMeasurement()
    {
        return $this->measurement;
    }

    public function getImg()
    {
        return $this->img_path;
    }

    public function getClass()
    {
        return $this->t_class;
    }

    public function getIntroduction()
    {
        return $this->introduction;
    }

    public function getCurrency()
    {
        switch($this->currency)
        {
            case 2:
                return "￥";
            case 3:
                return "€";
            case 4:
                return "Ұ";
            case 5:
                return "₴";
            case 6:
                return "₽";
            default:
                return "$";
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     * @return PriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriceQuery(get_called_class());
    }
}
