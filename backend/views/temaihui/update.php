<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TemaiHui */

$this->title = 'Update Temai Hui: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Temai Huis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temai-hui-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
