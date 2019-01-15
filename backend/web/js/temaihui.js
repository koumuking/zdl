/**
 * 
 */
$(".upyifu input[type='file']").change(function(){
	 var reader = new FileReader();
	 var newUrl;
	 var div = $(this).parent().parent();
     reader.readAsDataURL(this.files[0]);                    
     reader.onload = function(d) {
         // 图片base64化
    	 newUrl = this.result;
    	 div.css({"background-image":"url("+newUrl+")","background-size":"155px"});
     };
	 
	console.log(newUrl);
});