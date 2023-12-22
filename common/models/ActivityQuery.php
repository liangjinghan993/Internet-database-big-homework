<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HistoricalActivity]].
 *
 * @see HistoricalActivity
 */
class ActivityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoricalActivity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoricalActivity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
