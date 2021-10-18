<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "province".
 *
 * @property int $id
 * @property string|null $name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property District[] $districts
 */
class AwpbCostCentre extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'awpb_cost_centre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
           
            [['name'], 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name');
                }, 'message' => 'Name already in use!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Cost centre name',
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

    /**
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getAwpbBudgets() {
//        return $this->hasMany(AwpbBudget::className(), ['cost_Centre_id' => 'id']);
//    }

    public static function getAwpbCostCentreList() {
       $cost_centres  = self::find()->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($cost_centres , 'id', 'name');
        return $list;
    }
    public static function getAwpbCostCentreNames() {
       $cost_centres = self::find()->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($cost_centres , 'name', 'name');
        return $list;
    }

    public static function getAwpbCostCentreById($id) {
       $cost_centre = self::find()->where(['id' => $id])->one();
        return $cost_centre->name;
    }
    public static function getName($id) {
        $cost_centre = self::find()->where(['id' => $id])->one();
        return ucfirst(strtolower($cost_centre->name));
    }

}
