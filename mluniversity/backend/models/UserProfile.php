<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $avatar_path
 * @property string $avatar_base_url
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $picture;

    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'firstname', 'lastname'], 'required'],
            [['user_id'], 'integer'],
            [['firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['picture'], 'file'],
            /*['picture', 'required', 'when' => function($model) {
                return $model->picture == '';
            }],*/
        ];
    }

    /*public function upload()
    {
        if ($this->validate()) {
            $this->picture->saveAs('uploads/' . $this->picture->baseName . '.' . $this->picture->extension);
            return true;
        } else {
            return false;
        }
    }*/

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'lastname' => 'Lastname',
            'avatar_path' => 'Avatar Path',
            'avatar_base_url' => 'Avatar Base Url',
            'picture' => 'Display Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
