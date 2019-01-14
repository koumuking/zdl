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

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],
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