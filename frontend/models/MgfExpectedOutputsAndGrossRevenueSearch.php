<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfExpectedOutputsAndGrossRevenue;

/**
 * MgfExpectedOutputsAndGrossRevenueSearch represents the model behind the search form of `frontend\models\MgfExpectedOutputsAndGrossRevenue`.
 */
class MgfExpectedOutputsAndGrossRevenueSearch extends MgfExpectedOutputsAndGrossRevenue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['output_name', 'unit_of_measure', 'comment', 'date_created', 'date_update'], 'safe'],
            [['expected_price', 'expected_gross_revenue'], 'number'],
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
        //$query = MgfExpectedOutputsAndGrossRevenue::find();
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfExpectedOutputsAndGrossRevenue::find()->where(['proposal_id'=>$proposal->id]);
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
            'expected_price' => $this->expected_price,
            'expected_gross_revenue' => $this->expected_gross_revenue,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'output_name', $this->output_name])
            ->andFilterWhere(['like', 'unit_of_measure', $this->unit_of_measure])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
