<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeFaabsTrainingAttendanceSheet;

/**
 * MeFaabsTrainingAttendanceSheetSearch represents the model behind the search form of `backend\models\MeFaabsTrainingAttendanceSheet`.
 */
class MeFaabsTrainingAttendanceSheetSearch extends MeFaabsTrainingAttendanceSheet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'faabs_group_id', 'farmer_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['household_head_type', 'topic', 'facilitators', 'partner_organisations', 'training_date', 'duration','province_id', 'district_id', 'camp_id'], 'safe'],
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
        $query = MeFaabsTrainingAttendanceSheet::find();

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
            'faabs_group_id' => $this->faabs_group_id,
            'farmer_id' => $this->farmer_id,
            'training_date' => $this->training_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'household_head_type', $this->household_head_type])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'facilitators', $this->facilitators])
            ->andFilterWhere(['like', 'partner_organisations', $this->partner_organisations])
            ->andFilterWhere(['like', 'duration', $this->duration]);

        return $dataProvider;
    }
}
