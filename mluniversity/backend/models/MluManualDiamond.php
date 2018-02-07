<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_manual_diamond".
 *
 * @property integer $id
 * @property integer $examinee_id
 * @property string $clarity
 * @property string $color
 * @property string $cut
 * @property string $carat
 *
 * @property MluManualAssessment $examinee
 */
class MluManualDiamond extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_manual_diamond';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['examinee_id', 'clarity', 'color', 'cut', 'carat'], 'required'],
            [['examinee_id'], 'integer'],
            [['clarity', 'color', 'cut', 'carat'], 'string', 'max' => 5],
            [['examinee_id'], 'exist', 'skipOnError' => true, 'targetClass' => MluManualAssessment::className(), 'targetAttribute' => ['examinee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'examinee_id' => 'Examinee ID',
            'clarity' => 'Clarity',
            'color' => 'Color',
            'cut' => 'Cut',
            'carat' => 'Carat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExaminee()
    {
        return $this->hasOne(MluManualAssessment::className(), ['id' => 'examinee_id']);
    }
}
