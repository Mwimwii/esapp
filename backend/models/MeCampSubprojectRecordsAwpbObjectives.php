<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use kartik\builder\TabularForm;

/**
 * This is the model class for table "me_camp_subproject_records_awpb_objectives".
 *
 * @property int $id
 * @property int $camp_id
 * @property int $quarter
 * @property string $key_indicators
 * @property string $period_unit
 * @property string $target
 * @property string $year
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Camp $camp
 */
class MeCampSubprojectRecordsAwpbObjectives extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_camp_subproject_records_awpb_objectives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['camp_id', 'quarter', 'key_indicators', 'period_unit', 'target', 'year'], 'required'],
            [['camp_id', 'quarter', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['key_indicators'], 'string'],
            [['period_unit', 'target'], 'string', 'max' => 255],
            [['year'], 'string', 'max' => 5],
            ['camp_id', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('camp_id') && !empty(self::findOne(['quarter' => $model->quarter, "camp_id" => $model->camp_id, 'year' => $model->year])) ? TRUE : FALSE;
                }, 'message' => 'Camp/Project AWPB Template exist for this camp for the said quarter and year!'],
            ['quarter', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('quarter') && !empty(self::findOne(['quarter' => $model->quarter, "camp_id" => $model->camp_id, 'year' => $model->year])) ? TRUE : FALSE;
                }, 'message' => 'Camp/Project AWPB Template exist for this camp for the said quarter and year!'],
            ['year', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('year') && !empty(self::findOne(['quarter' => $model->quarter, "camp_id" => $model->camp_id, 'year' => $model->year])) ? TRUE : FALSE;
                }, 'message' => 'Camp/Project AWPB Template exist for this camp for the said quarter and year!'],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camps::className(), 'targetAttribute' => ['camp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'camp_id' => 'Camp',
            'quarter' => 'Quarter',
            'key_indicators' => 'Key indicators',
            'period_unit' => 'Period/Unit',
            'target' => 'Target',
            'year' => 'Year',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public static function getFormAttribs() {
        return [
            // primary key column
            'id' => [// primary key attribute
                'type' => TabularForm::INPUT_HIDDEN,
                'columnOptions' => ['hidden' => true]
            ],
            'camp_id' => [
                'type' => \kartik\builder\TabularForm::INPUT_STATIC,
                'label' => 'Camp',
                'options' => ['style' => 'width:200px;'],
                'value' => function($model) {
                    return Camps::findOne($model->camp_id)->name;
                }
            ],
            'quarter' => [
                'label' => 'Quarter',
                'type' => \kartik\builder\TabularForm::INPUT_STATIC,
                'options' => ['style' => 'width:30px;'],
            ],
            'key_indicators' => [
                'label' => 'Key indicators',
                'type' => function($model) {
                    return $model->year == date("Y") ? TabularForm::INPUT_TEXTAREA : TabularForm::INPUT_STATIC;
                },
                // 'widgetClass' => '\kartik\touchspin\TouchSpin',
                'options' => [
                    'style' => 'width:350px;',
                    'placeholder' => "Set Quarter key indicators as a list i.e \nIndicator one\nIndicator two",
                    'class' => 'form-control',
                    'rows' => 4,
                ],
            ],
            'period_unit' => [
                'label' => 'Period/Unit',
                //'columnOptions' => ['vAlign' => \kartik\grid\GridView::ALIGN_MIDDLE],
                'type' => \kartik\builder\TabularForm::INPUT_TEXT,
                'options' => [
                    'style' => 'width:220px;',
                    "class" => "text-center",
                    'placeholder' => "Set period/Unit"
                ],
            ],
            'target' => [
                'label' => 'Target',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => '\kartik\touchspin\TouchSpin',
            //'options' => ['placeholder' => "Set Quarter target"],
            ],
            'year' => [
                'label' => 'Year',
                'type' => \kartik\builder\TabularForm::INPUT_STATIC,
                'options' => ['style' => 'width:60px;'],
            ],
        ];
    }

    /**
     * Gets query for [[Camp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCamp() {
        return $this->hasOne(Camps::className(), ['id' => 'camp_id']);
    }

    public static function CreateAwpbTemplates() {
        $camps_model = Camps::find()
                ->select(['id'])
                ->asArray()
                ->all();

        if (!empty($camps_model)) {
            foreach ($camps_model as $_model) {
                //First Quarter template
                $model = new MeCampSubprojectRecordsAwpbObjectives();
                $model->camp_id = $_model['id'];
                $model->quarter = 1;
                $model->key_indicators = "Not set";
                $model->period_unit = "Not set";
                $model->target = "Not set";
                $model->year = date("Y");
                $model->save();
                //Second Quarter template
                $model1 = new MeCampSubprojectRecordsAwpbObjectives();
                $model1->camp_id = $_model['id'];
                $model1->quarter = 2;
                $model1->key_indicators = "Not set";
                $model1->period_unit = "Not set";
                $model1->target = "Not set";
                $model1->year = date("Y");
                $model1->save();
                //Third Quarter template
                $model2 = new MeCampSubprojectRecordsAwpbObjectives();
                $model2->camp_id = $_model['id'];
                $model2->quarter = 3;
                $model2->key_indicators = "Not set";
                $model2->period_unit = "Not set";
                $model2->target = "Not set";
                $model2->year = date("Y");
                $model2->save();
                //Fourth Quarter template
                $model3 = new MeCampSubprojectRecordsAwpbObjectives();
                $model3->camp_id = $_model['id'];
                $model3->quarter = 4;
                $model3->key_indicators = "Not set";
                $model3->period_unit = "Not set";
                $model3->target = "Not set";
                $model3->year = date("Y");
                $model3->save();
            }
        }
    }

}
