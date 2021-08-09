<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbOutcome;

/**
 * AwpbOutcomeSearch represents the model behind the search form of `backend\models\AwpbOutcome`.
 */
class AwpbOutcomeSearch extends AwpbOutcome
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'component_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['outcome_code', 'name', 'outcome_description'], 'safe'],
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
        $query = AwpbOutcome::find();

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
            'component_id' => $this->component_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'outcome_code', $this->outcome_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'outcome_description', $this->outcome_description]);

        return $dataProvider;
    }
}