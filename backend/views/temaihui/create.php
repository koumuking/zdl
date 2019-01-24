<?php

use yii\helpers\Html;
use yii\base\Request;


/* @var $this yii\web\View */
/* @var $model app\models\TemaiHui */
 if((yii::$app->request->get('id') == null)){
    $tit='新增活动';
}else {
    $tit='修改活动';
}
$this->title = $tit;
$this->params['breadcrumbs'][] = ['label' => '特卖会', 'url' => ['temaihui/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temai-hui-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
