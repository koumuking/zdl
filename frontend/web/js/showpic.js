/**
 * 
 */


//$(".picdetail").hide();

var img = new Image();
 img.src = "./pic/fukuanma.jpg";
 img.onload = function () {
//    alert("image is loaded");
 };

 
 
 $('.ajaxbtn').click(function(){
	 $.ajax({
		 url:"http://zdldc.com/zdl/frontend/web/index.php?r=site/ajaxpost",
		 type:'post',
		 data:{code:123},
		 success:function(data,status){
			 alert(data+status);
		 }
	 });
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

