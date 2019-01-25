<?php 
use yii\helpers\Url;

?>



<div class="siteindex">
	<div class="wtitle">

	</div>
	<div class="alert—check tip">

	</div>
	<div class="body-content">

		<div class="row">
			<div class="col-xs-2 youduiqi">
				<h1><?=date('m',time())?>月</h1>
				<h4><?=date('d',time())?>日</h4>
			</div>
			<div class="col-xs-10">
<a href="<?php echo Url::to(['','queren'=>1,'id'=>yii::$app->request->get('id')]);?>" ><h2>确定删除这件衣服？</h2></a>
			</div>

		</div>

	</div>
</div>



