<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "awpb_template_activity".
 *
 * @property int $id
 * @property int $activity_id
 * @property string $activity_code
 * @property string $name
 * @property int|null $component_id
 * @property int|null $outcome_id
 * @property int|null $output_id
 * @property int $awpb_template_id
 * @property int|null $funder_id
 * @property int|null $expense_category_id
 * @property float|null $ifad
 * @property float|null $ifad_grant
 * @property float|null $grz
 * @property float|null $beneficiaries
 * @property float|null $private_sector
 * @property float|null $iapri
 * @property float|null $parm
 * @property float|null $ifad_amount
 * @property float|null $ifad_grant_amount
 * @property float|null $grz_amount
 * @property float|null $beneficiaries_amount
 * @property float|null $private_sector_amount
 * @property float|null $iapri_amount
 * @property float|null $parm_amount
 * @property float|null $mo_1_amount
 * @property float|null $mo_2_amount
 * @property float|null $mo_3_amount
 * @property float|null $mo_4_amount
 * @property float|null $mo_5_amount
 * @property float|null $mo_6_amount
 * @property float|null $mo_7_amount
 * @property float|null $mo_8_amount
 * @property float|null $mo_9_amount
 * @property float|null $mo_10_amount
 * @property float|null $mo_11_amount
 * @property float|null $mo_12_amount
 * @property float|null $quarter_one_amount
 * @property float|null $quarter_two_amount
 * @property float|null $quarter_three_amount
 * @property float|null $quarter_four_amount
 * @property float|null $budget_amount
 * @property int|null $access_level_district
 * @property int|null $access_level_province
 * @property int|null $access_level_programme
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity $activity
 * @property AwpbTemplate $awpbTemplate
 * @property AwpbComponent $component
 */
class AwpbTemplateActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    //public $activities;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const TYPE_MAIN = 0;
    const TYPE_SUB = 1;
    const STATUS_OPEN = 0;
    const STATUS_LOCKED = 1;
    public static function tableName()
    {
        return 'awpb_template_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['activity_id', 'activity_code', 'name', 'awpb_template_id'], 'required'],
            [['activity_id',  'status','component_id', 'outcome_id', 'output_id', 'awpb_template_id', 'funder_id', 'expense_category_id', 'access_level_district', 'access_level_province', 'access_level_programme', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['ifad', 'ifad_grant', 'grz', 'beneficiaries', 'private_sector', 'iapri', 'parm', 'ifad_amount', 'ifad_grant_amount', 'grz_amount', 'beneficiaries_amount', 'private_sector_amount', 'iapri_amount', 'parm_amount', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'budget_amount'], 'number'],
            [['activity_code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 100],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
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

            'activity_id' => 'Activity',
            'activity_code' => 'Activity Code',
            'name' => 'Name',
            'component_id' => 'Component',

            'outcome_id' => 'Outcome ID',
            'output_id' => 'Output ID',
            'awpb_template_id' => 'Awpb Template',
            'funder_id' => 'Funder',
            'expense_category_id' => 'Expense Category ID',
            'status'=>'Status',
            'ifad' => 'Ifad',
            'ifad_grant' => 'Ifad Grant',
            'grz' => 'Grz',
            'beneficiaries' => 'Beneficiaries',
            'private_sector' => 'Private Sector',
            'iapri' => 'Iapri',
            'parm' => 'Parm',
            'ifad_amount' => 'Ifad Amount',
            'ifad_grant_amount' => 'Ifad Grant Amount',
            'grz_amount' => 'Grz Amount',
            'beneficiaries_amount' => 'Beneficiaries Amount',
            'private_sector_amount' => 'Private Sector Amount',
            'iapri_amount' => 'Iapri Amount',
            'parm_amount' => 'Parm Amount',
            'mo_1_amount' => 'Mo 1 Amount',
            'mo_2_amount' => 'Mo 2 Amount',
            'mo_3_amount' => 'Mo 3 Amount',
            'mo_4_amount' => 'Mo 4 Amount',
            'mo_5_amount' => 'Mo 5 Amount',
            'mo_6_amount' => 'Mo 6 Amount',
            'mo_7_amount' => 'Mo 7 Amount',
            'mo_8_amount' => 'Mo 8 Amount',
            'mo_9_amount' => 'Mo 9 Amount',
            'mo_10_amount' => 'Mo 10 Amount',
            'mo_11_amount' => 'Mo 11 Amount',
            'mo_12_amount' => 'Mo 12 Amount',
            'quarter_one_amount' => 'Quarter One Amount',
            'quarter_two_amount' => 'Quarter Two Amount',
            'quarter_three_amount' => 'Quarter Three Amount',
            'quarter_four_amount' => 'Quarter Four Amount',
            'budget_amount' => 'Budget Amount',
            'access_level_district' => 'Access Level District',
            'access_level_province' => 'Access Level Province',
            'access_level_programme' => 'Access Level Programme',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(AwpbActivity::className(), ['id' => 'activity_id']);
    }
    public function getOutput()
    {
        return $this->hasOne(AwpbOutput::className(), ['id' => 'output_id']);
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
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(AwpbComponent::className(), ['id' => 'component_id']);
    }


    public static function getAwpbActivitiesList() {

        $activties = self::find()
                ->select(['activity_id as id', "CONCAT(.awpb_activity.activity_code,' ',awpb_activity.name) as name"])
                ->joinWith('activity')
                //->joinWith('component')
               ->where(['access_level_district' => self::STATUS_ACTIVE])
               // ->andWhere(['awpb_activity.type' => self::TYPE_SUB])
                ->all();
        $list = ArrayHelper::map($activties, 'id', 'name');
        return $list;
    }


    public static function getActivities1($template_id) {

        
        // $activties = self::find()
        //         ->select(['awpb_template_activity.activity_id', "CONCAT(awpb_activity.activity_code,' ',awpb_activity.name) as name"])
        //         ->joinWith('activity')  
        //         ->where(['awpb_template_activity.awpb_template_id'=>$template_id])
        //         ->andWhere(['=', 'awpb_template_activity.activity_id', 'awpb_activity.id'])
        //         ->all();


                
              
                    $query = self::find()
                    ->where(['awpb_template_id'=>$template_id])
                    ->all();
                    return $query;
                
}
    
    public static function getTemplateActivity($template_id, $activity_id) {
                      $query = self::find()
                    ->where(['awpb_template_id'=>$template_id])
                              ->where(['activity_id'=>$activity_id])
                    ->one();
                    return $query;
                

    }
    
        public static function getActivities($template_id) {
           $activities = self::find()
                ->select(['activity_id', 'name'])
            
                ->where(['awpb_template_id'=>$template_id])
               // ->andWhere(['=', 'awpb_template_activity.activity_id', 'awpb_activity.activity_id'])
                ->all();
      // $list = ArrayHelper::map($activties, 'id', 'name');
        return  $activities;

    }

}
