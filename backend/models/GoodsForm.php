<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class GoodsForm extends Model
{
    public $intro;
    public $price;
    public $picid; //
    public $salsid;//特卖会id
    
    public $pic = '';//上传的图片

//     private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['intro', 'price'], 'required'],
            // rememberMe must be a boolean value
//             ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
//             ['password', 'validatePassword'],
        ];
    }

    /**
     * 上传数据.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function update()
    {
        $good = new Good();
        $googs = new Goods();
        $goods->intro = $this->intro;
        $goods->price = $this->price;
        $googs->save();
        
//         $good->
        
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

 }
