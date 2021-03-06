<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbDistrict;

/**
 * AwpbDistrictSearch represents the model behind the search form of `backend\models\AwpbDistrict`.
 */
class AwpbDistrictSearch extends AwpbDistrict
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'awpb_template_id', 'district_id', 'cost_centre_id', 'province_id', 'status','funds_request', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'safe'],
              [['quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount','quarter_one_actual', 'quarter_two_actual', 'quarter_three_actual', 'quarter_four_actual'], 'number'],       
         
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
        $query = AwpbDistrict::find();

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
            'awpb_template_id' => $this->awpb_template_id,
            'district_id' => $this->district_id,
            'cost_centre_id' => $this->cost_centre_id,
            'province_id' => $this->province_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
