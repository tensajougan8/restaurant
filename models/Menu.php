<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yz\shoppingcart\CartPositionTrait;
use yz\shoppingcart\CartPositionInterface;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price
 * @property string $image
 * @property string $type
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Menu extends \yii\db\ActiveRecord implements CartPositionInterface
{
    /**
     * {@inheritdoc}
     */

     use CartPositionTrait;
 
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'image', 'type', 'status', 'created_at', 'updated_at'], 'required'],
            [['price', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['image'], 'string', 'max' => 400],
            [['type'], 'string', 'max' => 50],
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
            'description' => 'Description',
            'price' => 'Price',
            'image' => 'Image',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
}
