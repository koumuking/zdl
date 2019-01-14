<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "good".
 *
 * @property integer $id
 * @property string $picurl
 * @property integer $goodsid
 */
class Good extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'good';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsid'], 'integer'],
            [['picurl'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picurl' => 'Picurl',
            'goodsid' => 'Goodsid',
        ];
    }
}
