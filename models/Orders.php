<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $order_id
 * @property int $customer_id
 * @property int $item_id
 * @property int $quantity
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customer $customer
 * @property Menu $item
 * @property Orderid $order
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'customer_id', 'item_id', 'quantity', 'status'], 'required'],
            [['order_id', 'customer_id', 'item_id', 'quantity', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orderid::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'customer_id' => 'Customer ID',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Menu::className(), ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orderid::className(), ['id' => 'order_id']);
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
