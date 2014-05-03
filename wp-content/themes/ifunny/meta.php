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
<title><?php echo $wpTitle; ?> <?php bloginfo('name') ?>, <?php bloginfo('description'); ?></title>
<meta name="renderer" content="webkit">
<meta name="keywords" content="笑话,爆笑一刻,搞笑,幽默笑话"/>
<meta name="description" content="爆笑一刻笑话大全是汇集了全国各地笑话，天天笑料海量更新，让你乐不停"/>