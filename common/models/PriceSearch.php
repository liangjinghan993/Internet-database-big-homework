<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 物价搜索接口
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Price;

/**
 * NewsSearch represents the model behind the search form of `\common\models\Price`.
 */
class PriceSearch extends Price
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'currency'], 'integer'],
            [['item_name', 'price', 'img_path', 'measurement', 'introduction', 't_class', 'title'], 'safe'],
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
        $query = Price::find();

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

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'img_path', $this->img_path])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'measurement', $this->measurement])
            ->andFilterWhere(['like', 't_class', $this->t_class])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
