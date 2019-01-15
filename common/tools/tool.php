<?php
namespace common\tools;


use yii;


class tool
{
    static function printVar($exit=FALSE , $val){
        echo '<pre>';
        var_dump($val);
        echo '</pre>';
        
        if($exit){
            exit();
        }
    }
    
    static function http_curl($url,$post=FALSE){
        
        if($post){
            //初始化
            $curl = curl_init();
            //设置抓取的url
            curl_setopt($curl, CURLOPT_URL, $url);
            //设置头文件的信息作为数据流输出
            curl_setopt($curl, CURLOPT_HEADER, 1);
            //设置获取的信息以文件流的形式返回，而不是直接输出。
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
            //设置post方式提交
            curl_setopt($curl, CURLOPT_POST, 1);
            //设置post数据
            $post_data = $post;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
            //执行命令
            $data = curl_exec($curl);
            //关闭URL请求
            curl_close($curl);
            //显示获得的数据
            return ($data);
        }else{
            //1.初始化curl
            $ch = curl_init();
            //2.设置curl的参数
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER,false); //是否显示头部
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //https请求 不验证证书 其实只用这个就可以了
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //https请求 不验证HOST
            curl_setopt($ch,CURLOPT_POST,true);
            //3.采集
            $output = curl_exec($ch);
            //4.关闭
            curl_close($ch);
            return ($output);
        }
        
    }
    
    
    
    function xmlCurlPost($xmlData, $url, $timeoutMs=30000)
    {
        $ch = curl_init();
        $header[] = "Content-type: text/xml";//定义content-type为xml
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);    //注意，毫秒超时一定要设置这个
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeoutMs);  //超时毫秒，cURL 7.16.2中被加入。从PHP 5.2.3起可使用
        $sContent = curl_exec($ch);
        $aStatus = curl_getinfo($ch);
        curl_close($ch);
        if(intval($aStatus["http_code"])==200){
            return trim($sContent);
        }else{
            return false;
        }
    }
    
    
    
    
    
    /**
     * 把内容写入文件
     * @param unknown $text
     */
    static function  logit($text){
        ob_start();
		var_dump($text);
		echo date('Y-m-d G:i:s A');
		$str=ob_get_clean();
		file_put_contents('../models/log.txt',$str.PHP_EOL,FILE_APPEND);
    }
    
    
    /**
     * 数组转为微信接口对应的xml数据
     *
     * @param
     * $arr
     * @return string
     */
    static  function arr2XML($arr)
    {
        $ret_str = "";
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $arr_v = self::json2XML($v);
                if (! is_integer($k)) {
                    $ret_str = $ret_str . sprintf("<%s>%s</%s>", $k, $arr_v, $k);
                } else {
                    $ret_str = $ret_str . $arr_v;
                }
            } else {
                if (is_integer($v)) {
                    $ret_str = $ret_str . sprintf("<%s>%s</%s>", $k, $v, $k);
                } else {
                    $ret_str = $ret_str . sprintf("<%s><![CDATA[%s]]></%s>", $k, $v, $k);
                }
            }
        }
        return $ret_str;
    }
    
    /**
     * 微信头像大小
     * 最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像）
     *
     * @param
     * $arr
     * @return string
     */
    static  function headimagSize($str,$num){
        if((int)$num !== 0 && (int)$num !== 46 && (int)$num !== 64 && (int)$num !== 96 && (int)$num !== 132){
            return  $str;
        }else{
            $pattern = '/\/\d{2,3}$/i';
            $replacement = '/'.$num;
            return preg_replace($pattern, $replacement, $str);
        }
        
    }
    
    
    /*
     * pic文件缩放
     * 
     */
    static function resizepic($file){
        // This is the temporary file created by PHP
       
//         $uploadedfile = $_FILES['uploadfile']['tmp_name'];
        
        // Create an Image from it so we can do the resize
        
        $src = imagecreatefromjpeg($file);
        
        // Capture the original size of the uploaded image
        
        list($width,$height)=getimagesize($file);
        
        // For our purposes, I have resized the image to be
        
        // 600 pixels wide, and maintain the original aspect
        
        // ratio. This prevents the image from being "stretched"
        
        // or "squashed". If you prefer some max width other than
        
        // 600, simply change the $newwidth variable
        
        $newwidth=750;
        
        if($width>$newwidth){
            $newheight=($height/$width)*750;
        }else{
            $newheight=$height;
        }

        $tmp=imagecreatetruecolor($newwidth,$newheight);
        
        // this line actually does the image resizing, copying from the original
        
        // image into the $tmp image
        
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
        
        // now write the resized image to disk. I have assumed that you want the
        
        // resized, uploaded image file to reside in the ./images subdirectory.
        
//         $filename = "images/". $_FILES['uploadfile']['name'];
        $dir = './uploads/'.date('Y-m-d');
        if (!is_dir($dir)){
            mkdir ($dir,0777);
        }
        $filename = $dir.'/'.time().yii::$app->security->generateRandomString(5).'.jpg';
        
        imagejpeg($tmp,$filename,90);
        
        imagedestroy($src);
        
        imagedestroy($tmp);
        
        
        // NOTE: PHP will clean up the temp file it created when the request
        
        // has completed.
        
        return $filename;
    }
    
}

?>