<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\tools\tool;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
	<h1><?= Html::encode($this->title) ?></h1>

	<p>This is the About page. You may modify the following file to
		customize its content:</p>

	<code><?= __FILE__ ?></code>
</div>



<form>
	<div class="form-group">
		<label for="InputName">姓名*</label> <input type="text"
			class="form-control" id="InputName" placeholder="姓名">
		<div class="nametip tipred"></div>
	</div>
	<div class="form-group">
		<label for="InputTel">电话*</label> <input type="text"
			class="form-control" id="InputTel" placeholder="电话">
		<div class="teltip tipred"></div>
	</div>
	<div class="form-group">
		<label for="InputAdd">收货地址*</label> <input type="text"
			class="form-control" id="InputAdd" placeholder="收货地址">
		<div class="addtip tipred"></div>
	</div>
                      <?php Html::csrfMetaTags()?>                       注：星号为必填<br>
	<button type="button" class="ajaxbtn btn btn-primary">确定</button>
</form>




<?php 
// tool::printVar(FALSE,$tmh);
// tool::printVar(FALSE,$tmh[0]);

// foreach ($tmh[0]['goods'] as $arr){
//     echo '<ul>';
//     foreach ($arr['good'] as $pic)    
//         echo '<li>';
//             tool::printVar(FALSE,$pic['picurl']);
//         echo '</li>';
//     echo '</ul>';
// }
?>

