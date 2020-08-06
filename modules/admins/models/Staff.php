<?php

namespace app\modules\admins\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property int $mobileno
 * @property string|null $email
 * @property string $position
 * @property string|null $image
 * @property string $dateofjoining
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'mobileno', 'position', 'dateofjoining'], 'required'],
            [['mobileno'], 'udokmeci\yii2PhoneValidator\PhoneValidator','country'=>'IN'],
            [['dateofjoining'], 'safe'],
            [['firstname', 'lastname', 'email'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 30],
            [['image'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'mobileno' => 'Mobileno',
            'email' => 'Email',
            'position' => 'Position',
            'image' => 'Image',
            'dateofjoining' => 'Dateofjoining',
        ];
    }
}
