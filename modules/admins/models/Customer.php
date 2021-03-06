<?php

namespace app\modules\admins\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

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
            [['phoneno'], 'udokmeci\yii2PhoneValidator\PhoneValidator','country'=>'IN'],
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

     public function behaviors()
    {
        return [
            'timestamp' => [
                     'class' => \yii\behaviors\TimestampBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                     ],
                      'value' => new \yii\db\Expression('NOW()'),
                 ],
             ];
         }
}
