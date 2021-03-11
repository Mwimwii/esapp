<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeCampSubprojectRecordsAwpbObjectives;

/**
 * CampSubprojectRecordsAwpbObjectivesSearch represents the model behind the search form of `backend\models\MeCampSubprojectRecordsAwpbObjectives`.
 */
class CampSubprojectRecordsAwpbObjectivesSearch extends MeCampSubprojectRecordsAwpbObjectives
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'camp_id', 'quarter', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['key_indicators', 'period_unit', 'target', 'year'], 'safe'],
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
        $query = MeCampSubprojectRecordsAwpbObjectives::find();

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
            'camp_id' => $this->camp_id,
            'quarter' => $this->quarter,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'key_indicators', $this->key_indicators])
            ->andFilterWhere(['like', 'period_unit', $this->period_unit])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
    
   
}
