<?php

namespace backend\models;
use common\models\User;

use Yii;

/**
 * This is the model class for table "mgf_selection_criteria".
 *
 * @property int $id
 * @property string $criterion
 * @property int $category_id
 * @property string $date_created
 * @property int $createdby
 *
 * @property MgfPsso[] $mgfPssos
 * @property Users $createdby0
 * @property MgfSelectionCategory $category
 * @property MgfSelectionGrade[] $mgfSelectionGrades
 */
class MgfSelectionCriteria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_selection_criteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['criterion', 'category_id', 'createdby'], 'required'],
            [['criterion'], 'string'],
            [['category_id', 'createdby'], 'integer'],
            [['date_created'], 'safe'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfSelectionCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'criterion' => 'Criterion',
            'category_id' => 'Category ID',
            'date_created' => 'Date Created',
            'createdby' => 'Createdby',
        ];
    }

    /**
     * Gets query for [[MgfPssos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfPssos()
    {
        return $this->hasMany(MgfPsso::className(), ['criterion_id' => 'id']);
    }

    /**
     * Gets query for [[Createdby0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedby0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdby']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MgfSelectionCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[MgfSelectionGrades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfSelectionGrades()
    {
        return $this->hasMany(MgfSelectionGrade::className(), ['criterion_id' => 'id']);
    }
}
