<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfImplementationSchedule;

/**
 * MgfImplementationScheduleSearch represents the model behind the search form of `frontend\models\MgfImplementationSchedule`.
 */
class MgfImplementationScheduleSearch extends MgfImplementationSchedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'yr1qtr1', 'yr1qtr2', 'yr1qtr3', 'yr1qtr4', 'yr2qtr1', 'yr2qtr2', 'yr2qtr3', 'yr2qtr4', 'yr3qtr1', 'yr3qtr2', 'yr3qtr3', 'yr3qtr4', 'yr4qtr1', 'yr4qtr2', 'yr4qtr3', 'yr4qtr4', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['date_created', 'date_update'], 'safe'],
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
        $query = MgfImplementationSchedule::find();

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
            'yr1qtr1' => $this->yr1qtr1,
            'yr1qtr2' => $this->yr1qtr2,
            'yr1qtr3' => $this->yr1qtr3,
            'yr1qtr4' => $this->yr1qtr4,
            'yr2qtr1' => $this->yr2qtr1,
            'yr2qtr2' => $this->yr2qtr2,
            'yr2qtr3' => $this->yr2qtr3,
            'yr2qtr4' => $this->yr2qtr4,
            'yr3qtr1' => $this->yr3qtr1,
            'yr3qtr2' => $this->yr3qtr2,
            'yr3qtr3' => $this->yr3qtr3,
            'yr3qtr4' => $this->yr3qtr4,
            'yr4qtr1' => $this->yr4qtr1,
            'yr4qtr2' => $this->yr4qtr2,
            'yr4qtr3' => $this->yr4qtr3,
            'yr4qtr4' => $this->yr4qtr4,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
