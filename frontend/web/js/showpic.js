/**
 * 
 */


//$(".picdetail").hide();



wx.config({
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: 'wx4c26c4a02cb4c4d2', // 必填，公众号的唯一标识
    timestamp: , // 必填，生成签名的时间戳
    nonceStr: '', // 必填，生成签名的随机串
    signature: '',// 必填，签名
    jsApiList: [] // 必填，需要使用的JS接口列表
});



var img = new Image();
 img.src = "./pic/fukuanma.jpg";
 img.onload = function () {
//    alert("image is loaded");
 };

 var goodsid;
 
 $('.ajaxbtn').click(function(){
	 var err =false;
	 if($('#InputName').val() == ''){
		 err =true;
		 $('.nametip').html('姓名为必填项');
	 }else{
		 $('.nametip').html('');
	 }
	 
	 if(!$('#InputTel').val().match(/^1[345678]\d{9}$/)){
		 err =true;
		 $('.teltip').html('请输入电话号码');
	 }else{
		 $('.teltip').html('');
	 }
	 
	 if($('#InputAdd').val() == ''){
		 err =true;
		 $('.addtip').html('地址为必填项');
	 }else{
		 $('.addtip').html('');
	 }
	 if(err){
		 return;
	 }
	 var Fdata={
			 'UserOrder':{
				 'name':$('#InputName').val(),
				 'tel':$('#InputTel').val(),
				 'add':$('#InputAdd').val(),
				 'openid':$('.modal-body').attr('data'),
				 'goodsid':goodsid,
			 },
			 '_csrf-frontend':$('meta[name="csrf-token"]').attr("content"),
	 };
	 $('.modal-body').hide();
	 $('.modal-tip').show();
	 $('.modal-tip').html('<h5>正在处理，请稍候~~</h5>');
//	 alert(goodsid);
	 $.ajax({
		 url:"site/ajaxpost",
		 type:'post',
		 data:Fdata,
		 datatype:"json",
//		 contentType: "application/json;utf-8",
		 
		 success:function(data,status){
			 $('.modal-title').html('您已经成功预订~！！');
			 $('.modal-tip').html('点击<下一步>进行付款，此件衣服很快到你身边~~');
//			 alert(data);
			 $('.next-btn').show();
		 },
		 
		 complete:function(XMLHttpRequest,textStatus){  
             if(textStatus=='timeout'){  
	                 var xmlhttp = window.XMLHttpRequest ? new window.XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHttp");  
	                 xmlhttp.abort();   
	                 alert("网络超时！请重试一下~");  
	     　　　　}  
//	             alert("点击获取数据");   
	         }, 
	 	
	 error:function(XMLHttpRequest, textStatus){  
		             console.log(XMLHttpRequest);  //XMLHttpRequest.responseText    XMLHttpRequest.status   XMLHttpRequest.readyState  
		             console.log(textStatus);  
		             alert("服务器错误！");  
		         }  
	 });
 });
 
 $('.next-btn').click(function(){
	 $('.next-btn').hide();
	 $('.modal-tip').hide();
	 $('.modal-body').show();
	 $('.modal-title').html('先确认你的信息');
 });
 
$('.yifuinfo button').click(function(){
	goodsid = $(this).attr('goodsid');
});

$('.yifu,.btn-success').click(function (){
	$('body').prepend('<div class="piczhezhao"></div>');
	$('body').prepend('<div class="picdetail"></div>');
	$(".picdetail").css('left',$(this).offset().left);
	$(".picdetail").css('top',$(this).offset().top);
	
	var image = new Image();
	if($(this).attr('data-pic') == 'fukuanma.jpg'){
		image = img;
	}else{
		image.src=$(this).attr('src');
	}
	
	
//	alert($(document.body).height()+' 窗口尺度');
//	alert(image.naturalWidth+';图片尺寸');

	image.onload=(function(img){
		
		
		var bili = image.naturalWidth/image.naturalHeight;
		var fleft;
		var ftop;
		
		if(image.naturalWidth >= $(window).width()){
			image.width = $(window).width();
			image.height = image.width/bili;
			fleft = 0;
			
			
		}else{
			fleft = ( $(window).width() - image.naturalWidth )/2;
//			console.log(left);
//			$(".picdetail").css('left',fleft+'px');
			
		}
		
//		alert(image.naturalWidth);
		console.log(image.height+'图片压缩后的高'+$(window).height()+'窗口可视区域的高');
		
		if(image.height >= $(window).height()){
//			$(".picdetail").css({'top':'0'});
			ftop = 0;
		}else{
			ftop = ($(window).height() - image.height)/2;
//			$(".picdetail").css({'top':top+'px'});
		}
//		console.log($(".picdetail"));

		
		
//		$(".picdetail").css('left',$(img).offset().left);
//		$(".picdetail").css('top',$(img).offset().top);
		$(".picdetail").show();
//		alert($(this).offset().left);
		$(".picdetail").animate({
		    left : fleft,
		    top : ftop,
		    opacity:'1',
		    height:image.height,
		    width:image.width,
		  }).append(image);
		
		$(".piczhezhao").animate({
		    opacity:'0.8',
		  })
		
//		alert(image.width);
		
		$(".picdetail").click(function(){
			$(this).remove();
			$('.piczhezhao').remove();
		});
		
		$('.piczhezhao').click(function(){
			$(this).remove();
			$('.picdetail').remove();
		});
	})(this)
	
	
});

