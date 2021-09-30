<?php

namespace frontend\models;
<<<<<<< HEAD
use yii;
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfBusinessPerfomanceIndicator;

/**
 * MgfBusinessPerfomanceIndicatorSearch represents the model behind the search form of `frontend\models\MgfBusinessPerfomanceIndicator`.
 */
class MgfBusinessPerfomanceIndicatorSearch extends MgfBusinessPerfomanceIndicator
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'indicator_id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['agribusiness_indicators','status_at_application', 'status_after_1yr', 'status_after_2yr', 'date_created', 'date_update'], 'safe'],
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
<<<<<<< HEAD
       // $query = MgfBusinessPerfomanceIndicator::find();
       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfBusinessPerfomanceIndicator::find()->where(['proposal_id'=>$proposal->id]);
        //$query = MgfImplementationSchedule::find();
=======
        $query = MgfBusinessPerfomanceIndicator::find();
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

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
            'category_id' => $this->category_id,
            'indicator_id' => $this->indicator_id,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'agribusiness_indicators', $this->agribusiness_indicators])
            ->andFilterWhere(['like', 'status_at_application', $this->status_at_application])
            ->andFilterWhere(['like', 'status_after_1yr', $this->status_after_1yr])
            ->andFilterWhere(['like', 'status_after_2yr', $this->status_after_2yr]);

        return $dataProvider;
    }
}
