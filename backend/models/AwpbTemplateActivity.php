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
 * @property int $component_id
 * @property int $outcome_id
 * @property int $output_id
 * @property int|null $awpb_template_id
 * @property int|null $funder_id
 * @property int|null $expense_category_id
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
            [['activity_id', 'awpb_template_id'], 'required'],
            [['activity_code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 40],
            [['activity_id', 'component_id', 'outcome_id', 'output_id', 'awpb_template_id', 'funder_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
            'activity_id' => 'Activity ID',
            'activity_code' => 'Activity Code',    
            'name' => 'Name',
            'component_id' => 'Component ID',
            'outcome_id' => 'Outcome ID',
            'output_id' => 'Output ID',
            'awpb_template_id' => 'Awpb Template ID',
            'funder_id' => 'Funder ID',
            'expense_category_id' => 'Expense Category ID',
            'activities' => 'Activities',
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
    // public static function getActivities($id) {
    //     $data = self::find()
    //     ->where(['awpb_template_id'=>$id])
 
    //     ->all();
    //     $list = ArrayHelper::map($data, 'id','name');
    //     return $list;
    // }
    // public static function getAllRights() {
    //     $query = self::find()->all();
    //     return $query;
    // }
 
    
    public static function getActivities($template_id) {
    


        $activties = self::find()
                ->select(['activity_id', 'name'])
            
                ->where(['awpb_template_id'=>$template_id])
               // ->andWhere(['=', 'awpb_template_activity.activity_id', 'awpb_activity.activity_id'])
                ->all();
      // $list = ArrayHelper::map($activties, 'id', 'name');
        return  $activties;



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

}
