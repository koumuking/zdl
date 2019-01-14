<?php 
namespace backend\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;
use common\tools\tool;


class FileUpForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;
    public $intro;
    public $price;
//     public $salsid;
//     public $goodsid;
    
    

    public function rules()
    {
        return [
            [['intro', 'price','imageFiles'], 'required'],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],
            ['intro','string','max' => 255,'min'=>6]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'imageFiles' => '衣服图片',
            'intro' => '衣服介绍',
            'price' => '价格',
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
//                 tool::printVar(1,yii::$container);
//                 $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            tool::resizepic($file->tempName);
            }
            return true;
        } else {
            return false;
        }
    }
}