<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_manual_training".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_conduct
 * @property string $date_conduct_to
 * @property string $trainor
 *
 * @property MluManualAssessment[] $mluManualAssessments
 */
class MluManualTraining extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_manual_training';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_conduct', 'trainor'], 'required'],
            [['date_conduct', 'date_conduct_to'], 'safe'],
            [['name', 'trainor'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_conduct' => 'Date Conduct',
            'date_conduct_to' => 'Date Conduct To',
            'trainor' => 'Trainor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMluManualAssessments()
    {
        return $this->hasMany(MluManualAssessment::className(), ['training_id' => 'id']);
    }
}
