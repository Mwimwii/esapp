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
 */
class AwpbActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const TYPE_MAIN = 0;
    const TYPE_SUB = 1;
    public $sub;
    public static function tableName()
    {
        return 'awpb_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_code', 'component_id',  'name','description'], 'required'],
            [['id', 'parent_activity_id','indicator_id','component_id','type',  'unit_of_measure_id','funder_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['programme_target','quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
            [['activity_code'], 'string', 'max' => 10],
            [['gl_account_code'], 'string', 'min' => 4,'max' => 4],
            [['name'], 'string', 'max' => 40],
            [['description','name','activity_type'], 'string', 'max' => 255],          
            [['description','name',], 'unique'],
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
            [['indicator_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbIndicator::className(), 'targetAttribute' => ['indicator_id' => 'id']],
            [['expense_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbExpenseCategory::className(), 'targetAttribute' => ['expense_category_id' => 'id']],
           [['funder_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbFunder::className(), 'targetAttribute' => ['funder_id' => 'id']],
           // [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['unit_of_measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbUnitOfMeasure::className(), 'targetAttribute' => ['unit_of_measure_id' => 'id']],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_code' => 'Activity Code',
            'parent_activity_id' => 'Parent Activity',
            'sub' => 'Activity Type',
            'type'=> 'Type',
            'activity_type'=> 'Activity Type',
            'component_id' => 'Component',
           // 'awpb_template_id' => 'AWPB Template',
            'description' => 'Description',
            'name'=>'Name',
            'indicator_id'=>'Indicator',
            'programme_target'=>'Appraisal Target',
            'funder_id'=>'Funder',
            'gl_account_code' => 'General Ledger Account Code',
            'unit_of_measure_id' => 'Unit Of Measure',
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
    public function getComponent()
    {
        return $this->hasOne(AwpbComponent::className(), ['id' => 'component_id']);
    }

    /**
     * Gets query for [[ExpenseCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseCategory()
    {
        return $this->hasOne(AwpbExpenseCategory::className(), ['id' => 'expense_category_id']);
    }

    /**
     * Gets query for [[AwpbTemplate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbTemplate()
    {
        return $this->hasOne(AwpbTemplate::className(), ['id' => 'awpb_template_id']);
    }

    /**
     * Gets query for [[UnitOfMeasure]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitOfMeasure()
    {
        return $this->hasOne(AwpbUnitOfMeasure::className(), ['id' => 'unit_of_measure_id']);
    }

    /**
     * Gets query for [[AwpbActivityFunders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityFunders()
    {
        return $this->hasMany(AwpbActivityFunder::className(), ['activity_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbActivityLineItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivitiesLineItems()
    {
        return $this->hasMany(AwpbActivityLineItem::className(), ['activity_id' => 'id']);
    }
	  public static function getAwpbActivitiesList($access_level) {
     

        $activties  = self::find()
        ->select(['awpb_activity.id',"CONCAT(awpb_activity.activity_code,' ',awpb_activity.name) as name"])
        ->joinWith('component')
        ->where(['awpb_component.access_level' =>self::STATUS_ACTIVE])
        ->andWhere(['awpb_activity.type'=>self::TYPE_SUB])  
         ->all();
         $list = ArrayHelper::map( $activties, 'id', 'name');
         return $list;

    }
    public static function getAwpbActivitiesListPW($access_level) {
     

        $activties  = self::find()
        ->select(['awpb_activity.id',"CONCAT(awpb_activity.activity_code,' ',awpb_activity.name) as name"])
        ->joinWith('component')
        ->where(['!=', 'awpb_component.access_level', self::STATUS_ACTIVE])
       // ->where(['awpb_component.access_level' =>self::STATUS_ACTIVE])
        ->andWhere(['awpb_activity.type'=>self::TYPE_SUB])  
      
         ->all();
         $list = ArrayHelper::map( $activties, 'id', 'name');
         return $list;

    }

    public static function getName($id) {
        $component = self::find()->where(['id' => $id])->one();
        return ucfirst(strtolower($this->name));
    }
    public static function getAwpbActivityCodeName($id) {
      
        $activties  = self::find()
        ->select(['awpb_activity.id',"CONCAT(awpb_activity.activity_code,' ',awpb_activity.name) as name"])      
        ->where(['id' =>$id])     
        ->one();
        return $activties->name;
    }


    public static function getAwpbComponentActivities($id)
    {
        $awpbactivities = self::find()
            ->select(['id','name'])
            ->where(['component_id'=>$id])
            ->andWhere(['type'=>self::TYPE_MAIN])
            ->asArray()
            ->all();
        return  $awpbactivities;
   
    }
    public static function getAwpbActivities()
    {
        $awpbactivities = self::find()
            ->select(['id','name'])
            //->where(['component_id'=>$id])
            //->where(['type'=>self::TYPE_MAIN])
            ->asArray()
            ->all();
        return  $awpbactivities;
   
    }
    
    public static function getActivities() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
       // ->where(['parent_activity_id'=>null])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
    public static function getMainAwpbActivities() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
        ->where(['parent_activity_id'=>null])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
    public static function getParentAwpbActivity($id) {
        $data = self::find()->orderBy(['name' => SORT_ASC])
        ->where(['parent_activity_id'=>$id])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
	
}
