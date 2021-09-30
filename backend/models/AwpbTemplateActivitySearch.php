<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbTemplateActivity;

/**
 * AwpbTemplateActivitySearch represents the model behind the search form of `backend\models\AwpbTemplateActivity`.
 */
class AwpbTemplateActivitySearch extends AwpbTemplateActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'status', 'component_id', 'outcome_id', 'output_id', 'awpb_template_id', 'funder_id', 'expense_category_id', 'access_level_district', 'access_level_province', 'access_level_programme', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_code', 'name'], 'safe'],
            [['ifad', 'ifad_grant', 'grz', 'beneficiaries', 'private_sector', 'iapri', 'parm', 'ifad_amount', 'ifad_grant_amount', 'grz_amount', 'beneficiaries_amount', 'private_sector_amount', 'iapri_amount', 'parm_amount', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'budget_amount'], 'number'],
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
        $query = AwpbTemplateActivity::find();

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
            'activity_id' => $this->activity_id,
            'component_id' => $this->component_id,
            'outcome_id' => $this->outcome_id,
            'output_id' => $this->output_id,
            'awpb_template_id' => $this->awpb_template_id,
            'funder_id' => $this->funder_id,
            'expense_category_id' => $this->expense_category_id,
            'status'=>$this->status,
            'ifad' => $this->ifad,
            'ifad_grant' => $this->ifad_grant,
            'grz' => $this->grz,
            'beneficiaries' => $this->beneficiaries,
            'private_sector' => $this->private_sector,
            'iapri' => $this->iapri,
            'parm' => $this->parm,
            'ifad_amount' => $this->ifad_amount,
            'ifad_grant_amount' => $this->ifad_grant_amount,
            'grz_amount' => $this->grz_amount,
            'beneficiaries_amount' => $this->beneficiaries_amount,
            'private_sector_amount' => $this->private_sector_amount,
            'iapri_amount' => $this->iapri_amount,
            'parm_amount' => $this->parm_amount,
            'mo_1_amount' => $this->mo_1_amount,
            'mo_2_amount' => $this->mo_2_amount,
            'mo_3_amount' => $this->mo_3_amount,
            'mo_4_amount' => $this->mo_4_amount,
            'mo_5_amount' => $this->mo_5_amount,
            'mo_6_amount' => $this->mo_6_amount,
            'mo_7_amount' => $this->mo_7_amount,
            'mo_8_amount' => $this->mo_8_amount,
            'mo_9_amount' => $this->mo_9_amount,
            'mo_10_amount' => $this->mo_10_amount,
            'mo_11_amount' => $this->mo_11_amount,
            'mo_12_amount' => $this->mo_12_amount,
            'quarter_one_amount' => $this->quarter_one_amount,
            'quarter_two_amount' => $this->quarter_two_amount,
            'quarter_three_amount' => $this->quarter_three_amount,
            'quarter_four_amount' => $this->quarter_four_amount,
            'budget_amount' => $this->budget_amount,
            'access_level_district' => $this->access_level_district,
            'access_level_province' => $this->access_level_province,
            'access_level_programme' => $this->access_level_programme,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'activity_code', $this->activity_code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
