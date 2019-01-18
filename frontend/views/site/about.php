<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\tools\tool;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>


<?php 
// tool::printVar(FALSE,$tmh);
// tool::printVar(FALSE,$tmh[0]);

foreach ($tmh[0]['goods'] as $arr){
    echo '<ul>';
    foreach ($arr['good'] as $pic)    
        echo '<li>';
            tool::printVar(FALSE,$pic['picurl']);
        echo '</li>';
    echo '</ul>';
}
?>

