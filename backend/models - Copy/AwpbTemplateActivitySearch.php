<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbTemplateActivity;

/**
 * AwpbTemplateActivitySearch represents the model behind the search form of `backend\models\AwpbTemplateActivity`.
 */
class AwpbTemplateActivitySearch extends AwpbTemplateActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'component_id', 'outcome_id', 'output_id', 'awpb_template_id', 'funder_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
        $query = AwpbTemplateActivity::find();

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
            'activity_id' => $this->activity_id,
            'component_id' => $this->component_id,
            'outcome_id' => $this->outcome_id,
            'output_id' => $this->output_id,
            'awpb_template_id' => $this->awpb_template_id,
            'funder_id' => $this->funder_id,
            'expense_category_id' => $this->expense_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
