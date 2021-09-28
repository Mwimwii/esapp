<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfImplementationArrangementsCooperatingPartners;

/**
 * MgfImplementationArrangementsCooperatingPartnersSearch represents the model behind the search form of `frontend\models\MgfImplementationArrangementsCooperatingPartners`.
 */
class MgfImplementationArrangementsCooperatingPartnersSearch extends MgfImplementationArrangementsCooperatingPartners
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['main_activities', 'respobility', 'experience', 'comment', 'typee', 'date_created'], 'safe'],
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
        //$query = MgfImplementationArrangementsCooperatingPartners::find();
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfImplementationArrangementsCooperatingPartners::find()->where(['proposal_id'=>$proposal->id]);
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
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'main_activities', $this->main_activities])
            ->andFilterWhere(['like', 'respobility', $this->respobility])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'typee', $this->typee]);

        return $dataProvider;
    }
}
