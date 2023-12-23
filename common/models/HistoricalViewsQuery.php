<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 历史浏览量统计查询接口
 */

namespace common\models;

/**
 * This is the ActiveQuery class for [[HistoricalViews]].
 *
 * @see HistoricalViews
 */
class HistoricalViewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoricalViews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoricalViews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
