<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfCumulativeProfit;

/**
 * MgfCumulativeProfitSearch represents the model behind the search form of `frontend\models\MgfCumulativeProfit`.
 */
class MgfCumulativeProfitSearch extends MgfCumulativeProfit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['cumulative_profit_yr1_value', 'cumulative_profit_yr2_value', 'cumulative_profit_yr3_value', 'cumulative_profit_yr4_value'], 'number'],
            [['date_created', 'date_update'], 'safe'],
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

       // $query = MgfCumulativeProfit::find();
       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfCumulativeProfit::find()->where(['proposal_id'=>$proposal->id]);
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
            'cumulative_profit_yr1_value' => $this->cumulative_profit_yr1_value,
            'cumulative_profit_yr2_value' => $this->cumulative_profit_yr2_value,
            'cumulative_profit_yr3_value' => $this->cumulative_profit_yr3_value,
            'cumulative_profit_yr4_value' => $this->cumulative_profit_yr4_value,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
