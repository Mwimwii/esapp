<?php

namespace backend\controllers;

use Yii;
use backend\models\MeFaabsGroups;
use backend\models\MeFaabsGroupsSearch;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivity;
use backend\models\AwpbActivityLineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;

/**
 * FaabsGroupsController implements the CRUD actions for MeFaabsGroups model.
 */
class ReportsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['facilitation-imporoved-technologies', 'download-fit-report'],
                'rules' => [
                    [
                        'actions' => ['facilitation-imporoved-technologies', 'download-fit-report'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MeFaabsGroups models.
     * @return mixed
     */
    public function actionFacilitationImporovedTechnologies() {
        if (User::userIsAllowedTo('View facilitation of improved technologies/best practices report')) {
            $searchModel = new \backend\models\MeFaabsTrainingAttendanceSheetSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $subcomp_21 = [
                'female' => 0,
                'male' => 0,
                'Total_female_male' => 0,
                'women_heads' => 0,
                'Youth' => 0
            ];
            $subcomp_22 = [
                'female' => 0,
                'male' => 0,
                'Total_female_male' => 0,
                'women_heads' => 0,
                'Youth' => 0
            ];

            $indicator_1 = ['subcomp_21' => [], 'subcomp_22' => []];
            $indicator_2 = ['subcomp_21' => [], 'subcomp_22' => []];
            $indicator_3 = ['subcomp_21' => [], 'subcomp_22' => []];
            $indicator_4 = ['subcomp_21' => [], 'subcomp_22' => []];
            $indicator_5 = ['subcomp_21' => [], 'subcomp_22' => []];
            $indicator_6 = ['subcomp_21' => [], 'subcomp_22' => []];
            $indicator_7 = ['subcomp_21' => [], 'subcomp_22' => []];

            if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch'])) {
                $faabs_ids = [];
                $faabs_model = MeFaabsGroups::find()->where(['camp_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id']])
                        ->all();
                if (!empty($faabs_model)) {
                    foreach ($faabs_model as $id) {
                        array_push($faabs_ids, $id['id']);
                    }
                }

                //1.We get details for indicator 1 
                //We fetch sex details for each subcomponent
                $indicator_one_sex_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['sex', 'count(sex) as cnt_sex', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_one])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['sex', 'topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_sex_details)) {
                    foreach ($indicator_one_sex_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_21['female'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_21['male'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_22['female'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_22['male'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                    }
                }

                //We get women headed count
                $indicator_one_women_head_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(household_head_type) as hh_type', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_one])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['household_head_type' => 'Female headed'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_women_head_details)) {
                    foreach ($indicator_one_women_head_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['women_heads'] += $_model['hh_type'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['women_heads'] += $_model['hh_type'];
                        }
                    }
                }

                //We get youth count
                $indicator_one_wyouth_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(youth_non_youth) as cnt_youth', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_one])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['youth_non_youth' => 'Youth'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_wyouth_details)) {
                    foreach ($indicator_one_wyouth_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['Youth'] += $_model['cnt_youth'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['Youth'] += $_model['cnt_youth'];
                        }
                    }
                }
                $indicator_1 ['subcomp_21'] = $subcomp_21;
                $indicator_1 ['subcomp_22'] = $subcomp_22;

                //2.We get details for indicator 2
                //We fetch sex details for each subcomponent
                $subcomp_21 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $subcomp_22 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $indicator_one_sex_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['sex', 'count(sex) as cnt_sex', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_two])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['sex', 'topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_sex_details)) {
                    foreach ($indicator_one_sex_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_21['female'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_21['male'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_22['female'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_22['male'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                    }
                }

                //We get women headed count
                $indicator_one_women_head_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(household_head_type) as hh_type', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_two])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['household_head_type' => 'Female headed'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_women_head_details)) {
                    foreach ($indicator_one_women_head_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['women_heads'] += $_model['hh_type'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['women_heads'] += $_model['hh_type'];
                        }
                    }
                }

                //We get youth count
                $indicator_one_wyouth_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(youth_non_youth) as cnt_youth', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_two])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['youth_non_youth' => 'Youth'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_wyouth_details)) {
                    foreach ($indicator_one_wyouth_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['Youth'] += $_model['cnt_youth'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['Youth'] += $_model['cnt_youth'];
                        }
                    }
                }
                $indicator_2 ['subcomp_21'] = $subcomp_21;
                $indicator_2 ['subcomp_22'] = $subcomp_22;


                //3.We get details for indicator 3
                //We fetch sex details for each subcomponent
                $subcomp_21 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $subcomp_22 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $indicator_one_sex_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['sex', 'count(sex) as cnt_sex', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_three])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['sex', 'topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_sex_details)) {
                    foreach ($indicator_one_sex_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_21['female'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_21['male'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_22['female'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_22['male'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                    }
                }

                //We get women headed count
                $indicator_one_women_head_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(household_head_type) as hh_type', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_three])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['household_head_type' => 'Female headed'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_women_head_details)) {
                    foreach ($indicator_one_women_head_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['women_heads'] += $_model['hh_type'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['women_heads'] += $_model['hh_type'];
                        }
                    }
                }

                //We get youth count
                $indicator_one_wyouth_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(youth_non_youth) as cnt_youth', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_three])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['youth_non_youth' => 'Youth'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_wyouth_details)) {
                    foreach ($indicator_one_wyouth_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['Youth'] += $_model['cnt_youth'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['Youth'] += $_model['cnt_youth'];
                        }
                    }
                }
                $indicator_3 ['subcomp_21'] = $subcomp_21;
                $indicator_3 ['subcomp_22'] = $subcomp_22;


                //4.We get details for indicator 4
                //We fetch sex details for each subcomponent
                $subcomp_21 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $subcomp_22 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $indicator_one_sex_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['sex', 'count(sex) as cnt_sex', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_four])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['sex', 'topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_sex_details)) {
                    foreach ($indicator_one_sex_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_21['female'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_21['male'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_22['female'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_22['male'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                    }
                }

                //We get women headed count
                $indicator_one_women_head_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(household_head_type) as hh_type', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_four])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['household_head_type' => 'Female headed'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_women_head_details)) {
                    foreach ($indicator_one_women_head_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['women_heads'] += $_model['hh_type'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['women_heads'] += $_model['hh_type'];
                        }
                    }
                }

                //We get youth count
                $indicator_one_wyouth_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(youth_non_youth) as cnt_youth', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_four])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['youth_non_youth' => 'Youth'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_wyouth_details)) {
                    foreach ($indicator_one_wyouth_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['Youth'] += $_model['cnt_youth'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['Youth'] += $_model['cnt_youth'];
                        }
                    }
                }
                $indicator_4 ['subcomp_21'] = $subcomp_21;
                $indicator_4 ['subcomp_22'] = $subcomp_22;

                //5.We get details for indicator 5
                //We fetch sex details for each subcomponent
                $subcomp_21 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $subcomp_22 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $indicator_one_sex_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['sex', 'count(sex) as cnt_sex', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_five])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['sex', 'topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_sex_details)) {
                    foreach ($indicator_one_sex_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_21['female'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_21['male'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_22['female'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_22['male'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                    }
                }

                //We get women headed count
                $indicator_one_women_head_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(household_head_type) as hh_type', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_five])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['household_head_type' => 'Female headed'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_women_head_details)) {
                    foreach ($indicator_one_women_head_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['women_heads'] += $_model['hh_type'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['women_heads'] += $_model['hh_type'];
                        }
                    }
                }

                //We get youth count
                $indicator_one_wyouth_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(youth_non_youth) as cnt_youth', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_five])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['youth_non_youth' => 'Youth'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_wyouth_details)) {
                    foreach ($indicator_one_wyouth_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['Youth'] += $_model['cnt_youth'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['Youth'] += $_model['cnt_youth'];
                        }
                    }
                }
                $indicator_5 ['subcomp_21'] = $subcomp_21;
                $indicator_5 ['subcomp_22'] = $subcomp_22;


                //6.We get details for indicator 6
                //We fetch sex details for each subcomponent
                $subcomp_21 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $subcomp_22 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $indicator_one_sex_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['sex', 'count(sex) as cnt_sex', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_six])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['sex', 'topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_sex_details)) {
                    foreach ($indicator_one_sex_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_21['female'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_21['male'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_22['female'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_22['male'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                    }
                }

                //We get women headed count
                $indicator_one_women_head_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(household_head_type) as hh_type', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_six])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['household_head_type' => 'Female headed'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_women_head_details)) {
                    foreach ($indicator_one_women_head_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['women_heads'] += $_model['hh_type'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['women_heads'] += $_model['hh_type'];
                        }
                    }
                }

                //We get youth count
                $indicator_one_wyouth_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(youth_non_youth) as cnt_youth', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_six])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['youth_non_youth' => 'Youth'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_wyouth_details)) {
                    foreach ($indicator_one_wyouth_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['Youth'] += $_model['cnt_youth'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['Youth'] += $_model['cnt_youth'];
                        }
                    }
                }
                $indicator_6 ['subcomp_21'] = $subcomp_21;
                $indicator_6 ['subcomp_22'] = $subcomp_22;

                //7.We get details for indicator 7
                //We fetch sex details for each subcomponent
                $subcomp_21 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $subcomp_22 = [
                    'female' => 0,
                    'male' => 0,
                    'Total_female_male' => 0,
                    'women_heads' => 0,
                    'Youth' => 0
                ];
                $indicator_one_sex_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['sex', 'count(sex) as cnt_sex', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_seven])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['sex', 'topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_sex_details)) {
                    foreach ($indicator_one_sex_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_21['female'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_21['male'] += $_model['cnt_sex'];
                                $subcomp_21['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            if ($_model['sex'] == 'Female') {
                                $subcomp_22['female'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                            if ($_model['sex'] == 'Male') {
                                $subcomp_22['male'] += $_model['cnt_sex'];
                                $subcomp_22['Total_female_male'] += $_model['cnt_sex'];
                            }
                        }
                    }
                }

                //We get women headed count
                $indicator_one_women_head_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(household_head_type) as hh_type', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_seven])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['household_head_type' => 'Female headed'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_women_head_details)) {
                    foreach ($indicator_one_women_head_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['women_heads'] += $_model['hh_type'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['women_heads'] += $_model['hh_type'];
                        }
                    }
                }

                //We get youth count
                $indicator_one_wyouth_details = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->select(['count(youth_non_youth) as cnt_youth', 'topic_subcomponent'])
                        ->where(['topic_indicator' => \backend\models\MeFaabsTrainingAttendanceSheet::indicator_seven])
                        ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                        ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                        ->andWhere(['youth_non_youth' => 'Youth'])
                        ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                        ->groupBy(['topic_subcomponent'])
                        ->asArray()
                        ->all();
                if (!empty($indicator_one_wyouth_details)) {
                    foreach ($indicator_one_wyouth_details as $_model) {
                        if ($_model['topic_subcomponent'] == "Sub-component 2.1") {
                            $subcomp_21['Youth'] += $_model['cnt_youth'];
                        }
                        if ($_model['topic_subcomponent'] == "Sub-component 2.2") {
                            $subcomp_22['Youth'] += $_model['cnt_youth'];
                        }
                    }
                }
                $indicator_7 ['subcomp_21'] = $subcomp_21;
                $indicator_7 ['subcomp_22'] = $subcomp_22;


                //var_dump($indicator_2);
            }

            return $this->render('facilitation-imporoved-technologies', [
                        'searchModel' => $searchModel,
                        'indicator_1' => $indicator_1,
                        'indicator_2' => $indicator_2,
                        'indicator_3' => $indicator_3,
                        'indicator_4' => $indicator_4,
                        'indicator_5' => $indicator_5,
                        'indicator_6' => $indicator_6,
                        'indicator_7' => $indicator_7,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionDownloadFitReport() {
        $province_id = Yii::$app->request->post('province_id', null);
        $district_id = Yii::$app->request->post('district_id', null);
        $camp_id = Yii::$app->request->post('camp_id', null);
        $year = Yii::$app->request->post('year', null);
        $quarter = Yii::$app->request->post('quarter', null);
        $indicator_1 = json_decode(Yii::$app->request->post('indicator_1', null), true);
        $indicator_2 = json_decode(Yii::$app->request->post('indicator_2', null), true);
        $indicator_3 = json_decode(Yii::$app->request->post('indicator_3', null), true);
        $indicator_4 = json_decode(Yii::$app->request->post('indicator_4', null), true);
        $indicator_5 = json_decode(Yii::$app->request->post('indicator_5', null), true);
        $indicator_6 = json_decode(Yii::$app->request->post('indicator_6', null), true);
        $indicator_7 = json_decode(Yii::$app->request->post('indicator_7', null), true);



        $camp_model = \backend\models\Camps::findOne($camp_id);
        $district = !empty($district_id) ? \backend\models\Districts::findOne($district_id)->name : "";
        $province = !empty($province_id) ? \backend\models\Provinces::findOne($province_id)->name : "";
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->applyFromArray(
                [
                    'border' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ]
                ]
        );

        $spreadsheet->getProperties()->setCreator('esappmis')
                ->setLastModifiedBy('esappmis')
                ->setTitle('Office 2007 XLSX Facilitation of Improved Technologies/Best Practices Report')
                ->setSubject('Office 2007 XLSX Facilitation of Improved Technologies/Best Practices Report')
                ->setDescription('Facilitation of Improved Technologies/Best Practices report for Office 2007 XLSX, generated using PHP classes.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Report');

        //Row 1
        if (!empty($province) && !empty($district)) {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B1', 'Province')
                    ->setCellValue('C1', $province)
                    ->setCellValue('D1', 'District')
                    ->setCellValue('E1', $district)
                    ->setCellValue('F1', 'Camp')
                    ->setCellValue('G1', $camp_model->name)
                    ->setCellValue('H1', "Year")
                    ->setCellValue('I1', $year)
                    ->setCellValue('J1', "Quarter")
                    ->setCellValue('K1', $quarter);
            $spreadsheet->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("H1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("J1")->getFont()->setBold(true);
        } else {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B1', 'Camp')
                    ->setCellValue('C1', $camp_model->name)
                    ->setCellValue('D1', "Year")
                    ->setCellValue('E1', $year)
                    ->setCellValue('F1', "Quarter")
                    ->setCellValue('G1', $quarter);
            $spreadsheet->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);
        }

        //Row 2
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('C3', 'Sub-component 2.1')
                ->setCellValue('H3', 'Sub-component 2.2')
                ->mergeCells('C3:G3')
                ->mergeCells('H3:L3');

        //Row 3
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B4', 'Output Level Indicator')
                ->setCellValue('C4', '# Female')
                ->setCellValue('D4', '# Male')
                ->setCellValue('E4', 'Total (female + male)')
                ->setCellValue('F4', 'Women-heads')
                ->setCellValue('G4', 'Youth')
                ->setCellValue('H4', '# Female')
                ->setCellValue('I4', '# Male')
                ->setCellValue('J4', 'Total (female + male)')
                ->setCellValue('K4', 'Women-heads')
                ->setCellValue('L4', 'Youth');
        $spreadsheet->getActiveSheet()->getStyle("B4")->getFont()->setBold(true);

        //Row 4 indicator 1
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B5', 'Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)')
                ->setCellValue('C5', $indicator_1['subcomp_21']['female'])
                ->setCellValue('D5', $indicator_1['subcomp_21']['male'])
                ->setCellValue('E5', $indicator_1['subcomp_21']['Total_female_male'])
                ->setCellValue('F5', $indicator_1['subcomp_21']['women_heads'])
                ->setCellValue('G5', $indicator_1['subcomp_21']['Youth'])
                ->setCellValue('H5', $indicator_1['subcomp_22']['female'])
                ->setCellValue('I5', $indicator_1['subcomp_22']['male'])
                ->setCellValue('J5', $indicator_1['subcomp_22']['Total_female_male'])
                ->setCellValue('K5', $indicator_1['subcomp_22']['women_heads'])
                ->setCellValue('L5', $indicator_1['subcomp_22']['Youth']);

        //Row 5 indicator 2
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B6', 'Number of smallholders trained in improved Post-harvest technologies (at least 2 improved post-harvest technologies)')
                ->setCellValue('C6', $indicator_2['subcomp_21']['female'])
                ->setCellValue('D6', $indicator_2['subcomp_21']['male'])
                ->setCellValue('E6', $indicator_2['subcomp_21']['Total_female_male'])
                ->setCellValue('F6', $indicator_2['subcomp_21']['women_heads'])
                ->setCellValue('G6', $indicator_2['subcomp_21']['Youth'])
                ->setCellValue('H6', $indicator_2['subcomp_22']['female'])
                ->setCellValue('I6', $indicator_2['subcomp_22']['male'])
                ->setCellValue('J6', $indicator_2['subcomp_22']['Total_female_male'])
                ->setCellValue('K6', $indicator_2['subcomp_22']['women_heads'])
                ->setCellValue('L6', $indicator_2['subcomp_22']['Youth']);

        //Row 6 indicator 3
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B7', 'Number of smallholders who have been trained in improved pre- and Post-harvest technologies (at least 2 improved post-harvest technologies) to minimize losses and increase market value of their produce')
                ->setCellValue('C7', $indicator_3['subcomp_21']['female'])
                ->setCellValue('D7', $indicator_3['subcomp_21']['male'])
                ->setCellValue('E7', $indicator_3['subcomp_21']['Total_female_male'])
                ->setCellValue('F7', $indicator_3['subcomp_21']['women_heads'])
                ->setCellValue('G7', $indicator_3['subcomp_21']['Youth'])
                ->setCellValue('H7', $indicator_3['subcomp_22']['female'])
                ->setCellValue('I7', $indicator_3['subcomp_22']['male'])
                ->setCellValue('J7', $indicator_3['subcomp_22']['Total_female_male'])
                ->setCellValue('K7', $indicator_3['subcomp_22']['women_heads'])
                ->setCellValue('L7', $indicator_3['subcomp_22']['Youth']);

        //Row 7 indicator 4
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B8', 'Number of producer organizations/cooperatives/marketing groups established or strengthened [Strengthening of coordination & business models]')
                ->setCellValue('C8', $indicator_4['subcomp_21']['female'])
                ->setCellValue('D8', $indicator_4['subcomp_21']['male'])
                ->setCellValue('E8', $indicator_4['subcomp_21']['Total_female_male'])
                ->setCellValue('F8', $indicator_4['subcomp_21']['women_heads'])
                ->setCellValue('G8', $indicator_4['subcomp_21']['Youth'])
                ->setCellValue('H8', $indicator_4['subcomp_22']['female'])
                ->setCellValue('I8', $indicator_4['subcomp_22']['male'])
                ->setCellValue('J8', $indicator_4['subcomp_22']['Total_female_male'])
                ->setCellValue('K8', $indicator_4['subcomp_22']['women_heads'])
                ->setCellValue('L8', $indicator_4['subcomp_22']['Youth']);

        //Row 8 indicator 5
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B9', 'Number of smallholder producers (desegregated by gender) in organizations/cooperatives/marketing groups trained in crucial aspects for inclusion in VC i.e. identification of partnership opportunities, negotiation, market linkages, business management, governance etc [Strengthening of coordination & business models] ')
                ->setCellValue('C9', $indicator_5['subcomp_21']['female'])
                ->setCellValue('D9', $indicator_5['subcomp_21']['male'])
                ->setCellValue('E9', $indicator_5['subcomp_21']['Total_female_male'])
                ->setCellValue('F9', $indicator_5['subcomp_21']['women_heads'])
                ->setCellValue('G9', $indicator_5['subcomp_21']['Youth'])
                ->setCellValue('H9', $indicator_5['subcomp_22']['female'])
                ->setCellValue('I9', $indicator_5['subcomp_22']['male'])
                ->setCellValue('J9', $indicator_5['subcomp_22']['Total_female_male'])
                ->setCellValue('K9', $indicator_5['subcomp_22']['women_heads'])
                ->setCellValue('L9', $indicator_5['subcomp_22']['Youth']);


        //Row 9 indicator 6
        $spreadsheet->setActiveSheetIndex(0)
                // ->setCellValue('B3', 'Report name')
                ->setCellValue('B10', 'Number of local service providers (farm & non-farm) strengthened and/or trained to provide services that allow production to meet market requirements [Strengthening of coordination & business models]')
                ->setCellValue('C10', $indicator_6['subcomp_21']['female'])
                ->setCellValue('D10', $indicator_6['subcomp_21']['male'])
                ->setCellValue('E10', $indicator_6['subcomp_21']['Total_female_male'])
                ->setCellValue('F10', $indicator_6['subcomp_21']['women_heads'])
                ->setCellValue('G10', $indicator_6['subcomp_21']['Youth'])
                ->setCellValue('H10', $indicator_6['subcomp_22']['female'])
                ->setCellValue('I10', $indicator_6['subcomp_22']['male'])
                ->setCellValue('J10', $indicator_6['subcomp_22']['Total_female_male'])
                ->setCellValue('K10', $indicator_6['subcomp_22']['women_heads'])
                ->setCellValue('L10', $indicator_6['subcomp_22']['Youth']);


        //Row 10 indicator 7
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B11', 'C..1.8 Number of Households reached with targeted support to improve their nutrition')
                ->setCellValue('C11', $indicator_7['subcomp_21']['female'])
                ->setCellValue('D11', $indicator_7['subcomp_21']['male'])
                ->setCellValue('E11', $indicator_7['subcomp_21']['Total_female_male'])
                ->setCellValue('F11', $indicator_7['subcomp_21']['women_heads'])
                ->setCellValue('G11', $indicator_7['subcomp_21']['Youth'])
                ->setCellValue('H11', $indicator_7['subcomp_22']['female'])
                ->setCellValue('I11', $indicator_7['subcomp_22']['male'])
                ->setCellValue('J11', $indicator_7['subcomp_22']['Total_female_male'])
                ->setCellValue('K11', $indicator_7['subcomp_22']['women_heads'])
                ->setCellValue('L11', $indicator_7['subcomp_22']['Youth']);
        // $spreadsheet->getActiveSheet()->getStyle('B11')->getAlignment()->setWrapText(true);
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle($camp_model->name . ' FIT Report');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client's web browser (Xlsx)
        $file = $camp_model->name . '_Facilitation_improved_technologies_report' . date("Ymdhis");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $file . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }



    public function actionDownloadBudget($id) {
	
// 	$user = User::findOne(['id' => Yii::$app->user->id]);
//     $searchModel = new AwpbActivityLine();
//     $query = $searchModel::find();
//     $query->select(['SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']); 
  
//    // $query->where('Awpb_Template.fiscal_year= :field1', [':field1' =>$id]);
//    // $query->groupBy('Awpb_Activity.gl_account_code');

//    // $query->select(['Awpb_Template.fiscal_year as year','Awpb_Activity.gl_account_code as code','SUM(quarter_one_amount) as quarter_one_amount','SUM(quarter_two_amount) as quarter_two_amount','SUM(quarter_three_amount) as quarter_three_amount','SUM(quarter_four_amount) as quarter_four_amount','SUM(total_amount) as total_amount']); 
//     //$query->leftJoin('Awpb_Activity', 'Awpb_Activity.id = AwpbActivityLine.activity_id');
//     //$query->where('Awpb_Template.fiscal_year= :field1', [':field1' =>$id]);
//     //$query->groupBy('Awpb_Activity.gl_account_code');
//     $query->asArray();
//     $query->all();


//     if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch'])) {
//         $faabs_ids = [];
//         $budget_model = MeFaabsGroups::find()->where(['camp_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id']])
//                 ->all();
//         if (!empty($faabs_model)) {
//             foreach ($faabs_model as $id) {
//                 array_push($faabs_ids, $id['id']);
//             }
//         }

        $budget_model= \backend\models\AwpbActivityLine::find()
        ->select(['Awpb_Template.fiscal_year as year', 'Awpb_Activity.gl_account_code as code',
                    'SUM(mo_1_amount) as m1',
                    'SUM(mo_2_amount) as m2',
                    'SUM(mo_3_amount) as m3',
                    'SUM(mo_4_amount) as m4',
                    'SUM(mo_5_amount) as m5',
                    'SUM(mo_6_amount) as m6',
                    'SUM(mo_7_amount) as m7',
                    'SUM(mo_8_amount) as m8',
                    'SUM(mo_9_amount) as m9',
                    'SUM(mo_10_amount) as m10',
                    'SUM(mo_11_amount) as m11',
                    'SUM(mo_12_amount) as m12',
                ])
        ->leftJoin('Awpb_Activity', 'Awpb_Activity.id = Awpb_Activity_Line.activity_id')
        ->leftJoin('Awpb_Template', 'Awpb_Template.id = Awpb_Activity_Line.awpb_template_id')
        ->where(['Awpb_Activity_Line.awpb_template_id' =>$id])
       // ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
      //  ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
       // ->andWhere(['youth_non_youth' => 'Youth'])
       // ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
        ->groupBy(['code'])
        ->asArray()
        ->all();









    $spreadsheet = new Spreadsheet();

        $spreadsheet->getDefaultStyle()->applyFromArray(
                [
                    'border' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ]
                ]
        );
	
	$spreadsheet->getProperties()->setCreator('esappmis')
			->setLastModifiedBy('esappmis')
			->setTitle('Office 2007 XLSX Facilitation of Improved Technologies/Best Practices Report')
			->setSubject('Office 2007 XLSX Facilitation of Improved Technologies/Best Practices Report')
			->setDescription('Facilitation of Improved Technologies/Best Practices report for Office 2007 XLSX, generated using PHP classes.')
			->setKeywords('office 2007 openxml php')
			->setCategory('Report');
	
            if (!empty($budget_model)) {
                $row = 0;
                foreach ($budget_model as $_model) {
                    $year =  $_model['year'];
                    $row1 = $row+1;
                    $row2 = $row1+1;
                    $row3 = $row2+1;
                    $row4 = $row3+1;
                    $row5 = $row4+1;
                    $row6 = $row5+1;
                    $row7 = $row6+1;
                    $row8 = $row7+1;  
                    $row9 = $row8+1;
                    $row10 = $row9+1;
                    $row11 = $row10+1; 
                    $row12 = $row11+1;
            //Legder Account, Budget Period Date, Budget
             //       0700        2019-02-31      K2000
            //
                    $spreadsheet->setActiveSheetIndex(0)
                                    // ->setCellValue('B1', $_model['quarter_one_amount'])
                                    // ->setCellValue('B2',$_model['mo_1'])
                                    // ->setCellValue('B3', $_model['quarter_three_amount'])
                                    // ->setCellValue('B4',$_model['quarter_four_amount'])
                                    
                                    ->setCellValue('A'.$row1, $_model['code'])
                                    ->setCellValue('B'.$row1, $_model['year'].'-01-31')
                                    ->setCellValue('C'.$row1, $_model['m1'])
                                    
                                    ->setCellValue('A'.$row2, $_model['code'])
                                    ->setCellValue('B'.$row2, $_model['year'].'-02-28')
                                    ->setCellValue('C'.$row2, $_model['m2'])
                                  
                                    ->setCellValue('A'.$row3, $_model['code'])
                                    ->setCellValue('B'.$row3, $_model['year'].'-03-31')
                                    ->setCellValue('C'.$row3, $_model['m3'])
                                   
                                    ->setCellValue('A'.$row4, $_model['code'])
                                    ->setCellValue('B'.$row4, $_model['year'].'-04-30')
                                    ->setCellValue('C'.$row4, $_model['m4'])
                                    
                                    ->setCellValue('A'.$row5, $_model['code'])
                                    ->setCellValue('B'.$row5, $_model['year'].'-06-31')
                                    ->setCellValue('C'.$row5, $_model['m5'])
                                    
                                    ->setCellValue('A'.$row6, $_model['code'])
                                    ->setCellValue('B'.$row6, $_model['year'].'-08-30')
                                    ->setCellValue('C'.$row6, $_model['m6'])

                                    ->setCellValue('A'.$row7, $_model['code'])
                                    ->setCellValue('B'.$row7, $_model['year'].'-07-31')
                                    ->setCellValue('C'.$row7, $_model['m7'])

                                    ->setCellValue('A'.$row8, $_model['code'])
                                    ->setCellValue('B'.$row8, $_model['year'].'-08-31')
                                    ->setCellValue('C'.$row8, $_model['m8'])

                                    ->setCellValue('A'.$row9, $_model['code'])
                                    ->setCellValue('B'.$row9, $_model['year'].'-09-30')
                                    ->setCellValue('C'.$row9, $_model['m9'])

                                    ->setCellValue('A'.$row10, $_model['code'])
                                    ->setCellValue('B'.$row10, $_model['year'].'-10-31')
                                    ->setCellValue('C'.$row10, $_model['m10'])

                                    ->setCellValue('A'.$row11, $_model['code'])
                                    ->setCellValue('B'.$row11, $_model['year'].'-11-30')
                                    ->setCellValue('C'.$row11, $_model['m11'])
                                    
                                    ->setCellValue('A'.$row12, $_model['code'])
                                    ->setCellValue('B'.$row12, $_model['year'].'-12-31')
                                    ->setCellValue('C'.$row12, $_model['m12']);
                       
                  $row = $row+12;
                  //$row10 = $row+1;$row11 = $row+1;$row12 = $row+1;
                    }
                }
            
       
        $spreadsheet->getActiveSheet()->setTitle('2020 Budget');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client's web browser (Xlsx)
        $file = $year. '_Budget_'. date("Ymdhis") ;//$camp_model->name . '_Facilitation_improved_technologies_report' . date("Ymdhis");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $file . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }




}
