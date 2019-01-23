<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Wxuser;
use Codeception\Test\Loader;
use common\models\Order;
use common\tools\tool;

/**
 * UserOrder is the model user order form.
 */
class UserOrder extends Model
{
    public $name;
    public $tel;
    public $add;
    public $goodsid;
    public $openid;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//             name, email, subject and body are required
            [['name', 'tel', 'add','goodsid','openid'], 'required'],
//             [['name', 'tel', 'add'], 'safe'],
//             ['tel', 'filter', 'filter' => 'trim'],
//             ['tel','match','pattern'=>'/^[1][34578][0-9]{9}$/'],
//             ['tel', 'unique', 'targetClass' => '\common\models\Wxuser', 'message' => '手机号已被使用'],
        ];
    }
    
    
    

    /**
     * @inheritdoc
     */
    public function save()
    {
        
        $_user = Wxuser::findOne(['openid'=>$this->openid]);
        if(!$_user){
            return false;
        }        
        $_user->name=$this->name;
        $_user->add=$this->add;
        $_user->tel=$this->tel;
        
        $_user->save(false);
        
        $_order = Order::findOne(['openid'=>$this->openid,'goodsid'=>$this->goodsid]);
        if($_order){
            $_order->amount = $_order->amount+1;
            
        }else{
            $_order=new Order();
            $_order->openid = $this->openid;
            $_order->goodsid=$this->goodsid;
            $_order->amount = 1;
        }
        $_order->save(false);

        if($_order && $_user){
            return true;
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
//     public function sendEmail($email)
//     {
//         return Yii::$app->mailer->compose()
//             ->setTo($email)
//             ->setFrom([$this->email => $this->name])
//             ->setSubject($this->subject)
//             ->setTextBody($this->body)
//             ->send();
//     }
}
