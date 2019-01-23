<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchTemaiHui */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '特卖会';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

/* @var $this yii\web\View */
/* @var array $gly
 * @var array $user
 */
//$this->title = 'My Yii Application';
use yii\helpers\Url;
use common\tools\tool;
use common\models\TemaiHui;


?>

<div class="siteindex">
	<div class="body-content">
	<a href="<?php echo Url::to(['temaihui/create'])?>" class="btn btn-success xinzeng">新增一个活动</a><br>
		<div class="row">
			<div class="col-xs-12 ">
			<?php  foreach ($tmhs as $tmh):?>
			<?php //tool::printVar(1,$tmh);?>
				<div class='temaihui' >
				    <div class =  ><img src=".<?=isset($tmh['goods'][0]['good'][0]['picurl'])?$tmh['goods'][0]['good'][0]['picurl']:''?>" width="100px" height="100px"/></div>
				    <div class = "intro" ><?=$tmh->intro?></div>
				    <div class = "intro" ><?=$tmh->date?></div>
				    <div class = "intro" ><?=$tmh->type==''?'特卖会':TemaiHui::getType($tmh->type)?></div>
				    <a href="./create?id=<?=$tmh['id']?>">修改活动</a>
				</div>
				<?php endforeach;?>
				
			</div>

		</div>

	</div>
</div>

