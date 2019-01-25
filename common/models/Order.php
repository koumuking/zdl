<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $openid
 * @property integer $goodsid
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'goodsid'], 'required'],
            [['openid'], 'string'],
            [['goodsid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'openid' => 'Openid',
            'goodsid' => 'Goodsid',
        ];
    }
    
    public function getOrders(){
        $rows = (new \yii\db\Query())
        ->select(['*'])
        ->from('order')
        ->innerJoin('wxuser','order.openid = wxuser.openid')
        ->innerJoin('goods','order.goodsid = goods.id')
        ->all();
        
        return $rows;
    }
}
