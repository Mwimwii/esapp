<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "awpb_activity".
 *
 * @property int $id
 * @property string $activity_code
 * @property int $parent_activity_id
 * @property int $component_id
 * @property int $awpb_template_id
 * @property string $description
 * @property int $unit_of_measure_id
 * @property float $quarter_one_budget
 * @property float $quarter_two_budget
 * @property float $quarter_three_budget
 * @property float $quarter_four_budget
 * @property float $total_budget
 * @property int $expense_category_id
 * @property int|null $parent_activity_id
 * @property int $component_id
 * @property int $outcome_id
 * @property int $output_id
 * @property int $commodity_type_id
 * @property int $type 0 Main activity, 1 Subactivity
 * @property string|null $activity_type
 * @property int|null $awpb_template_id
 * @property string $description
 * @property string $name
 * @property int|null $unit_of_measure_id
 * @property float|null $programme_target
 * @property float $cumulative_planned
 * @property float $cumulative_actual
 * @property int|null $indicator_id
 * @property int|null $funder_id
 * @property string|null $gl_account_code
 * @property float|null $quarter_one_budget
 * @property float|null $quarter_two_budget
 * @property float|null $quarter_three_budget
 * @property float|null $quarter_four_budget
 * @property float|null $total_budget
 * @property int|null $expense_category_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbComponent $component
 * @property AwpbExpenseCategory $expenseCategory
 * @property AwpbTemplate $awpbTemplate
 * @property AwpbUnitOfMeasure $unitOfMeasure
 * @property AwpbActivityFunder[] $awpbActivityFunders
 * @property AwpbActivityLineItem[] $awpbActivityLineItems
 * @property AwpbFunder $funder
 * @property AwpbIndicator $indicator
 * @property AwpbOutcome $outcome
 * @property AwpbOutput $output
 * @property AwpbCommodityType $commodity
 * @property AwpbActivityFunder[] $awpbActivityFunders
 * @property AwpbActivityLine[] $awpbActivityLines
 * @property AwpbTemplateActivity[] $awpbTemplateActivities
 */
class AwpbActivity extends \yii\db\ActiveRecord {

