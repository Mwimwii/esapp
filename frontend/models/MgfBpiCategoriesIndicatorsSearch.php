<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfBpiCategoriesIndicators;

/**
 * MgfBpiCategoriesIndicatorsSearch represents the model behind the search form of `frontend\models\MgfBpiCategoriesIndicators`.
 */
class MgfBpiCategoriesIndicatorsSearch extends MgfBpiCategoriesIndicators
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'indicator_id'], 'integer'],
            [['indicator_description'], 'safe'],
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
        $query = MgfBpiCategoriesIndicators::find();

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
            'category_id' => $this->category_id,
            'indicator_id' => $this->indicator_id,
        ]);

        $query->andFilterWhere(['like', 'indicator_description', $this->indicator_description]);

        return $dataProvider;
    }
}
