<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfImplementationScheduleShort;

/**
 * MgfImplementationScheduleShortSearch represents the model behind the search form of `frontend\models\MgfImplementationScheduleShort`.
 */
class MgfImplementationScheduleShortSearch extends MgfImplementationScheduleShort
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'implementation_year', 'qtr1', 'qtr2', 'qtr3', 'qtr4', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['activity', 'date_created', 'date_update'], 'safe'],
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
       // $query = MgfImplementationScheduleShort::find();

       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfImplementationScheduleShort::find()->where(['proposal_id'=>$proposal->id]);
        //$query = MgfImplementationSchedule::find();

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
            'implementation_year' => $this->implementation_year,
            'qtr1' => $this->qtr1,
            'qtr2' => $this->qtr2,
            'qtr3' => $this->qtr3,
            'qtr4' => $this->qtr4,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity]);

        return $dataProvider;
    }
}
