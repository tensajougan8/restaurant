<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property int $mobileno
 * @property string|null $email
 * @property int $position
 * @property string|null $image
 * @property string $dateofjoining
 *
 * @property Positions $position0
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
            [['mobileno', 'position'], 'integer'],
            [['dateofjoining'], 'safe'],
            [['firstname', 'lastname', 'email'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 400],
            // [['position'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::className(), 'targetAttribute' => ['position' => 'p_id']],
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

    /**
     * Gets query for [[Position0]].
     *
     * @return \yii\db\ActiveQuery
     */
    
}
