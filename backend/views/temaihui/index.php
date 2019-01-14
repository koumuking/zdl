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


?>

<div class="siteindex">
	<div class="body-content">
	<a href="<?php echo Url::to(['temaihui/create'])?>" class="btn btn-success xinzeng">新增一个活动</a><br>
		<div class="row">
			<div class="col-xs-12 ">
			
				<div class='temaihui' >
				    <div class = "pic" ></div>
				    <div class = "intro" >2019-1-21</div>
				</div>
				<div class='temaihui' >
				    <div class = "pic" ></div>
				    <div class = "intro" >2019-1-21</div>
				</div>
				<div class='temaihui' >
				    <div class = "pic" ></div>
				    <div class = "intro" >2019-1-21</div>
				</div>
				<div class='temaihui' >
				    <div class = "pic" ></div>
				    <div class = "intro" >2019-1-21</div>
				</div>
				<div class='temaihui' >
				    <div class = "pic" ></div>
				    <div class = "intro" >2019-1-21</div>
				</div>
				<div class='temaihui' >
				    <div class = "pic" ></div>
				    <div class = "intro" >2019-1-21</div>
				</div>
				<div class='temaihui' >
				    <div class = "pic" ></div>
				    <div class = "intro" >2019-1-21</div>
				</div>
			</div>

		</div>

	</div>
</div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">先确认你的信息</h4>
      </div>
      <div class="modal-body">
        <form>
  <div class="form-group">
    <label for="exampleInputEmail1">姓名</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="姓名">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">电话</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="电话">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">收货地址</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="收货地址">
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" data-pic='fukuanma.jpg'>下一步</button>
      </div>
    </div>
  </div>
</div>




