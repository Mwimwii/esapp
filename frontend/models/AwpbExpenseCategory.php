<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;
/**
 * This is the model class for table "awpb_expense_category".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 */
class AwpbExpenseCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_expense_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'status'], 'required'],
            [['status','created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'status' => 'Status',
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
        return $this->hasMany(AwpbActivity::className(), ['expense_category_id' => 'id']);
    }

    public static function getAwpbExpenseCategoryList() {
        $components = self::find()->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($components, 'id', 'name');
        return $list;
    }
}
