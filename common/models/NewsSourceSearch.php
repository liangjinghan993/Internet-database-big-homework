<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 新闻来源搜索接口
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NewsSource;

/**
 * NewsSourceSearch represents the model behind the search form of `common\models\NewsSource`.
 */
class NewsSourceSearch extends NewsSource
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['source_name', 'source_introduction', 'bilibili_url', 'weibo_url', 'douyin_url', 'source_photo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = NewsSource::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'source_name', $this->source_name])
            ->andFilterWhere(['like', 'source_introduction', $this->source_introduction])
            ->andFilterWhere(['like', 'bilibili_url', $this->bilibili_url])
            ->andFilterWhere(['like', 'weibo_url', $this->weibo_url])
            ->andFilterWhere(['like', 'douyin_url', $this->douyin_url])
            ->andFilterWhere(['like', 'source_photo', $this->source_photo]);

        return $dataProvider;
    }
}
