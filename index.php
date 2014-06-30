<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
ob_start(); 
 
//判断是否移动端

function isMobile(){

   $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

   $iphone = (strpos($agent, 'iphone')) ? true : false;

   $ipad = (strpos($agent, 'ipad')) ? true : false;

   $android = (strpos($agent, 'android')) ? true : false;

   $is_mobile_dev = $android || $iphone || $ipad;   

   if($is_mobile_dev){

        return true;

    }else{

        return false;

    }

}

$the_host = $_SERVER['HTTP_HOST'];
$url = $_SERVER['REQUEST_URI'];
//echo $the_host;




if ( isMobile() ){
	if(  $the_host != 'm.baoxiaoyike.cn' ) {
		//Header("HTTP/1.1 301 Moved Permanently");
		//Header("Location: http://m.baoxiaoyike.cn". $url );
		echo "<script>";
		$path = 'http://m.baoxiaoyike.cn'.$url;
		echo "window.location.href = '$path'"; 
		echo "</script>"; 
		
	}
	//Header("HTTP/1.1 301 Moved Permanently");
	//Header("Location: http://m.baoxiaoyike.cn". $url );
	//exit(); 
	//$path = 'http://m.baoxiaoyike.cn'.$url;
	//echo "window.location.href = '$path'"; 
	//exit;
} else {
	if(  $the_host != 'www.baoxiaoyike.cn' ) {
		//Header("HTTP/1.1 301 Moved Permanently");
		//Header("Location: http://www.baoxiaoyike.cn". $url );
		echo "<script>";
		$path = 'http://www.baoxiaoyike.cn'.$url;
		echo "window.location.href = '$path'"; 
		echo "</script>"; 
		
	}
	//Header("HTTP/1.1 301 Moved Permanently");
	//Header("Location: http://www.baoxiaoyike.cn" . $url);
	//exit();
	//$path = 'http://www.baoxiaoyike.cn'.$url;
	//echo "window.location.href = '$path'"; 
	//exit;
}


ob_end_flush();


define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
