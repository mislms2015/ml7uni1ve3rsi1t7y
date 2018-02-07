<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_manual_assessment".
 *
 * @property integer $id
 * @property integer $training_id
 * @property string $fname
 * @property string $lname
 * @property integer $id_number
 *
 * @property MluManualTraining $training
 */
class MluManualAssessment extends \yii\db\ActiveRecord
{
    Public $trainingupload;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_manual_assessment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_id', 'fname', 'lname', 'id_number'], 'required'],
            [['training_id', 'id_number'], 'integer'],
            [['fname', 'lname'], 'string', 'max' => 50],
            [['training_id'], 'exist', 'skipOnError' => true, 'targetClass' => MluManualTraining::className(), 'targetAttribute' => ['training_id' => 'id']],

/*[['logo'], 'file', 'extensions'=>'svg, png', 'when' => function ($model) {
             //return true to apply the rule
             return $model->isImageUploaded();
        }],*/

            /*['trainingupload', 'file', 'extensions' => 'xls, xlsx', 'when' => function ($model){
                return $model->trainingupload == '';
            }],*/
            [['trainingupload'], 'file'],
            ['trainingupload', 'required', 'when' => function($model) {
                return $model->trainingupload == '';
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'training_id' => 'Training Attended',
            'fname' => 'Firstname',
            'lname' => 'Lastname',
            'id_number' => 'ID Number',
            'trainingupload' => 'Training File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraining()
    {
        return $this->hasOne(MluManualTraining::className(), ['id' => 'training_id']);
    }

    /** 
    * @return \yii\db\ActiveQuery 
    * manually added after generating model for mlu_manual_diamond
    */ 
   public function getMluManualDiamonds() 
   { 
       return $this->hasMany(MluManualDiamond::className(), ['examinee_id' => 'id']); 
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getMluManualGolds()
   {
       return $this->hasMany(MluManualGold::className(), ['examinee_id' => 'id']);
   }
    
}
