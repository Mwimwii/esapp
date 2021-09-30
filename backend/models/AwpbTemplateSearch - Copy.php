<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbTemplate;

/**
 * AwpbTemplateSearch represents the model behind the search form of `backend\models\AwpbTemplate`.
 */
class AwpbTemplateSearch extends AwpbTemplate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fiscal_year', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['budget_theme', 'comment', 'guideline_file'], 'safe'],
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
        $query = AwpbTemplate::find();

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
            'fiscal_year' => $this->fiscal_year,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'budget_theme', $this->budget_theme])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'guideline_file', $this->guideline_file]);

        return $dataProvider;
    }
}
