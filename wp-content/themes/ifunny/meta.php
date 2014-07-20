<?php 

	if( is_category() ){
	    $cat_count_id = get_query_var('cat');
	    $thisCat = get_category($cat_count_id,false);
	    $wpTitle = $thisCat->name . ',';
	}

	if( is_single() ) {
		$wpTitle = get_post() -> post_title . ',';
	}

?>
<title>

	<?php 
		if( is_single() ) {  
			echo wp_title( '|', true, 'right' ) . "爆笑一刻,每天一点料,生活更精彩"; 
		} else if( is_archive() ){
			echo wp_title( '|', true, 'right' ) . "爆笑一刻,每天一点料,生活更精彩"; 
		} else {
			echo "爆笑一刻,笑话大全,笑话精选,笑话排行榜,笑话故事,冷笑话,短笑话,十万个冷笑话,每天一点料,生活更精彩";
		}
	?>
</title>
<meta name="keywords" content="爆笑一刻,笑话大全,笑话精选,笑话排行榜,笑话故事,冷笑话,短笑话,搞笑图片"/>
<?php if( is_single() ) {  ?>
<meta name="description" content="<?php echo setBdText($post); ?>"/>
<?php } else { ?>
<meta name="description" content="爆笑一刻笑话网,与千万网友一起分享最新最热的爆笑笑话、冷笑话、短笑话、冷话故事、内涵笑话、幽默笑话、搞笑图片、糗事笑话、成人笑话、经典笑话、内涵段子等笑话大全,天天笑料海量更新，让你乐不停!"/>
<?php } ?>