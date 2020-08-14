<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "loyalty".
 *
 * @property int $id
 * @property int $customer_id
 * @property float $points
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customer $id0
 */
class Loyalty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loyalty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'points'], 'required'],
            [['customer_id'], 'integer'],
            [['points'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'points' => 'Points',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Customer::className(), ['id' => 'id']);
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