    public $sub;
    public $year;
    public $district_id;
    public $province_id;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const TYPE_MAIN = 0;
    const TYPE_SUB = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'awpb_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['activity_code','component_id', 'description', 'name'], 'required'],
            [['parent_activity_id', 'component_id', 'outcome_id', 'output_id', 'commodity_type_id', 'type', 'awpb_template_id', 'unit_of_measure_id', 'indicator_id', 'funder_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['programme_target', 'cumulative_planned', 'cumulative_actual', 'quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
            [['activity_code'], 'string', 'max' => 10],
            [['activity_type', 'description'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['gl_account_code'], 'string', 'max' => 4],
            [['activity_code'], 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('activity_code');
                }, 'message' => 'Code already in use!'],
            [['name'], 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name');
                }, 'message' => 'Name already in use!'],
            [['description'], 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('description');
                }, 'message' => 'Description already in use!'],
            ['parent_activity_id', 'required', 'when' => function($model) {
                    return $model->sub == 'Subactivity';
                }, 'message' => 'Parent activity can not be blank!'],
            ['funder_id', 'required', 'when' => function($model) {
                    return $model->sub == 'Subactivity';
                }, 'message' => 'Funder can not be blank!'],
            ['gl_account_code', 'required', 'when' => function($model) {
                    return $model->sub == 'Subactivity';
                }, 'message' => 'General ledger account code can not be blank!'],
            ['expense_category_id', 'required', 'when' => function($model) {
                    return $model->sub == 'Subactivity';
                }, 'message' => 'Expense Category can not be blank!'],
            ['programme_target', 'required', 'when' => function($model) {
                    return $model->sub == 'Subactivity';
                }, 'message' => 'Programme target can not be blank!'],
            ['indicator_id', 'required', 'when' => function($model) {
                    return $model->sub == 'Subactivity';
                }, 'message' => 'Indicator can not be blank!'],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['expense_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbExpenseCategory::className(), 'targetAttribute' => ['expense_category_id' => 'id']],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['unit_of_measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbUnitOfMeasure::className(), 'targetAttribute' => ['unit_of_measure_id' => 'id']],
            [['funder_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbFunder::className(), 'targetAttribute' => ['funder_id' => 'id']],
            [['indicator_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbIndicator::className(), 'targetAttribute' => ['indicator_id' => 'id']],
            [['outcome_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutcome::className(), 'targetAttribute' => ['outcome_id' => 'id']],
            [['output_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutput::className(), 'targetAttribute' => ['output_id' => 'id']],
            [['commodity_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbCommodityTypes::className(), 'targetAttribute' => ['commodity_type_id' => 'id']],
        ];
    }

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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'activity_code' => 'Activity Code',
            'parent_activity_id' => 'Parent Activity',
            'sub' => 'Activity Type',
            'type' => 'Type',
            'activity_type' => 'Activity Type',
            'component_id' => 'Component',
            'awpb_template_id' => 'AWPB Template',
            'description' => 'Description',
            'name' => 'Name',
            'unit_of_measure_id' => 'Unit Of Measure',
            'component_id' => 'Component',
            'outcome_id' => 'Outcome',
            'output_id' => 'Output',
            'commodity_type_id' => 'Commodity',
            'type' => 'Type',
            'activity_type' => 'Activity Type',
            'awpb_template_id' => 'Awpb Template',
            'description' => 'Description',
            'name' => 'Name',
            'unit_of_measure_id' => 'Unit Of Measure',
            'programme_target' => 'Programme Target',
            'cumulative_planned' => 'Cumulative Planned',
            'cumulative_actual' => 'Cumulative Actual',
            'indicator_id' => 'Indicator',
            'funder_id' => 'Funder ID',
            'gl_account_code' => 'Gl Account Code',
            'quarter_one_budget' => 'Quarter One Budget',
            'quarter_two_budget' => 'Quarter Two Budget',
            'quarter_three_budget' => 'Quarter Three Budget',
            'quarter_four_budget' => 'Quarter Four Budget',
            'total_budget' => 'Total Budget',
            'expense_category_id' => 'Expense Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent() {
        return $this->hasOne(AwpbComponent::className(), ['id' => 'component_id']);
    }

    /**
     * Gets query for [[ExpenseCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseCategory() {

        return $this->hasOne(AwpbExpenseCategory::className(), ['id' => 'expense_category_id']);
    }

    /**
     * Gets query for [[AwpbTemplate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbTemplate() {
        return $this->hasOne(AwpbTemplate::className(), ['id' => 'awpb_template_id']);
    }

    /**
     * Gets query for [[UnitOfMeasure]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitOfMeasure() {
        return $this->hasOne(AwpbUnitOfMeasure::className(), ['id' => 'unit_of_measure_id']);
    }

    /**
     * Gets query for [[Funder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFunder() {
        return $this->hasOne(AwpbFunder::className(), ['id' => 'funder_id']);
    }

    /**
     * Gets query for [[Indicator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndicator() {
        return $this->hasOne(AwpbIndicator::className(), ['id' => 'indicator_id']);
    }

    /**
     * Gets query for [[Outcome]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutcome() {
        return $this->hasOne(AwpbOutcome::className(), ['id' => 'outcome_id']);
    }

    /**
     * Gets query for [[Output]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutput() {
        return $this->hasOne(AwpbOutput::className(), ['id' => 'output_id']);
    }

    /**
     * Gets query for [[Commodity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommodity() {
        return $this->hasOne(AwpbCommodityTypes::className(), ['id' => 'commodity_type_id']);
    }

    /**
     * Gets query for [[AwpbActivityFunders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityFunders() {
        return $this->hasMany(AwpbFunder::className(), ['activity_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbActivityLineItems]].
     *
     * @return \yii\db\ActiveQuery
     */
 

    public static function getMainAwpbActivities() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
                ->where(['parent_activity_id' => null])
                ->all();
        $list = ArrayHelper::map($data, 'id', 'name');
        return $list;
    }

    public function getAwpbFunders() {
        return $this->hasMany(AwpbFunder::className(), ['activity_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbActivityLines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityLines() {
        return $this->hasMany(AwpbActivityLine::className(), ['activity_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbTemplateActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbTemplateActivities() {
        return $this->hasMany(AwpbTemplateActivity::className(), ['activity_id' => 'id']);
    }

    public static function getAwpbActivitiesList($access_level) {

        $activties = self::find()
                ->select(['awpb_activity.id', "CONCAT(awpb_activity.activity_code,' ',awpb_activity.name) as name"])
                ->joinWith('component')
                ->where(['awpb_component.access_level' => self::STATUS_ACTIVE])
                ->andWhere(['awpb_activity.type' => self::TYPE_SUB])
                ->all();
        $list = ArrayHelper::map($activties, 'id', 'name');
        return $list;
    }

    /*public static function getAwpbActivitiesList($access_level) {
        // $activties = self::find()->orderBy(['name' => SORT_DESC])->all();
        // $list = ArrayHelper::map( $activties, 'id', 'name');
        // return $list;
        // $activties  = self::find()
        // ->joinWith(['AwpbComponent'])
        // //->select(['*', 'COUNT(AwpbActivity.*) as cnt'])
        // ->orderBy(['name' => SORT_DESC])
        // ->where(['type'=>TYPE_MAIN ])
        // ->andWhere(['parent_component_id'=>null])
        // ->all();
        // $list = ArrayHelper::map($components, 'id', 'name');
        // return $list;

        $activties = self::find()
                ->joinWith('component')
                ->where(['awpb_component.access_level' => self::STATUS_ACTIVE])
                ->andWhere(['awpb_activity.type' => self::TYPE_SUB])
                ->all();
        $list = ArrayHelper::map($activties, 'id', 'activity_code');
        return $list;

        // $activties  = self::find()
        // ->select('awpb_activity.*')
        // ->leftJoin('awpb_component', '`awpb_component`.`id` = `awpb_activity`.`component_id`')
        // ->where(['awpb_component.access_level' =>$access_level])
        // ->with('activities')
        // ->all();
        // $list = ArrayHelper::map( $activties, 'id', 'name');
        // return $list;
    }*/

    public static function getAwpbActivitiesListPW($access_level) {


        $activties = self::find()
                ->select(['awpb_activity.id', "CONCAT(awpb_activity.activity_code,' ',awpb_activity.name) as name"])
                ->joinWith('component')
                ->where(['!=', 'awpb_component.access_level', self::STATUS_ACTIVE])
                // ->where(['awpb_component.access_level' =>self::STATUS_ACTIVE])
                ->andWhere(['awpb_activity.type' => self::TYPE_SUB])
                ->all();
        $list = ArrayHelper::map($activties, 'id', 'name');
        return $list;
    }

    public static function getName($id) {
        $component = self::find()->where(['id' => $id])->one();
        return ucfirst(strtolower($component->name));
    }

    public static function getAwpbActivityCodeName($id) {

        $activties = self::find()
                ->select(['awpb_activity.id', "CONCAT(awpb_activity.activity_code,' ',awpb_activity.name) as name"])
                ->where(['id' => $id])
                ->one();
        return $activties->name;
    }

    public static function getAwpbComponentActivities($id) {
        $awpbactivities = self::find()
                ->select(["CONCAT(activity_code,' ',name) as name", 'id'])
                //->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'id'])
                ->where(['component_id' => $id])
                ->andWhere(['type' => self::TYPE_MAIN])
                ->asArray()
                ->all();
        return $awpbactivities;
    }

    /* public static function getAwpbComponentActivities($id, $dummy) {
      $awpbactivities = self::find()
      ->select(['id', 'name'])
      ->where(['component_id' => $id])
      ->andWhere(['type' => self::TYPE_MAIN])
      ->asArray()
      ->all();
      return $awpbactivities;
      } */

    public static function getAwpbActivities() {
        $awpbactivities = self::find()
                ->select(['id', 'name'])
                //->where(['component_id'=>$id])
                //->where(['type'=>self::TYPE_MAIN])
                ->asArray()
                ->all();
        return $awpbactivities;
    }

    public static function getActivities() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
                //->where(['NOT', 'parent_activity_id'=>null])
                ->all();
        $list = ArrayHelper::map($data, 'id', 'name');
        return $list;
    }

    public static function getSubActivities() {
        $data = self::find()
                ->select(["CONCAT(activity_code,' ',name) as name", 'id'])
                //->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'id'])
                //->where(['component_id'=>$id])
                ->where(['type' => self::TYPE_SUB])
                ->asArray()
                ->all();
        $list = ArrayHelper::map($data, 'name', 'name');
        return $list;
    }

    public static function getSubActivityList() {
        $data = self::find()
                ->select(["CONCAT(activity_code,' ',name) as name", 'id'])
                //->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'id'])
                //->where(['component_id'=>$id])
                ->where(['type' => self::TYPE_SUB])
                ->orderBy(['parent_activity_id' => SORT_ASC])
                ->all();
        $list = ArrayHelper::map($data, 'id', 'name');
        return $list;
    }

    public static function getParentAwpbActivity($id) {
        $data = self::find()->orderBy(['name' => SORT_ASC])
                ->where(['parent_activity_id' => $id])
                ->all();
        $list = ArrayHelper::map($data, 'id', 'name');
        return $list;
    }

   

    public static function getAllSubActivities() {
        $query = self::find()
        ->select(["CONCAT(activity_code,' ',name) as name", 'id'])
        ->where(['type' => self::TYPE_SUB])
        ->orderBy(['parent_activity_id' => SORT_ASC])
        ->all();
        return $query;
    }
    

}
