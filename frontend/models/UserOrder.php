<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class UserOrder extends Model
{
    public $name;
    public $tel;
    public $add;
    public $goodsid;
    public $userid;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'tel', 'add'], 'required'],
            ['tel', 'required'],
            ['tel', 'filter', 'filter' => 'trim'],
            ['tel','match','pattern'=>'/^[1][34578][0-9]{9}$/'],
            ['tel', 'unique', 'targetClass' => '\common\models\User', 'message' => '手机号已被使用'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
