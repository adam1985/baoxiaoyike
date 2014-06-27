<?php 

do_action( 'wptouch_functions_start' ); 

add_filter( 'wp_title', 'foundation_set_title' );

function foundation_set_title( $title ) {
	return $title . ' ' . wptouch_get_bloginfo( 'site_title' );
}

//判断是否app内置浏览器

function isInnerView(){ 

    $agent = strtolower($_SERVER['HTTP_USER_AGENT']); 

    if(preg_match("/micromessenger|QQ|weibo|TXMicroblog/i", $agent)){

        return true;

    }else{

        return false;

    }

}

//判断是否移动端

function isMobile(){

   $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

   $iphone = (strpos($agent, 'iphone')) ? true : false;

   $ipad = (strpos($agent, 'ipad')) ? true : false;

   $android = (strpos($agent, 'android')) ? true : false;

   $is_mobile_dev=$android || $iphone || $ipad;   

   if($is_mobile_dev){

        return true;

    }else{

        return false;

    }

}


function isAppView(){
	$isInnerView = isInnerView();
	$isMobile = isMobile();
	if($isInnerView && $isMobile){
		return true;
	} else {
		return false;
	}

}