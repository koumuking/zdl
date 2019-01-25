<?php

use yii\helpers\Html;
use yii\base\Request;


/* @var $this yii\web\View */
/* @var $model app\models\TemaiHui */

$this->title = '订单状况';
$this->params['breadcrumbs'][] = ['label' => '特卖会', 'url' => ['temaihui/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temai-hui-create">
<table class='ordertable'>
    <tr>
    <td>时间</td>
    <td>姓名</td>
    <td>网名</td>
    <td>衣服</td>
    <td>价格</td>
    <td>地址</td>
    <td>电话</td>
    </tr>
    <?php foreach ($orders as $order):?>
    
    <tr>
    <td><?=$order['time'] ?></td>
    <td><?=$order['name']?></td>
    <td><?=$order['nickname']?></td>
    <td><?=$order['intro']?></td>
    <td><?=$order['price']?></td>
    <td><?=$order['add']?></td>
    <td><?=$order['tel']?></td>
    </tr>
    
    

    <?php endforeach;?>
    </table>
</div>
