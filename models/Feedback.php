<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $phone
 * @property string $created_at
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message', 'phone', 'created_at'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 99],
            [['email'], 'string', 'max' => 544],
            [['message'], 'string', 'max' => 4000],
            [['phone'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
            'phone' => 'Phone',
            'created_at' => 'Created At',
        ];
    }
}
