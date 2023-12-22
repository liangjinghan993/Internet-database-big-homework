<?php

/**
 * Team: 抵制核污水小队
 * Created by 尚然.
 * 用户查询接口
 */

namespace common\models;

/**
 * Team: 抵制核污水小队
 * Created by 尚然.
 * 用户查询接口
 */

/**
 * This is the ActiveQuery class for [[User]].
 *
 * @see User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
