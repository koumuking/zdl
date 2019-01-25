<?php

namespace common\models;

use Yii;
use phpDocumentor\Reflection\Types\Null_;

/**
 * This is the model class for table "sals".
 *
 * @property integer $id
 * @property string $intro
 * @property string $date
 * @property integer $status
 */
class TemaiHui extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date','type','main'], 'safe'],
            [['status'], 'integer'],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//             'id' => 'ID',
            'intro' => '活动介绍',
            'date' => '开始日期',
            'status' => '活动状态',
            'type'=>'活动类型',
            'main'=>'公众号显示'
        ];
    }
    
    
    public function getType($num){
        $arr=[1=>'轻奢品',2=>'实惠购'];
        return isset($arr[$num])?$arr[$num]:'';
    }
    
    
    
    
    /*
     * 返回此次ID特卖会全部信息
     * 
     */
    public function getAll($id){
        $this->find();
    }
    
    public function getGoods(){
        return $this->hasMany(Goods::className(), ['salsid'=>'id']);
    }
    
    public function getGood(){
        return $this->hasMany(Good::className(), ['goodsid'=>'id'])->via('goods');
    }
    
    
    static function getQsp(){
        return self::find()->where(['main'=>1,'type'=>1])->orderBy(['id' => SORT_DESC,])->with('goods.good')->all();
    }
    
    static  function getShg(){
        return self::find()->where(['main'=>1,'type'=>2])->orderBy(['id' => SORT_DESC,])->with('goods.good')->all();
    }
}
