<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_manual_gold".
 *
 * @property integer $id
 * @property integer $examinee_id
 * @property string $day1
 * @property string $day2
 *
 * @property MluManualAssessment $examinee
 */
class MluManualGold extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_manual_gold';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['examinee_id', 'day1', 'day2'], 'required'],
            [['examinee_id'], 'integer'],
            [['day1', 'day2'], 'string', 'max' => 5],
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
            'day1' => 'Day1',
            'day2' => 'Day2',
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
