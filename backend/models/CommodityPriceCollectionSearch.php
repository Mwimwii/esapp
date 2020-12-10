<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CommodityPriceCollection;

/**
 * CommodityPriceCollectionSearch represents the model behind the search form of `backend\models\CommodityPriceCollection`.
 */
class CommodityPriceCollectionSearch extends CommodityPriceCollection
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'district', 'market_id', 'commodity_type_id', 'price_level_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_of_measure', 'description','year', 'month','province_id'], 'safe'],
            [['price'], 'number'],
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
        $query = CommodityPriceCollection::find();

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
            'district' => $this->district,
            'market_id' => $this->market_id,
            'commodity_type_id' => $this->commodity_type_id,
            'price_level_id' => $this->price_level_id,
            'price' => $this->price,
            'year' => $this->year,
            'month' => $this->month,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'unit_of_measure', $this->unit_of_measure])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
