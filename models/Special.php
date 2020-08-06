<?php

namespace app\models;

use Yii;

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
            [['dishname', 'type', 'description', 'image', 'addedon'], 'required'],
            [['addedon'], 'safe'],
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
            'addedon' => 'Addedon',
        ];
    }
}
