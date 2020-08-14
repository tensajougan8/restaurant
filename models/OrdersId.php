<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orderid".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $status
 * @property string $created_at
 *
 * @property Customer $customer
 * @property Orders[] $orders
 */
class OrdersId extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orderid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'status'], 'required'],
            [['customer_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
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
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['order_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                     'class' => \yii\behaviors\TimestampBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                     ],
                      'value' => new \yii\db\Expression('NOW()'),
                 ],
             ];
         }
}
