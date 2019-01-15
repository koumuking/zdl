<?php 
namespace backend\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;
use common\tools\tool;
use common\models\Goods;
use common\models\Good;
use yii\validators\ImageValidator;


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
            [['intro', 'price'], 'required'],
//             [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 7],
            ['intro','string','max' => 255,'min'=>3],
            [['imageFiles'],'anyselect', 'skipOnEmpty' => false],
            ['price','integer']
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
    
    public function anyselect($attribute,$params){
        
        $IValidator = new ImageValidator();
        $IValidator->extensions=(['jpg']);
        $ok = false;
        $count=0;
//         tool::printVar(1,$this->imageFiles);
        foreach ($this->imageFiles as $image){
            
            if($image){
                
                if($IValidator->validate($image)){
                    $this->addError($attribute, "请选择Jpg图片"); 
                    return false;
                }else{
                    $ok = true;
                }
            }
            $count++;
            if($count==5 && !$ok){
                $this->addError($attribute, "至少选择一张图片");
            }
        }
        
//         tool::printVar(1,$ok);
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $goods = new Goods();
            $goods-> intro = $this->intro;
            $goods->price = $this->price;
            $goods->salsid = \yii::$app->request->get('id');
            $goods->save(false);
            
            $goodsid = yii::$app->db->getLastInsertID();
            
            
            foreach ($this->imageFiles as $file) {
//                 tool::printVar(1,yii::$container);
//                 $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            $good = new Good();
            $good->picurl = tool::resizepic($file->tempName);
            $good->goodsid=$goodsid;
            $good->save(false);
            }
            return true;
        } else {
//             tool::printVar(1,$this->getErrors());
            return false;
        }
    }
}