<?php

namespace frontend\models;
<<<<<<< HEAD
use yii;
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfVariableFixedCost;

/**
 * MgfVariableFixedCostSearch represents the model behind the search form of `frontend\models\MgfVariableFixedCost`.
 */
class MgfVariableFixedCostSearch extends MgfVariableFixedCost
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['cost_name', 'cost_type', 'comment', 'date_created', 'date_update'], 'safe'],
            [['cost_yr1_value', 'cost_yr2_value', 'cost_yr3_value', 'cost_yr4_value'], 'number'],
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
        //$query = MgfVariableFixedCost::find();
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfVariableFixedCost::find()->where(['proposal_id'=>$proposal->id]);
        //$query = MgfImplementationSchedule::find();
=======
        $query = MgfVariableFixedCost::find();
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
            'cost_yr1_value' => $this->cost_yr1_value,
            'cost_yr2_value' => $this->cost_yr2_value,
            'cost_yr3_value' => $this->cost_yr3_value,
            'cost_yr4_value' => $this->cost_yr4_value,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'cost_name', $this->cost_name])
            ->andFilterWhere(['like', 'cost_type', $this->cost_type])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
