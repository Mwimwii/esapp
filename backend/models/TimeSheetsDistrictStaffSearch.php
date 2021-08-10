<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TimeSheetsDistrictStaff;

/**
 * TimeSheetsDistrictStaffSearch represents the model behind the search form of `backend\models\TimeSheetsDistrictStaff`.
 */
class TimeSheetsDistrictStaffSearch extends TimeSheetsDistrictStaff
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rate_id', 'hours_field_esapp_activities', 'hours_office_esapp_activities', 'total_hours_worked', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by','approved_at','district','province'], 'integer'],
            [['month','year', 'designation', 'activity_description', 'reviewer_comments','approved_at'], 'safe'],
            [['contribution'], 'number'],
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
        $query = TimeSheetsDistrictStaff::find();

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
            'rate_id' => $this->rate_id,
            'hours_field_esapp_activities' => $this->hours_field_esapp_activities,
            'hours_office_esapp_activities' => $this->hours_office_esapp_activities,
            'total_hours_worked' => $this->total_hours_worked,
            'contribution' => $this->contribution,
            'status' => $this->status,
            'year' => $this->year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'district' => $this->district,
            'province' => $this->province,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'month', $this->month])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'approved_at', $this->approved_at])
            ->andFilterWhere(['like', 'activity_description', $this->activity_description])
            ->andFilterWhere(['like', 'reviewer_comments', $this->reviewer_comments]);

        return $dataProvider;
    }
}
