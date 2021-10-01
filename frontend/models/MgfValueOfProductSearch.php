<?php

namespace frontend\models;

use yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfValueOfProduct;

/**
 * MgfValueOfProductSearch represents the model behind the search form of `frontend\models\MgfValueOfProduct`.
 */
class MgfValueOfProductSearch extends MgfValueOfProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_yr1_qty', 'product_yr2_qty', 'product_yr3_qty', 'product_yr4_qty', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['product_name', 'product_unit', 'comment', 'date_created', 'date_update'], 'safe'],
            [['product_yr1_price', 'product_yr1_value', 'product_yr2_price', 'product_yr2_value', 'product_yr3_price', 'product_yr3_value', 'product_yr4_price', 'product_yr4_value'], 'number'],
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

        //$query = MgfValueOfProduct::find();
        $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfValueOfProduct::find()->where(['proposal_id'=>$proposal->id]);
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
            'product_yr1_qty' => $this->product_yr1_qty,
            'product_yr1_price' => $this->product_yr1_price,
            'product_yr1_value' => $this->product_yr1_value,
            'product_yr2_qty' => $this->product_yr2_qty,
            'product_yr2_price' => $this->product_yr2_price,
            'product_yr2_value' => $this->product_yr2_value,
            'product_yr3_qty' => $this->product_yr3_qty,
            'product_yr3_price' => $this->product_yr3_price,
            'product_yr3_value' => $this->product_yr3_value,
            'product_yr4_qty' => $this->product_yr4_qty,
            'product_yr4_price' => $this->product_yr4_price,
            'product_yr4_value' => $this->product_yr4_value,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_unit', $this->product_unit])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
