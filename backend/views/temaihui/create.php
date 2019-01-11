<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TemaiHui */

$this->title = 'Create Temai Hui';
$this->params['breadcrumbs'][] = ['label' => 'Temai Huis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temai-hui-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
