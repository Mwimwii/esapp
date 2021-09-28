<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfOrganisationalDetails;

/**
 * MgfOrganisationalDetailSearch represents the model behind the search form of `frontend\models\MgfOrganisationalDetails`.
 */
class MgfOrganisationalDetailSearch extends MgfOrganisationalDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mgt_Staff', 'senior_Staff', 'junior_Staff', 'others', 'organisation_id'], 'integer'],
            [['last_board', 'last_agm', 'last_audit', 'has_finance', 'has_resources', 'date_created'], 'safe'],
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
       // $query = MgfOrganisationalDetails::find();
       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfOrganisationalDetails::find()->where(['proposal_id'=>$proposal->id]);
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
            'mgt_Staff' => $this->mgt_Staff,
            'senior_Staff' => $this->senior_Staff,
            'junior_Staff' => $this->junior_Staff,
            'others' => $this->others,
            'last_board' => $this->last_board,
            'last_agm' => $this->last_agm,
            'last_audit' => $this->last_audit,
            'organisation_id' => $this->organisation_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'has_finance', $this->has_finance])
            ->andFilterWhere(['like', 'has_resources', $this->has_resources]);

        return $dataProvider;
    }
}
