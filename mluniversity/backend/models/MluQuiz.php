<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_quiz".
 *
 * @property integer $id
 * @property integer $quiz_id
 * @property integer $course_id
 * @property string $name
 */
class MluQuiz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_quiz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quiz_id', 'course_id', 'name'], 'required'],
            [['quiz_id', 'course_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quiz_id' => 'Quiz ID',
            'course_id' => 'Course ID',
            'name' => 'Name',
        ];
    }
}
