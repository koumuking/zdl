<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $intro
 * @property integer $price
 * @property integer $picid
 * @property integer $salsid
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'picid', 'salsid'], 'integer'],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'intro' => 'Intro',
            'price' => 'Price',
            'picid' => 'Picid',
            'salsid' => 'Salsid',
        ];
    }
}
