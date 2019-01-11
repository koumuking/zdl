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
	<div class="wtitle">

		<img class='touxiang' alt=""
			src="<?php echo tool::headimagSize($gly['headimgurl'],46) //Yii::getAlias('@web/pic/touxiang.jpg')?>"> <span
			class='touxiangtitle'><?php echo $gly['nickname']?></span>
	</div>
	<div class="tip">
       <img class='khtouxiang' alt=""
			src="<?php echo tool::headimagSize($user['headimgurl'], 46) //Yii::getAlias('@web/pic/touxiang.jpg')?>">
			<span class='hykh'><?php  
			if($user['openid'] !== $gly['openid']){
			    echo  ('嗨~~ '.$user['nickname'].': 希望你在这能挑到心仪的货哦！');
			}else{
// 			    $glyUrl = Url::to(['@web/sals']);
			    echo ('嗨~~ '.$gly['nickname'].': 多上传些货哦！大家都等着呢~~<a href="http://zdldc.com/zdl/backend/web/index.php?r=weixin">点击此处上传商品</a>');
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

				<img class='yifu' data-pic="yifu1.jpg" alt="" src="<?php echo Yii::getAlias('@web/pic/yifu1.jpg')?>">
				
				
				
					
					 <img
					class='yifu' data-pic="yifu2.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu2.jpg')?>">
					
			
					 <img
					class='yifu' data-pic="yifu3.jpg"  alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu3.jpg')?>">
				
				
					<img
					class='yifu' data-pic="yifu4.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu4.jpg')?>">
					
					
					
				<div class='yifuinfo'>
					<p>音儿品牌，秋季女装，货号124582，颜色：黑色</p>
					<p>价格：1折，220</p>
					<!--这是一段注释。注释不会在浏览器中显示。<p class="btn btn-success" onclick="window.location.href='<?php //echo Url::to(['site/pay', 'id' => 100]);?>'" > -->
<!-- 					<p class="btn btn-success" data-pic='fukuanma.jpg'>	 -->
<!-- 						我要这件 <span class='glyphicon glyphicon-arrow-up'></span> -->
<!-- 					</p> -->
					<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">我要这件 <span class='glyphicon glyphicon-arrow-up'></span></button>
				</div>
				<img class='yifu' data-pic="yifu5.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu5.jpg')?>"> <img
					class='yifu' data-pic="yifu6.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu6.jpg')?>">
				<div class='yifuinfo'>
					<p>音儿品牌，秋季女装，货号124582，颜色：黑色</p>
					<p>价格：1折，220</p>
					<p class="btn btn-success" data-pic='fukuanma.jpg'>	
						我要这件 <span class='glyphicon glyphicon-arrow-up'></span>
					</p>
				</div>
				<img class='yifu' data-pic="yifu7.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu7.jpg')?>"> <img
					class='yifu' data-pic="yifu8.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu8.jpg')?>"> <img
					class='yifu' data-pic="yifu9.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu9.jpg')?>"> <img
					class='yifu' data-pic="yifu10.jpg" alt=""
					src="<?php echo Yii::getAlias('@web/pic/yifu10.jpg')?>">
				<div class='yifuinfo'>
					<p>音儿品牌，秋季女装，货号124582，颜色：黑色</p>
					<p>价格：1折，220</p>
					<p class="btn btn-success" data-pic='fukuanma.jpg'>	
						我要这件 <span class='glyphicon glyphicon-arrow-up'></span>
					</p>
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



