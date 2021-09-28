<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awbp_expense_category".
 *
 * @property int $id
 * @property string $expense_category_code
 * @property string $expense_category_name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 */
class AwbpExpenseCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awbp_expense_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expense_category_code', 'expense_category_name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['expense_category_code'], 'string', 'max' => 6],
            [['expense_category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expense_category_code' => 'Expense Category Code',
            'expense_category_name' => 'Expense Category Name',
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
}
