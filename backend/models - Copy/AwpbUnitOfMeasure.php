<?php

namespace backend\models;

use Yii;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;
/**
 * This is the model class for table "awpb_unit_of_measure".
 *
 * @property int $id

 * @property string $name

 * @property string $description
 * @property int $status
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at

 *
 * @property AwpbActivity[] $awpbActivities
 */
class AwpbUnitOfMeasure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_unit_of_measure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['name', 'status'], 'required'],
            [['status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[AwpbActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivities()
    {
        return $this->hasMany(AwpbActivity::className(), ['unit_of_measure_id' => 'id']);
    }
    public static function getAwpbUnitOfMeasuresList() {
        $unitofmeasures = self::find()->orderBy(['name' => SORT_DESC])->all();
        $list = ArrayHelper::map($unitofmeasures, 'id', 'name');
        return $list;
    }
}
