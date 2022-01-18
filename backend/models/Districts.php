<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "district".
 *
 * @property int $id
 * @property int $province_id
 * @property string|null $name
 * @property string|null $lat
 * @property string|null $long
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Camp[] $camps
 * @property Province $province
 * @property Market[] $markets
 */
class Districts extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['province_id', 'name'], 'required'],
            [['province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['lat', 'long'], 'string', 'max' => 20],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') &&
                            empty($model->province_id) ? TRUE : FALSE;
                }, 'message' => 'District name already exist!'],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') && !empty(self::findOne(['name' => $model->name, "province_id" => $model->province_id])) ? TRUE : FALSE;
                }, 'message' => 'District name already exist for this province!'],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'province_id' => 'Province',
            'name' => 'District Name',
            'lat' => 'Lat',
            'long' => 'Long',
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
     * Gets query for [[Camps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCamps() {
        return $this->hasMany(Camp::className(), ['district_id' => 'id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince() {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[Markets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarkets() {
        return $this->hasMany(Market::className(), ['district_id' => 'id']);
    }

    public static function getNames() {
        $names = self::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($names, 'name', 'name');
    }

    public static function getList() {
        $list = self::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public static function getById($id) {
        $data = self::find()->where(['id' => $id])->one();
        return $data->name;
    }

       public function getAwpbBudgets() {
        return $this->hasMany(Market::className(), ['district_id' => 'id']);
    }
      public function getAwpbDistricts() {
        return $this->hasMany(Camp::className(), ['district_id' => 'id']);
    }
     public static function getDistrictList($id) {
        $district= self::find()->where(['province_id' => $id])->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($district, 'id', 'name');
        return $list;
    }

}
