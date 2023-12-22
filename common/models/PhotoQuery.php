<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 查询照片接口
 */

namespace common\models;

/**
 * This is the ActiveQuery class for [[Photo]].
 *
 * @see Photo
 */
class PhotoQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Photo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Photo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
