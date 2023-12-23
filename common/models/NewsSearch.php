<?php

/**
 * Team: 抵制核污水小队
 * Created by 梁婧涵
 * 新闻搜索接口
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\News;

/**
 * NewsSearch represents the model behind the search form of `\common\models\News`.
 */
class NewsSearch extends News
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id', 'news_views'], 'integer'],
            [['news_title', 'news_content', 'news_photo', 'news_date', 'news_source', 'news_abstract'], 'safe'],
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
        $query = News::find();

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
        $query->andFilterWhere([
            'news_id' => $this->news_id,
            'news_date' => $this->news_date,
            'news_views' => $this->news_views,
        ]);

        $query->andFilterWhere(['like', 'news_title', $this->news_title])
            ->andFilterWhere(['like', 'news_content', $this->news_content])
            ->andFilterWhere(['like', 'news_photo', $this->news_photo])
            ->andFilterWhere(['like', 'news_source', $this->news_source])
            ->andFilterWhere(['like', 'news_abstract', $this->news_abstract]);

        return $dataProvider;
    }
}
