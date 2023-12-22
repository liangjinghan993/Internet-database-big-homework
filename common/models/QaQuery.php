<?php

/**
 * Team: 抵制核污水小队
 * Created by 尚然.
 * 问答查询接口
 */

namespace common\models;

/**
 * This is the ActiveQuery class for [[Qa]].
 *
 * @see Qa
 */
class QaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Qa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Qa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
