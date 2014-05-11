<?php

add_action( 'foundation_enqueue_scripts', 'bauhaus_enqueue_scripts' );

function bauhaus_enqueue_scripts() {
	wp_enqueue_script( 
		'bauhaus-js', 
		BAUHAUS_URL . '/default/bauhaus.js', 
		array( 'jquery' ), 
		BAUHAUS_THEME_VERSION, 
		true 
	);
}

function bauhaus_should_show_thumbnail() {
	$settings = bauhaus_get_settings();

	switch( $settings->bauhaus_use_thumbnails ) {
		case 'none':
			return false;
		case 'index':
			return is_home();
		case 'index_single':
			return is_home() || is_single();
		case 'index_single_page':
			return is_home() || is_single() || is_page();
		case 'all':
			return is_home() || is_single() || is_page() || is_archive() || is_search();
		default:
			// in case we add one at some point
			return false;
	}
}

function bauhaus_should_show_taxonomy() {
	$settings = bauhaus_get_settings();
	
	if ( $settings->bauhaus_show_taxonomy ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_date(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_date ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_author(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_author ) {
		return true;
	} else {
		return false;
	}
}

function bauhaus_should_show_search(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_search ) {
		return true;
	} else {
		return false;
	}	
}

function bauhaus_should_show_comment_bubbles(){
	$settings = bauhaus_get_settings();

	if ( $settings->bauhaus_show_comment_bubbles ) {
		return true;
	} else {
		return false;
	}	
}

 // 定义一个百度分享数据 
class bdShare{  
    var $bdText;  
    var $bdDesc;  
    var $bdUrl;  
    var $bdPic;    
}  
      
 

function setBdText($post){
	$content = mb_strimwidth(strip_tags(apply_filters('the_content', $post -> post_content)), 0, 200,"···");
	$content = trim($content);

	if (strlen($content) < 5){ 
		$content = $post->post_title;
	}

	return $content;
}

function createBdshare($post){
    $bdShare = new bdShare(); 

    $bdShare -> bdText = setBdText($post);
    $bdShare -> bdDesc = $post->post_title;
    $bdShare -> bdUrl = get_permalink();
    $bdShare -> bdPic = post_thumbnail_src();
	echo json_encode( $bdShare ); 
}

