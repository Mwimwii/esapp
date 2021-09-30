<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "me_back_to_office_annexes".
 *
 * @property int $id
 * @property int $btor_id
 * @property string|null $file
 * @property string|null $type
 *
 * @property MeBackToOfficeReport $btor
 */
class BackToOfficeAnnexes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'me_back_to_office_annexes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['btor_id'], 'required'],
            [['btor_id'], 'integer'],
            [['type'], 'string'],
            [['file','file_name'], 'string', 'max' => 255],
            [['btor_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeBackToOfficeReport::className(), 'targetAttribute' => ['btor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'btor_id' => 'Btor ID',
            'file' => 'File',
            'file_name' => 'File name',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[Btor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBtor()
    {
        return $this->hasOne(MeBackToOfficeReport::className(), ['id' => 'btor_id']);
    }
}
