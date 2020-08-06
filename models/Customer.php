<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string|null $landmark
 * @property string $phoneno
 * @property string|null $email_id
 * @property int|null $alernateno
 * @property string $created_at
 * @property string|null $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phoneno', 'created_at'], 'required'],
            [['alernateno'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'landmark'], 'string', 'max' => 90],
            [['address'], 'string', 'max' => 300],
            [['phoneno'], 'string', 'max' => 30],
            [['email_id'], 'string', 'max' => 100],
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
            'address' => 'Address',
            'landmark' => 'Landmark',
            'phoneno' => 'Phoneno',
            'email_id' => 'Email ID',
            'alernateno' => 'Alernateno',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
