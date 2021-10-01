<?php

namespace frontend\models;
use frontend\models\MgfProposal;
use frontend\models\MgfApplicant;
use yii\base\Model;
use yii;
use yii\data\ActiveDataProvider;
use frontend\models\MgfProductMarketMarketing;

/**
 * MgfProductMarketMarketingSearch represents the model behind the search form of `frontend\models\MgfProductMarketMarketing`.
 */
class MgfProductMarketMarketingSearch extends MgfProductMarketMarketing
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['marketing', 'market_outlets', 'sales_contract', 'person_responsible', 'competition_penetration', 'future_prospects', 'branding_market_penetration', 'date_created', 'date_update'], 'safe'],
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
        //$query = MgfProductMarketMarketing::find();
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfProductMarketMarketing::find()->where(['proposal_id'=>$proposal->id]);
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
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'marketing', $this->marketing])
            ->andFilterWhere(['like', 'market_outlets', $this->market_outlets])
            ->andFilterWhere(['like', 'sales_contract', $this->sales_contract])
            ->andFilterWhere(['like', 'person_responsible', $this->person_responsible])
            ->andFilterWhere(['like', 'competition_penetration', $this->competition_penetration])
            ->andFilterWhere(['like', 'future_prospects', $this->future_prospects])
            ->andFilterWhere(['like', 'branding_market_penetration', $this->branding_market_penetration]);

        return $dataProvider;
    }
}
