<?php

namespace common\models;

use Yii;

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
            [['date'], 'safe'],
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
        ];
    }
}