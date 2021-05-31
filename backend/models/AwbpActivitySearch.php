<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbActivity;

/**
 * AwbpActivitySearch represents the model behind the search form of `backend\models\AwpbActivity`.
 */
class AwbpActivitySearch extends AwpbActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_activity_id', 'component_id', 'awpb_template_id', 'funder_id','unit_of_measure_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_code', 'description','gl_account_code'], 'safe'],
             [['year','district_id', 'province_id'], 'safe'],
            [['programme_target','quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
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
<<<<<<< Updated upstream
    public function search($params)
    {
        $query = AwpbActivity::find();
=======
    public function search($params) {
        //Needed for a search filter
        if (!empty($params['AwbpActivitySearch']['district_id']) ||
                !empty($params['AwbpActivitySearch']['province_id']) ||
                !empty($params['AwbpActivitySearch']['year'])) {
            $district_id = !empty($params['AwbpActivitySearch']['district_id']) ? $params['AwbpActivitySearch']['district_id'] : "";
            $province_id = !empty($params['AwbpActivitySearch']['province_id']) ? $params['AwbpActivitySearch']['province_id'] : "";
            $year = $params['AwbpActivitySearch']['year'];
            if ((!empty($province_id) && empty($district_id)) || !empty($year)) {
                //We get activities for district and fiscal year
                $activity_ids = [];
                $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);

                if (!empty($awpb_template)) {
                    $activity_lines = \backend\models\AwpbActivityLine::find()
                            ->where(['awpb_template_id' => $awpb_template->id])
                            ->andWhere(['province_id' => $province_id])
                            ->all();
                    if (!empty($activity_lines)) {
                        foreach ($activity_lines as $_activity) {
                            array_push($activity_ids, $_activity['activity_id']);
                        }
                    }
                }


                $query = AwpbActivity::find()
                        ->where(["IN", 'id', $activity_ids]);
            }
            if (!empty($district_id)) {
                //We get activities for district, province and fiscal year
                $activity_ids = [];
                $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);

                if (!empty($awpb_template)) {
                    $activity_lines = \backend\models\AwpbActivityLine::find()
                            ->where(['awpb_template_id' => $awpb_template->id])
                            ->andWhere(['province_id' => $province_id])
                            ->andWhere(['district_id' => $district_id])
                            ->all();
                    if (!empty($activity_lines)) {
                        foreach ($activity_lines as $_activity) {
                            array_push($activity_ids, $_activity['activity_id']);
                        }
                    }
                }


                $query = AwpbActivity::find()
                        ->where(["IN", 'id', $activity_ids]);
            }
        } else {
            $query = AwpbActivity::find();
        }
>>>>>>> Stashed changes

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
            'parent_activity_id' => $this->parent_activity_id,
            'component_id' => $this->component_id,
            'awpb_template_id' => $this->awpb_template_id,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            'quarter_one_budget' => $this->quarter_one_budget,
            'quarter_two_budget' => $this->quarter_two_budget,
            'quarter_three_budget' => $this->quarter_three_budget,
            'quarter_four_budget' => $this->quarter_four_budget,
            'total_budget' => $this->total_budget,
            'funder_id' => $this->funder_id,
            'programme_target'=>$this->programme_target,
            'expense_category_id' => $this->expense_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'activity_code', $this->activity_code])
        ->andFilterWhere(['like', 'gl_account_code', $this->gl_account_code])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
