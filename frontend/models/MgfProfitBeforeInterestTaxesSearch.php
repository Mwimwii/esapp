<?php

namespace frontend\models;
<<<<<<< HEAD
use yii;
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfProfitBeforeInterestTaxes;

/**
 * MgfProfitBeforeInterestTaxesSearch represents the model behind the search form of `frontend\models\MgfProfitBeforeInterestTaxes`.
 */
class MgfProfitBeforeInterestTaxesSearch extends MgfProfitBeforeInterestTaxes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['profit_yr1_value', 'profit_yr2_value', 'profit_yr3_value', 'profit_yr4_value'], 'number'],
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
<<<<<<< HEAD
      //  $query = MgfProfitBeforeInterestTaxes::find();
      $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfProfitBeforeInterestTaxes::find()->where(['proposal_id'=>$proposal->id]);
        //$query = MgfImplementationSchedule::find();
=======
        $query = MgfProfitBeforeInterestTaxes::find();
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
            'profit_yr1_value' => $this->profit_yr1_value,
            'profit_yr2_value' => $this->profit_yr2_value,
            'profit_yr3_value' => $this->profit_yr3_value,
            'profit_yr4_value' => $this->profit_yr4_value,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
