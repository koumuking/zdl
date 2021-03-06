<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use backend\assets\temaihuiAsset;
use yii\helpers\BaseHtml;

?>

<?php 
temaihuiAsset::register($this);

?>
<?php 
// if(isset($updatedYii::$app->request->get('updated'))){
// echo '<div class="alert—check">再上传一件衣服</div>';
// }
?>
<div class="bg-info">再上传一件衣服</div>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model,'intro')->textarea(['row'=>5]) ?>
    
    <?= $form->field($model,'price',['template'=>'{label}<div class="input-group">{input}<div class="input-group-addon"><strong>￥</strong></div></div>{hint}{error}'])->textInput() ?>

    
    <div class='upyifu'>
    <?= $form->field($model, 'imageFiles[0]')->fileInput([ 'accept' => 'image/*' ])->label(null,['class'=>'btn btn-primary']) ?>
    </div>
    <div class='upyifu'>
    <?= $form->field($model, 'imageFiles[1]')->fileInput([ 'accept' => 'image/*'])->label(null,['class'=>'btn btn-primary']) ?>
    </div>
    <div class='upyifu'>
    <?= $form->field($model, 'imageFiles[2]')->fileInput(['accept' => 'image/*'])->label(null,['class'=>'btn btn-primary']) ?>
    </div>
    <div class='upyifu'>
    <?= $form->field($model, 'imageFiles[3]')->fileInput(['accept' => 'image/*'])->label(null,['class'=>'btn btn-primary']) ?>
    </div>
    <div class='upyifu'>
    <?= $form->field($model, 'imageFiles[4]')->fileInput(['accept' => 'image/*'])->label(null,['class'=>'btn btn-primary']) ?>
    </div>
    <div class='upyifu'>
    <?= $form->field($model, 'imageFiles[5]')->fileInput(['accept' => 'image/*'])->label(null,['class'=>'btn btn-primary']) ?>
    </div>

    <?=Html::submitButton('上传此件衣服',['class'=>'btn btn-success']); //Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>