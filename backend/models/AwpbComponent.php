<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;
use backend\models\AwpbActivity;
use backend\models\AwpbActivitySearch;
/**
 * This is the model class for table "awpb_component".
 *
 * @property int $id
 * @property string $code
 * @property int|null $parent_component_id
 * @property string $description
 * @property string $name
 * @property string|null $outcome
 * @property string|null $output
 * @property string|null $subcomponent
 * @property int $funder_id
 * @property int $expense_category_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbExpenseCategory $expenseCategory
 * @property AwpbFunder $funder
 */
class AwpbComponent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TYPE_MAIN = 0;
    const TYPE_SUB = 1;

    public $sub_component;


    public static function tableName()
    {
        return 'awpb_component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code',  'name','description','type'], 'required'],
            [['access_level','parent_component_id','type','funder_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['outcome', 'output'], 'string'],
            [['code'], 'string', 'max' => 10],
            
            [['gl_account_code'], 'string', 'min' => 4,'max' => 4],
            [[ 'name', 'description','subcomponent'], 'string', 'max' => 255],
            [['description','name',], 'unique'],
            [['code'], 'unique'],
            ['gl_account_code', 'required', 'when' => function($model) {
                return $model->subcomponent== 'Subcomponent';
                       }, 'message' => 'Parent Component can not be blank for a subcomponent!'],
                       ['access_level', 'required', 'when' => function($model) {
                        return $model->subcomponent== 'Component';
                               }, 'message' => 'Access level can not be blank for a main component!'],          
            [['expense_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbExpenseCategory::className(), 'targetAttribute' => ['expense_category_id' => 'id']],
            [['funder_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbFunder::className(), 'targetAttribute' => ['funder_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'parent_component_id' => 'Parent Component',
            'name' => 'Name',
            'outcome' => 'Outcome',
            'output' => 'Output',
            'subcomponent' => 'Component Type',
            'access_level'=>'Access Level',
            'sub_component'=>'Component Type',
            'type' => 'Type',
            'funder_id' => 'Funder',
            'gl_account_code' => 'General Ledger Account Code',
            'expense_category_id' => 'Expense Category',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[AwpbActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivities()
    {
        return $this->hasMany(AwpbActivity::className(), ['component_id' => 'id']);
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
     * Gets query for [[Funder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFunder()
    {
        return $this->hasOne(AwpbFunder::className(), ['id' => 'funder_id']);
    }

    public static function getAwpbComponentsList() {
    //     $countActivities = AwpbActivity::find()->select('component_id');

    //     $subQuery = AwpbActivity::find()->select('id');
    //    // $components = self::find()->where(['type', 'id', $subQuery])->all();
    //     $components = self::find()->where('id Not IN (SELECT component_id from awpb_activity)')->all();
    //     $list = ArrayHelper::map($components, 'id', 'name');
    //     return $list;

    //     ->where(['type'=>TYPE_MAIN ])


    //     $rc=0;
        $components = self::find()
        ->where(['type'=>self::TYPE_MAIN ])
        ->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($components, 'id', 'name');
        return $list;
   
    //     $components = self::find()
    //     ->joinWith(['AwpbActivity'])
    //     ->select(['*', 'COUNT(AwpbActivity.*) as cnt'])
    //     ->orderBy(['cnt' => 'DESC'])
    //     ->where(['type'=>TYPE_MAIN ])
    //     ->andWhere(['parent_component_id'=>null])
    //     ->all();
    //     $list = ArrayHelper::map($components, 'id', 'name');
    //     return $list;

    //     $count = (new \yii\db\Query())
    //     ->from('user')
    //     ->where(['last_name' => 'Smith'])
    //     ->count();
    // return  $awpbactivities;
   
    }

    public static function getAwpbSubComponentsList() {
   
   
            $components = self::find()
            ->where(['type'=>self::TYPE_SUB ])
            ->orderBy(['name' => SORT_ASC])->all();
            $list = ArrayHelper::map($components, 'id', 'name');
            return $list;
       
        //     $components = self::find()
        //   
       
        }
    
    public static function getAwpbComponentCodes() {
        $components = self::find()->orderBy(['code' => SORT_ASC])->all();
        $list = ArrayHelper::map($components, 'id', 'code');
        return $list;
    }
	 public static function findById($id) {
        return static::findOne(['id' => $id]);
    }
    public static function getComponentById($id) {
        $data = self::find()->where(['code' => $id])->one();
	   return $data->code;
       }
      
    public static function getName($id) {
        $component = self::find()->where(['id' => $id])->one();
        return ucfirst(strtolower($this->name));
    
    }

}
