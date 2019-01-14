<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TemaiHui */

$this->title = '新增活动';
$this->params['breadcrumbs'][] = ['label' => '特卖会', 'url' => ['temaihui/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temai-hui-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
