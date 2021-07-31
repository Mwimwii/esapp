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
                'only' => [
                    'facilitation-imporoved-technologies',
                    'download-fit-report',
                    'training-attendance-cumulatives',
                    'physical-tracking-table'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'facilitation-imporoved-technologies',
                            'download-fit-report',
                            'training-attendance-cumulatives',
                            'physical-tracking-table'
                        ],
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

    /*
     * 
     */

    public function actionPhysicalTrackingTable() {
        if (User::userIsAllowedTo('View physical tracking table report')) {
            $searchModel = new \backend\models\AwbpActivitySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            // var_dump($dataProvider->getModels());
            $year = date('Y');
            if (isset(Yii::$app->request->queryParams['AwbpActivitySearch'])) {
                /* if (!empty(Yii::$app->request->queryParams['AwbpActivitySearch']['province_id'])) {
                  // $dataProvider->query->andFilterWhere(['province_id' => Yii::$app->request->queryParams['AwpbActivityLineSearch']['province_id']]);
                  $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);
                  if (!empty($awpb_template)) {
                  $activity_ids = [];
                  $activity_lines = \backend\models\AwpbActivityLine::find()
                  ->where(['awpb_template_id' => $awpb_template->id])
                  ->andWhere(['province_id' => Yii::$app->request->queryParams['AwbpActivitySearch']['province_id']])
                  ->all();
                  if (!empty($activity_lines)) {
                  foreach ($activity_lines as $_activity) {
                  array_push($activity_ids, $_activity['activity_id']);
                  }
                  }
                  $dataProvider->query->andFilterWhere(["IN", 'id', $activity_ids]);
                  }
                  }
                  if (!empty(Yii::$app->request->queryParams['AwbpActivitySearch']['district_id'])) {
                  $dataProvider->query->andFilterWhere(['district_id' => Yii::$app->request->queryParams['AwbpActivitySearch']['district_id']]);
                  }
                  if (!empty(Yii::$app->request->queryParams['AwbpActivitySearch']['year'])) {
                  $year = Yii::$app->request->queryParams['AwbpActivitySearch']['year'];
                  $dataProvider->query->andFilterWhere(['year' => Yii::$app->request->queryParams['AwbpActivitySearch']['year']]);
                  } */
            } else {
                $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => date('Y')]);
                //1. Load template for the current year
                //2. use template to fetch activity lines for the year
                //3. use Activity lines [activity_ids] to pull the subactivities from the activities table
                //4. 
                if (!empty($awpb_template)) {
                    $activity_ids = [];
                    $activity_lines = \backend\models\AwpbActivityLine::find()
                            ->where(['awpb_template_id' => $awpb_template->id])
                            ->all();
                    if (!empty($activity_lines)) {
                        foreach ($activity_lines as $_activity) {
                            array_push($activity_ids, $_activity['activity_id']);
                        }
                    }
                    $dataProvider->query->andFilterWhere(["IN", 'id', $activity_ids]);
                }
            }

            //We only need sub activities
            $dataProvider->query->andFilterWhere(['activity_type' => "Subactivity"]);

            $dataProvider->setSort([
                'attributes' => [
                    'id' => [
                        'desc' => ['id' => SORT_ASC],
                        'default' => SORT_ASC
                    ],
                ],
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ]);



            return $this->render('physical-tracking-table', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'fiscal_year' => $year,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /*
     * 
     */

    public function actionTrainingAttendanceCumulatives() {
        if (User::userIsAllowedTo('View training attendance cumulative report')) {
            $_data = [];
            $searchModel = new \backend\models\MeFaabsTrainingAttendanceSheetSearch();


            //Filter by province
            if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['province_id']) &&
                    empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['district_id']) &&
                    empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id'])) {
                $district_ids = [];
                $faabs_ids = [];
                $_camp_ids = [];


                //We get all the districts in a province
                $districts = \backend\models\Districts::find()->where(['province_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['province_id']])->all();
                if (!empty($districts)) {
                    foreach ($districts as $id) {
                        array_push($district_ids, $id['id']);
                    }
                }

                //We get all the camps in a province
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(["IN", 'district_id', $district_ids])
                        ->asArray()
                        ->all();


                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                }


                //We get all the FaaBS in a province
                $faabs_model = MeFaabsGroups::find()->where(["IN", 'camp_id', $_camp_ids])
                        ->asArray()
                        ->all();

                if (!empty($faabs_model)) {
                    $_years = "";
                    foreach ($faabs_model as $id) {
                        if (!in_array($id['id'], $faabs_ids)) {
                            array_push($faabs_ids, $id['id']);
                            $_faabs = [];
                            $jan_jun_count = 0;
                            $jul_dec_count = 0;
                            $_faabs[$id['name']] = [
                                //'id' => $id['id'],
                                'camp' => \backend\models\Camps::findOne($id['camp_id'])->name,
                                'total_faabs_enrolled' => \backend\models\MeFaabsCategoryAFarmers::find()
                                        ->where(['faabs_group_id' => $id['id']])
                                        ->count()
                            ];


                            //We get those trained in a year for a particular period
                            /* $_years = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->select(['YEAR(training_date) as year'])
                              ->where(["faabs_group_id" => $id['id']])
                              ->distinct()
                              ->all(); */
                            //if (!empty($_years)) {
                            //  foreach ($_years as $yr) {
                            //We use hardcoded years instead of dynamically fetching them
                            //2019,2020,2021,2022,2023,2024
                            //1.2019
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2019'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);

                            //2.2020
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2020'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //3.2021
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2021'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //4.2022
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2022'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //5.2023
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2023'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //6.2024
                            /* $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $_cnt_array['2024'] = [
                              'jan_jun' => $jan_jun_count,
                              'jul_dec' => $jul_dec_count
                              ];
                              array_push($_faabs[$id['name']], $_cnt_array); */
                            //}


                            array_push($_data, $_faabs);
                            //}
                        }
                    }
                    //var_dump($_data);
                }
            }

            //Filter by district
            if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['province_id']) &&
                    !empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['district_id']) &&
                    empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id'])) {
                $district_ids = [];
                $faabs_ids = [];
                $_camp_ids = [];

                //We get all the camps in a district
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['district_id']])
                        ->asArray()
                        ->all();


                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                }


                //We get all the FaaBS in a district
                $faabs_model = MeFaabsGroups::find()->where(["IN", 'camp_id', $_camp_ids])
                        ->asArray()
                        ->all();

                if (!empty($faabs_model)) {
                    $_years = "";
                    foreach ($faabs_model as $id) {
                        if (!in_array($id['id'], $faabs_ids)) {
                            array_push($faabs_ids, $id['id']);
                            $_faabs = [];
                            $jan_jun_count = 0;
                            $jul_dec_count = 0;
                            $_faabs[$id['name']] = [
                                //'id' => $id['id'],
                                'camp' => \backend\models\Camps::findOne($id['camp_id'])->name,
                                'total_faabs_enrolled' => \backend\models\MeFaabsCategoryAFarmers::find()
                                        ->where(['faabs_group_id' => $id['id']])
                                        ->count()
                            ];


                            //We get those trained in a year for a particular period
                            /* $_years = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->select(['YEAR(training_date) as year'])
                              ->where(["faabs_group_id" => $id['id']])
                              ->distinct()
                              ->all(); */
                            //if (!empty($_years)) {
                            //  foreach ($_years as $yr) {
                            //We use hardcoded years instead of dynamically fetching them
                            //2019,2020,2021,2022,2023,2024
                            //1.2019
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2019'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);

                            //2.2020
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2020'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //3.2021
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2021'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //4.2022
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2022'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //5.2023
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2023'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //6.2024
                            /* $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $_cnt_array['2024'] = [
                              'jan_jun' => $jan_jun_count,
                              'jul_dec' => $jul_dec_count
                              ];
                              array_push($_faabs[$id['name']], $_cnt_array); */
                            //}


                            array_push($_data, $_faabs);
                            //}
                        }
                    }
                    //var_dump($_data);
                }
            }

            //Filter by camp
            if (!empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['province_id']) &&
                    !empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['district_id']) &&
                    !empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id'])) {
                $district_ids = [];
                $faabs_ids = [];

                //We get all the FaaBS in a camp
                $faabs_model = MeFaabsGroups::find()->where(['camp_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id']])
                        ->asArray()
                        ->all();

                if (!empty($faabs_model)) {
                    $_years = "";
                    foreach ($faabs_model as $id) {
                        if (!in_array($id['id'], $faabs_ids)) {
                            array_push($faabs_ids, $id['id']);
                            $_faabs = [];
                            $jan_jun_count = 0;
                            $jul_dec_count = 0;
                            $_faabs[$id['name']] = [
                                //'id' => $id['id'],
                                'camp' => \backend\models\Camps::findOne($id['camp_id'])->name,
                                'total_faabs_enrolled' => \backend\models\MeFaabsCategoryAFarmers::find()
                                        ->where(['faabs_group_id' => $id['id']])
                                        ->count()
                            ];


                            //We get those trained in a year for a particular period
                            //if (!empty($_years)) {
                            //  foreach ($_years as $yr) {
                            //We use hardcoded years instead of dynamically fetching them
                            //2019,2020,2021,2022,2023,2024
                            //1.2019
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2019'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);

                            //2.2020
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2020'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //3.2021
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2021'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //4.2022
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2022'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //5.2023
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2023'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //6.2024
                            /* $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $_cnt_array['2024'] = [
                              'jan_jun' => $jan_jun_count,
                              'jul_dec' => $jul_dec_count
                              ];
                              array_push($_faabs[$id['name']], $_cnt_array); */
                            //}


                            array_push($_data, $_faabs);
                            //}
                        }
                    }
                    //var_dump($_data);
                }
            }
            //Filter by camp for camp/district users only
            if (empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['province_id']) &&
                    empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['district_id']) &&
                    !empty(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id'])) {
                $district_ids = [];
                $faabs_ids = [];

                //We get all the FaaBS in a camp
                $faabs_model = MeFaabsGroups::find()->where(['camp_id' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['camp_id']])
                        ->asArray()
                        ->all();

                if (!empty($faabs_model)) {
                    $_years = "";
                    foreach ($faabs_model as $id) {
                        if (!in_array($id['id'], $faabs_ids)) {
                            array_push($faabs_ids, $id['id']);
                            $_faabs = [];
                            $jan_jun_count = 0;
                            $jul_dec_count = 0;
                            $_faabs[$id['name']] = [
                                //'id' => $id['id'],
                                'camp' => \backend\models\Camps::findOne($id['camp_id'])->name,
                                'total_faabs_enrolled' => \backend\models\MeFaabsCategoryAFarmers::find()
                                        ->where(['faabs_group_id' => $id['id']])
                                        ->count()
                            ];


                            //We get those trained in a year for a particular period
                            //if (!empty($_years)) {
                            //  foreach ($_years as $yr) {
                            //We use hardcoded years instead of dynamically fetching them
                            //2019,2020,2021,2022,2023,2024
                            //1.2019
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2019'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2019'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);

                            //2.2020
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2020'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2020'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //3.2021
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2021'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2021'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //4.2022
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2022'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2022'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //5.2023
                            $_cnt_array = [];
                            $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                                    ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                                    ->andWhere(['YEAR(training_date)' => '2023'])
                                    ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                                    ->count();
                            $_cnt_array['2023'] = [
                                'jan_jun' => $jan_jun_count,
                                'jul_dec' => $jul_dec_count
                            ];
                            array_push($_faabs[$id['name']], $_cnt_array);
                            //6.2024
                            /* $jan_jun_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [1, 2, 3, 4, 5, 6]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $jul_dec_count = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                              ->where(['IN', 'MONTH(training_date)', [7, 8, 9, 10, 11, 12]])
                              ->andWhere(['YEAR(training_date)' => '2024'])
                              ->andWhere(['training_type' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['training_type']])
                              ->count();
                              $_cnt_array['2024'] = [
                              'jan_jun' => $jan_jun_count,
                              'jul_dec' => $jul_dec_count
                              ];
                              array_push($_faabs[$id['name']], $_cnt_array); */
                            //}


                            array_push($_data, $_faabs);
                            //}
                        }
                    }
                    //var_dump($_data);
                }
            }

            return $this->render('training-attendance-cumulatives', [
                        'searchModel' => $searchModel,
                        'data' => $_data,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * 
     * Lists all MeFaabsGroups models.
     * @return mixed
     */
    public function actionFacilitationImporovedTechnologies() {
        if (User::userIsAllowedTo('View facilitation of improved technologies/best practices report')) {
            $searchModel = new \backend\models\MeFaabsTrainingAttendanceSheetSearch();

            //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

    public function actionDownloadPhysicalTrackingTable() {
        $searchModel = new \backend\models\AwbpActivitySearch();

        $province_id = Yii::$app->request->post('province_id', null);
        $district_id = Yii::$app->request->post('district_id', null);
        $year = Yii::$app->request->post('year', null);
        $dataProvider = $searchModel->searchByYearProvinceDistrict($year, $province_id, $district_id);
        //var_dump($dataProvider->getModels());
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
                ->setTitle('Office 2007 XLSX Physical tracking table')
                ->setSubject('Office 2007 XLSX Physical tracking table')
                ->setDescription('Physical tracking table for Office 2007 XLSX, generated using PHP classes.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Report');

        //Header row
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B1', 'Physical Progress Tracking Table')
                ->setCellValue('H1', "Planned AWPB ")
                ->setCellValue('M1', 'Actual AWPB ')
                ->setCellValue('R1', "")
                ->mergeCells('B1:G1')
                ->mergeCells('H1:L1')
                ->mergeCells('M1:Q1')
                ->mergeCells('R1:V1');
        $spreadsheet->getActiveSheet()->getStyle("B1:G1")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("B1:G1")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("H1:L1")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("M1:Q1")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("R1:V1")->getAlignment()->setHorizontal('center');


        //Second row
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B2', 'Comp#')
                ->setCellValue('C2', 'Sub-comp')
                ->setCellValue('D2', 'Activity Description#')
                ->setCellValue('E2', 'Indicator')
                ->setCellValue('F2', 'Unity')
                ->setCellValue('G2', 'AWPB target')
                ->setCellValue('H2', 'Q1')
                ->setCellValue('I2', "Q2")
                ->setCellValue('J2', 'Q3')
                ->setCellValue('K2', "Q4")
                ->setCellValue('L2', "Total")
                ->setCellValue('M2', "Q1")
                ->setCellValue('N2', "Q2")
                ->setCellValue('O2', "Q3")
                ->setCellValue('P2', "Q4")
                ->setCellValue('Q2', "Total")
                ->setCellValue('R2', "% AWPB Achieved")
                ->setCellValue('S2', "Cum Actual")
                ->setCellValue('T2', "Appr Target")
                ->setCellValue('U2', "% Appr Target")
                ->setCellValue('V2', "Remarks");
        $current_row = 3;
        foreach ($dataProvider->getModels() as $models => $model) {
            $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);
            //Get component
            $component = "";
            $component_model = \backend\models\AwpbComponent::findOne($model->component_id);
            if (!empty($component_model)) {
                if ($component_model->subcomponent == "Subcomponent") {
                    $component = \backend\models\AwpbComponent::findOne($component_model->parent_component_id)->code;
                } else {
                    $component = $component_model->code;
                }
            }

            //Get subcomponent
            $subcomponent = "";
            if (!empty($component_model)) {
                if ($component_model->subcomponent == "Subcomponent") {
                    $subcomponent = $component_model->code;
                }
            }

            //get indicator
            $awpb_indicator = \backend\models\AwpbIndicator::findOne($model->indicator_id);
            //Get awpb target
            $awpb_q_total = 0;
            if (!empty($awpb_template)) {
                //Get all activity lines that belongs to this subactivity
                $activity_lines = \backend\models\AwpbActivityLine::find()
                        ->where(['activity_id' => $model->id])
                        ->andWhere(['awpb_template_id' => $awpb_template->id])
                        ->all();
                if (!empty($activity_lines)) {
                    foreach ($activity_lines as $_line) {
                        $awpb_q_total += $_line['mo_1'];
                        $awpb_q_total += $_line['mo_2'];
                        $awpb_q_total += $_line['mo_3'];
                        $awpb_q_total += $_line['mo_4'];
                        $awpb_q_total += $_line['mo_5'];
                        $awpb_q_total += $_line['mo_6'];
                        $awpb_q_total += $_line['mo_7'];
                        $awpb_q_total += $_line['mo_8'];
                        $awpb_q_total += $_line['mo_9'];
                        $awpb_q_total += $_line['mo_10'];
                        $awpb_q_total += $_line['mo_11'];
                        $awpb_q_total += $_line['mo_12'];
                    }
                }
            }

            //Planned q1
            $planned_q1_total = 0;
            //Planned q2
            $planned_q2_total = 0;
            //Planned q3
            $planned_q3_total = 0;
            //Planned q4
            $planned_q4_total = 0;
            //actuals
            $actual_q1_total = 0;
            $actual_q2_total = 0;
            $actual_q3_total = 0;
            $actual_q4_total = 0;

            if (!empty($awpb_template)) {
                //Get all activity lines that belongs to this subactivity
                $activity_lines = \backend\models\AwpbActivityLine::find()
                        ->where(['activity_id' => $model->id])
                        ->andWhere(['awpb_template_id' => $awpb_template->id])
                        ->all();
                if (!empty($activity_lines)) {
                    foreach ($activity_lines as $_line) {
                        $planned_q1_total += $_line['mo_1'];
                        $planned_q1_total += $_line['mo_2'];
                        $planned_q1_total += $_line['mo_3'];
                        $planned_q2_total += $_line['mo_4'];
                        $planned_q2_total += $_line['mo_5'];
                        $planned_q2_total += $_line['mo_6'];
                        $planned_q3_total += $_line['mo_7'];
                        $planned_q3_total += $_line['mo_8'];
                        $planned_q3_total += $_line['mo_9'];
                        $planned_q4_total += $_line['mo_10'];
                        $planned_q4_total += $_line['mo_11'];
                        $planned_q4_total += $_line['mo_12'];

                        $actual_q1_total += $_line['mo_1_actual'];
                        $actual_q1_total += $_line['mo_2_actual'];
                        $actual_q1_total += $_line['mo_3_actual'];
                        $actual_q2_total += $_line['mo_4_actual'];
                        $actual_q2_total += $_line['mo_5_actual'];
                        $actual_q2_total += $_line['mo_6_actual'];
                        $actual_q3_total += $_line['mo_7_actual'];
                        $actual_q3_total += $_line['mo_8_actual'];
                        $actual_q3_total += $_line['mo_9_actual'];
                        $actual_q4_total += $_line['mo_10_actual'];
                        $actual_q4_total += $_line['mo_11_actual'];
                        $actual_q4_total += $_line['mo_12_actual'];
                    }
                }
            }

            //calculate planned/achieved percentage
            $awpb_achieved = 0;
            $planned_q_total = $planned_q1_total + $planned_q2_total + $planned_q3_total + $planned_q4_total;
            $actual_q_total = $actual_q1_total + $actual_q2_total + $actual_q3_total + $actual_q4_total;
            if ($planned_q_total > 0) {
                $awpb_achieved = round(($actual_q_total / $planned_q_total) * 100, 1);
            }

            $appr_percentage = 0;
            $appr = !empty($model->programme_target) ? $model->programme_target : 0;
            $cum_actual = !empty($model->cumulative_actual) ? $model->cumulative_actual : 0;
            if ($appr > 0) {
                $appr_percentage = round(($cum_actual / $appr) * 100, 2);
            }

            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue("B" . $current_row, $component)
                    ->setCellValue("C" . $current_row, $subcomponent)
                    ->setCellValue("D" . $current_row, $model->name)
                    ->setCellValue("E" . $current_row, !empty($awpb_indicator) ? $awpb_indicator->name : "")
                    ->setCellValue("F" . $current_row, !empty($model->unit_of_measure_id) ? \backend\models\AwpbUnitOfMeasure::findOne($model->unit_of_measure_id)->name : "")
                    ->setCellValue("G" . $current_row, $awpb_q_total)
                    ->setCellValue("H" . $current_row, $planned_q1_total)
                    ->setCellValue("I" . $current_row, $planned_q2_total)
                    ->setCellValue("J" . $current_row, $planned_q3_total)
                    ->setCellValue("K" . $current_row, $planned_q4_total)
                    ->setCellValue("L" . $current_row, $planned_q_total)
                    ->setCellValue("M" . $current_row, $actual_q1_total)
                    ->setCellValue("N" . $current_row, $actual_q2_total)
                    ->setCellValue("O" . $current_row, $actual_q3_total)
                    ->setCellValue("P" . $current_row, $actual_q4_total)
                    ->setCellValue("Q" . $current_row, $actual_q_total)
                    ->setCellValue("R" . $current_row, $awpb_achieved)
                    ->setCellValue("S" . $current_row, $appr_percentage)
                    ->setCellValue("T" . $current_row, $appr)
                    ->setCellValue("U" . $current_row, $appr_percentage)
                    ->setCellValue("V" . $current_row, "");
            $current_row++;
        }



        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $file = 'Physical_tracking_table' . date("Ymdhis");
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Physical tracking table');
        // Redirect output to a client's web browser (Xlsx)
        if (!empty($province)) {
            $file = 'Physicaltrktbl' . $province . date("Ymdhis");
            $spreadsheet->getActiveSheet()->setTitle('Physicaltrktbl|' . $province);
        }
        if (!empty($district) && !empty($province)) {
            $file = 'Physicaltrktbl' . $province . "_" . $district . date("Ymdhis");
            $spreadsheet->getActiveSheet()->setTitle('Physicaltrktbl|' . $province . "|" . $district);
        }
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

    public function actionDownloadTacReport() {
        $province_id = Yii::$app->request->post('province_id', null);
        $district_id = Yii::$app->request->post('district_id', null);
        $camp_id = Yii::$app->request->post('camp_id', null);
        $training_type = Yii::$app->request->post('training_type', null);
        $data = json_decode(Yii::$app->request->post('data', null), true);
        // $camp_model = \backend\models\Camps::findOne($camp_id);
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
                ->setTitle('Office 2007 XLSX FaaBS Training Attendance- cumulative Report')
                ->setSubject('Office 2007 XLSX FaaBS Training Attendance- cumulative Report')
                ->setDescription('FaaBS Training Attendance- cumulative report for Office 2007 XLSX, generated using PHP classes.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Report');

        //Row 1
        if (!empty($province) || !empty($district)) {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B1', 'Province')
                    ->setCellValue('C1', !empty($province) ? $province : "")
                    ->setCellValue('D1', 'District')
                    ->setCellValue('E1', !empty($district) ? $district : "")
                    ->setCellValue('F1', 'Reporting date')
                    ->setCellValue('G1', date("Y/m/d"));
            $spreadsheet->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);
        } else {
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B1', 'Reporting date')
                    ->setCellValue('C1', date("Y/m/d"));
            $spreadsheet->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
        }

        //Row 2
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B3', $training_type)
                ->mergeCells('B3:O3');
        $spreadsheet->getActiveSheet()->getStyle("B3")->getFont()->setBold(true);

        //Row 3
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B4', 'FaaBS Location Details')
                ->setCellValue('D4', '')
                ->setCellValue('E4', '2019')
                ->setCellValue('G4', '2020')
                ->setCellValue('I4', '2021')
                ->setCellValue('K4', '2022')
                ->setCellValue('M4', '2023')
                ->mergeCells('B4:C4')
                ->mergeCells('E4:F4')
                ->mergeCells('G4:H4')
                ->mergeCells('I4:J4')
                ->mergeCells('K4:L4')
                ->mergeCells('M4:N4');
        $spreadsheet->getActiveSheet()->getStyle("B4")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("E4")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("G4")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("I4")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("K4")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("M4")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("B4")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("E4")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("G4")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("I4")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("K4")->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("M4")->getAlignment()->setHorizontal('center');

        //Row 4
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B5', 'Name of FaaBS')
                ->setCellValue('C5', 'Camp')
                ->setCellValue('D5', 'Total number enrolled in FaaBS')
                ->setCellValue('E5', '# of Trained [Jan-Jun]')
                ->setCellValue('F5', '# of Trained [Jul-Dec]')
                ->setCellValue('G5', '# of Trained [Jan-Jun]')
                ->setCellValue('H5', '# of Trained [Jul-Dec]')
                ->setCellValue('I5', '# of Trained [Jan-Jun]')
                ->setCellValue('J5', '# of Trained [Jul-Dec]')
                ->setCellValue('K5', '# of Trained [Jan-Jun]')
                ->setCellValue('L5', '# of Trained [Jul-Dec]')
                ->setCellValue('M5', '# of Trained [Jan-Jun]')
                ->setCellValue('N5', '# of Trained [Jul-Dec]');

        //Row 6
        $sum_2019_jan_jun = 0;
        $sum_2019_jul_dec = 0;
        $sum_2020_jan_jun = 0;
        $sum_2020_jul_dec = 0;
        $sum_2021_jan_jun = 0;
        $sum_2021_jul_dec = 0;
        $sum_2022_jan_jun = 0;
        $sum_2022_jul_dec = 0;
        $sum_2023_jan_jun = 0;
        $sum_2023_jul_dec = 0;
        $sum_total_enrolled = 0;
        $current_row = 6;

        foreach ($data as $_data) {
            foreach ($_data as $key => $value) {
                $sum_2019_jan_jun += $value[0]['2019']['jan_jun'];
                $sum_2019_jul_dec += $value[0]['2019']['jul_dec'];
                $sum_2020_jan_jun += $value[1]['2020']['jan_jun'];
                $sum_2020_jul_dec += $value[1]['2020']['jul_dec'];
                $sum_2021_jan_jun += $value[2]['2021']['jan_jun'];
                $sum_2021_jul_dec += $value[2]['2021']['jul_dec'];
                $sum_2022_jan_jun += $value[3]['2022']['jan_jun'];
                $sum_2022_jul_dec += $value[3]['2022']['jul_dec'];
                $sum_2023_jan_jun += $value[4]['2023']['jan_jun'];
                $sum_2023_jul_dec += $value[4]['2023']['jul_dec'];
                $sum_total_enrolled += $value['total_faabs_enrolled'];

                $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B' . $current_row, $key)
                        ->setCellValue('C' . $current_row, $value['camp'])
                        ->setCellValue('D' . $current_row, $value['total_faabs_enrolled'])
                        ->setCellValue('E' . $current_row, $value[0]['2019']['jan_jun'])
                        ->setCellValue('F' . $current_row, $value[0]['2019']['jul_dec'])
                        ->setCellValue('G' . $current_row, $value[1]['2020']['jan_jun'])
                        ->setCellValue('H' . $current_row, $value[1]['2020']['jul_dec'])
                        ->setCellValue('I' . $current_row, $value[2]['2021']['jan_jun'])
                        ->setCellValue('J' . $current_row, $value[2]['2021']['jul_dec'])
                        ->setCellValue('K' . $current_row, $value[3]['2022']['jan_jun'])
                        ->setCellValue('L' . $current_row, $value[3]['2022']['jul_dec'])
                        ->setCellValue('M' . $current_row, $value[4]['2023']['jan_jun'])
                        ->setCellValue('N' . $current_row, $value[4]['2023']['jul_dec']);
                $spreadsheet->getActiveSheet()->getStyle("D" . $current_row . ":N" . $current_row)->getAlignment()->setHorizontal('center');
                $current_row++;
            }
        }

        //Row after loop
        $_next_row = $current_row;
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $_next_row, "")
                ->setCellValue('C' . $_next_row, "Total")
                ->setCellValue('D' . $_next_row, $sum_total_enrolled)
                ->setCellValue('E' . $_next_row, $sum_2019_jan_jun)
                ->setCellValue('F' . $_next_row, $sum_2019_jul_dec)
                ->setCellValue('G' . $_next_row, $sum_2020_jan_jun)
                ->setCellValue('H' . $_next_row, $sum_2020_jul_dec)
                ->setCellValue('I' . $_next_row, $sum_2021_jan_jun)
                ->setCellValue('J' . $_next_row, $sum_2021_jul_dec)
                ->setCellValue('K' . $_next_row, $sum_2022_jan_jun)
                ->setCellValue('L' . $_next_row, $sum_2022_jul_dec)
                ->setCellValue('M' . $_next_row, $sum_2023_jan_jun)
                ->setCellValue('N' . $_next_row, $sum_2023_jul_dec);
        $spreadsheet->getActiveSheet()->getStyle("D" . $_next_row . ":N" . $_next_row)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle("C" . $_next_row)->getAlignment()->setHorizontal('right');
        $spreadsheet->getActiveSheet()->getStyle("C" . $_next_row . ":N" . $_next_row)->getFont()->setBold(true);

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Training attendance cumulative');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client's web browser (Xlsx)
        $file = 'Training attendance cumulative_' . date("Ymdhis");
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
    $budget_model = \backend\models\AwpbGeneralLedger::find()
                ->select(['awpb_template.fiscal_year as year', 'awpb_general_ledger.general_ledger_account as code',
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
               // ->leftJoin('awpb_activity', 'awpb_activity.id = awpb_activity_line.activity_id')
                ->leftJoin('awpb_template', 'awpb_template.id = awpb_general_ledger.awpb_template_id')
                ->where(['awpb_general_ledger.awpb_template_id' => $id])
                // ->andWhere(['quarter' => Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['quarter']])
                //  ->andWhere(['IN', 'faabs_group_id', $faabs_ids])
                // ->andWhere(['youth_non_youth' => 'Youth'])
                // ->andWhere(['YEAR(training_date)' => date("Y", strtotime(Yii::$app->request->queryParams['MeFaabsTrainingAttendanceSheetSearch']['year']))])
                ->groupBy(['funder_id'])
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
//$year="";
        if (!empty($budget_model)) {
            $row = 0;
            foreach ($budget_model as $_model) {
                $year = $_model['year'];
                $row1 = $row + 1;
                $row2 = $row1 + 1;
                $row3 = $row2 + 1;
                $row4 = $row3 + 1;
                $row5 = $row4 + 1;
                $row6 = $row5 + 1;
                $row7 = $row6 + 1;
                $row8 = $row7 + 1;
                $row9 = $row8 + 1;
                $row10 = $row9 + 1;
                $row11 = $row10 + 1;
                $row12 = $row11 + 1;
                //Legder Account, Budget Period Date, Budget
                //       0700        2019-02-31      K2000
                //
                $spreadsheet->setActiveSheetIndex(0)
                        // ->setCellValue('B1', $_model['quarter_one_amount'])
                        // ->setCellValue('B2',$_model['mo_1'])
                        // ->setCellValue('B3', $_model['quarter_three_amount'])
                        // ->setCellValue('B4',$_model['quarter_four_amount'])
                        ->setCellValue('A' . $row1, $_model['code'])
                        ->setCellValue('B' . $row1, $_model['year'] . '-01-31')
                        ->setCellValue('C' . $row1, $_model['m1'])
                        ->setCellValue('A' . $row2, $_model['code'])
                        ->setCellValue('B' . $row2, $_model['year'] . '-02-28')
                        ->setCellValue('C' . $row2, $_model['m2'])
                        ->setCellValue('A' . $row3, $_model['code'])
                        ->setCellValue('B' . $row3, $_model['year'] . '-03-31')
                        ->setCellValue('C' . $row3, $_model['m3'])
                        ->setCellValue('A' . $row4, $_model['code'])
                        ->setCellValue('B' . $row4, $_model['year'] . '-04-30')
                        ->setCellValue('C' . $row4, $_model['m4'])
                        ->setCellValue('A' . $row5, $_model['code'])
                        ->setCellValue('B' . $row5, $_model['year'] . '-06-31')
                        ->setCellValue('C' . $row5, $_model['m5'])
                        ->setCellValue('A' . $row6, $_model['code'])
                        ->setCellValue('B' . $row6, $_model['year'] . '-08-30')
                        ->setCellValue('C' . $row6, $_model['m6'])
                        ->setCellValue('A' . $row7, $_model['code'])
                        ->setCellValue('B' . $row7, $_model['year'] . '-07-31')
                        ->setCellValue('C' . $row7, $_model['m7'])
                        ->setCellValue('A' . $row8, $_model['code'])
                        ->setCellValue('B' . $row8, $_model['year'] . '-08-31')
                        ->setCellValue('C' . $row8, $_model['m8'])
                        ->setCellValue('A' . $row9, $_model['code'])
                        ->setCellValue('B' . $row9, $_model['year'] . '-09-30')
                        ->setCellValue('C' . $row9, $_model['m9'])
                        ->setCellValue('A' . $row10, $_model['code'])
                        ->setCellValue('B' . $row10, $_model['year'] . '-10-31')
                        ->setCellValue('C' . $row10, $_model['m10'])
                        ->setCellValue('A' . $row11, $_model['code'])
                        ->setCellValue('B' . $row11, $_model['year'] . '-11-30')
                        ->setCellValue('C' . $row11, $_model['m11'])
                        ->setCellValue('A' . $row12, $_model['code'])
                        ->setCellValue('B' . $row12, $_model['year'] . '-12-31')
                        ->setCellValue('C' . $row12, $_model['m12']);

                $row = $row + 12;
                //$row10 = $row+1;$row11 = $row+1;$row12 = $row+1;
            }
        }


        $spreadsheet->getActiveSheet()->setTitle( $year.' Budget');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client's web browser (Xlsx)
        $file = $year.'_Budget_' . date("Ymdhis"); //$camp_model->name . '_Facilitation_improved_technologies_report' . date("Ymdhis");
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
