<?php

<<<<<<< HEAD
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AwpbActivity;
=======
namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbActivity;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

/**
 * AwpbActivitySearch represents the model behind the search form of `app\models\AwpbActivity`.
 */
<<<<<<< HEAD
class AwpbActivitySearch extends AwpbActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_activity_id','indicator_id', 'component_id', 'unit_of_measure_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_code', 'description'], 'safe'],
            [['quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
=======
<<<<<<<< HEAD:backend/models/AwpbActivitySearch.php
class AwpbActivitySearch extends AwpbActivity
{
========
class AwbpActivitySearch extends AwpbActivity {

>>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d:backend/models/AwbpActivitySearch.php
    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
<<<<<<<< HEAD:backend/models/AwpbActivitySearch.php
            [['id', 'parent_activity_id','indicator_id', 'component_id', 'unit_of_measure_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_code', 'description'], 'safe'],
            [['quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
========
            [['id', 'parent_activity_id', 'component_id', 'awpb_template_id', 'funder_id', 'unit_of_measure_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_code', 'description', 'gl_account_code'], 'safe'],
            [['year', 'district_id', 'province_id'], 'safe'],
            [['programme_target', 'quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
>>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d:backend/models/AwbpActivitySearch.php
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        ];
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function scenarios()
    {
=======
    public function scenarios() {
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
<<<<<<< HEAD
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
            'parent_activity_id' => $this->parent_activity_id,
            'component_id' => $this->component_id,
            'indicator_id'=>$this->indicator_id,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            'quarter_one_budget' => $this->quarter_one_budget,
            'quarter_two_budget' => $this->quarter_two_budget,
            'quarter_three_budget' => $this->quarter_three_budget,
            'quarter_four_budget' => $this->quarter_four_budget,
            'total_budget' => $this->total_budget,
<<<<<<< HEAD
=======
<<<<<<<< HEAD:backend/models/AwpbActivitySearch.php
========
            'funder_id' => $this->funder_id,
            'programme_target' => $this->programme_target,
>>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d:backend/models/AwbpActivitySearch.php
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            'expense_category_id' => $this->expense_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'activity_code', $this->activity_code])
<<<<<<< HEAD
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
=======
<<<<<<<< HEAD:backend/models/AwpbActivitySearch.php
            ->andFilterWhere(['like', 'description', $this->description]);
========
                ->andFilterWhere(['like', 'gl_account_code', $this->gl_account_code])
                ->andFilterWhere(['like', 'description', $this->description]);
>>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d:backend/models/AwbpActivitySearch.php

        return $dataProvider;
    }

    public function searchByYearProvinceDistrict($year, $province_id, $district_id) {

        //Needed for a search filter
        if (!empty($district_id) ||
                !empty($province_id) ||
                !empty($year)) {

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
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
}
