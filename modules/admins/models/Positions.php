<?php

namespace app\modules\admins\models;

use Yii;

/**
 * This is the model class for table "positions".
 *
 * @property int $id
 * @property int $p_id
 * @property string $pname
 *
 * @property Staff[] $staff
 */
class Positions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'positions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_id', 'pname'], 'required'],
            [['p_id'], 'integer'],
            [['pname'], 'string', 'max' => 255],
            [['p_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_id' => 'P ID',
            'pname' => 'Pname',
        ];
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['position' => 'p_id']);
    }
}
