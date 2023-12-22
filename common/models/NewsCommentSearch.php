<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 新闻评论搜索接口
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\NewsComment;

/**
 * NewsCommentSearch represents the model behind the search form of `common\models\NewsComment`.
 */
class NewsCommentSearch extends NewsComment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_id', 'comment_news', 'comment_user'], 'integer'],
            [['comment_content', 'comment_time'], 'safe'],
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
        $query = NewsComment::find();

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
            'comment_id' => $this->comment_id,
            'comment_news' => $this->comment_news,
            'comment_user' => $this->comment_user,
            'comment_time' => $this->comment_time,
        ]);

        $query->andFilterWhere(['like', 'comment_content', $this->comment_content]);

        return $dataProvider;
    }
}
