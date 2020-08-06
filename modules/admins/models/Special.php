<?php

namespace app\modules\admins\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "special".
 *
 * @property int $id
 * @property string $dishname
 * @property string $type
 * @property string $description
 * @property string $image
 * @property string $addedon
 */
class Special extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'special';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dishname', 'type', 'description', 'image'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['dishname'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 90],
            [['description'], 'string', 'max' => 1000],
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
            'dishname' => 'Dishname',
            'type' => 'Type',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Created On',
            'updated_at' => 'Updated On',
            'status' => 'Status',
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
