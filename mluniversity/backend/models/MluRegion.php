<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_region".
 *
 * @property integer $id
 * @property string $short_name
 * @property string $full_name
 */
class MluRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_name', 'full_name'], 'required'],
            [['short_name'], 'string', 'max' => 15],
            [['full_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_name' => 'Short Name',
            'full_name' => 'Full Name',
        ];
    }
}