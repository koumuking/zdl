<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\tools\tool;

/* @var $this yii\web\View */
/* @var $model app\models\TemaiHui */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temai-hui-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'intro')->textarea(['maxlength' => true,'rows'=>5]) ?>
    
    
    <?= $form->field($model, 'type')->radioList([1=>'轻奢品',2=>'实惠购']) ?>
    
    
    <?= $form->
    field($model, 'date',['template'=>'{label}<div class="input-group">{input}<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>{hint}{error}'])->
    textInput(['value' => date('Y.m.d'),'id'=>'datetimepicker'])
    ?>
    
    
    
    <?php ?>

    

    <div class="form-group">
        <?=Html::submitButton('下一步',['class'=>'btn btn-success']); //Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
