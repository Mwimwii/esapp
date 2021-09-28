<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfExistingFacilities;

/**
 * MgfExistingFacilitiesSearch represents the model behind the search form of `app\models\MgfExistingFacilities`.
 */
class MgfExistingFacilitiesSearch extends MgfExistingFacilities
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['facility_name', 'description', 'use_to_be_made', 'comment', 'date_created', 'date_update'], 'safe'],
            [['estimate_cost'], 'number'],
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
       // $query = MgfExistingFacilities::find();
       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfExistingFacilities::find()->where(['proposal_id'=>$proposal->id]);
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
            'quantity' => $this->quantity,
            'estimate_cost' => $this->estimate_cost,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'facility_name', $this->facility_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'use_to_be_made', $this->use_to_be_made])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
