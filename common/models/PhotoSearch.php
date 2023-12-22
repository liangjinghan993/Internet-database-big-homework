<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 照片搜索接口类
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Photo;

/**
 * NewsSearch represents the model behind the search form of `\common\models\Photo`.
 */
class PhotoSearch extends Photo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type', 'details', 'introduction', 'title',  'time', 'path'], 'safe'],
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
        $query = Photo::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
