<?php

/* @var $this yii\web\View */
/* @var array $gly
 * @var array $user
 */
//$this->title = 'My Yii Application';
use yii\helpers\Url;
use common\tools\tool;
use common\models\Goods;
use yii\helpers\Html;



?>

<div class="siteindex">
	<div class="wtitle">

		<img class='touxiang' alt=""
			src="<?php echo tool::headimagSize($gly['headimgurl'],46) //Yii::getAlias('@web/pic/touxiang.jpg')?>"> <span
			class='touxiangtitle'><?php echo $gly['nickname']?></span>
	</div>
	<div class="alert—check tip">
       <img class='khtouxiang' alt=""
			src="<?php echo tool::headimagSize($user['headimgurl'], 46) //Yii::getAlias('@web/pic/touxiang.jpg')?>">
			<span class='hykh'><?php  
			if($user['openid'] != $gly['openid']){
			    echo  ('嗨~~ '.$user['nickname'].':<br> 希望你在这能挑到心仪的货哦！');
			}else{
// 			    $glyUrl = Url::to(['@web/sals']);
			    echo ('嗨~~ '.$gly['nickname'].': 多上传些货哦！大家都等着呢~~<h3><a class="btn btn-info" href="http://zdldc.com/zdl/backend/web/index.php?r=temaihui">点击此处上传商品</a></h3>');
    } 
			?> </span>
	</div>
	<div class="body-content">

		<div class="row">
			<div class="col-xs-2 youduiqi">
				<h1>1月</h1>
				<h4>15日</h4>
			</div>
			<div class="col-xs-10">
			
			<?php if($tmh[0]):?>

				    <?php foreach ($tmh[0]['goods'] as $goods):?>
				    
    				    <?php foreach ($goods['good'] as $good):?>
    				    <img class='yifu' data-pic="yifu1.jpg" alt="" src="<?php echo '../../backend/web/'.$good['picurl'] //Yii::getAlias('@web/pic/yifu1.jpg')?>">
                        <?php endforeach;?>
					
				<div class='yifuinfo'>
					<p><?=$goods['intro'] ?></p>
					<p><?=$goods['price'] ?></p>
					<!--这是一段注释。注释不会在浏览器中显示。<p class="btn btn-success" onclick="window.location.href='<?php //echo Url::to(['site/pay', 'id' => 100]);?>'" > -->
<!-- 					<p class="btn btn-success" data-pic='fukuanma.jpg'>	 -->
<!-- 						我要这件 <span class='glyphicon glyphicon-arrow-up'></span> -->
<!-- 					</p> -->
					<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">我要这件 <span class='glyphicon glyphicon-arrow-up'></span></button>
				</div>
				
				<?php endforeach;?>
            <?php else :?>
            
            <h1>暂无活动</h1>
            
            <?php endif;?>
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
  <?=Html::csrfMetaTags()?>
  <button type="button" class="ajaxbtn btn btn-primary" >确定</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="next-but btn btn-success" data-dismiss="modal" data-pic='fukuanma.jpg'>下一步</button>
      </div>
    </div>
  </div>
</div>



