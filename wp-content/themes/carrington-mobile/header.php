<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0, user-scalable=0;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="ujianVerification" content="e2bb13684e855a9c8d47dfeeebf46fbe" />
<title>
	<?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	?>
</title>
<meta name="keywords" content="笑话,爆笑一刻,搞笑,幽默笑话"/>
<meta name="description" content="爆笑一刻笑话大全是汇集了全国各地笑话，天天笑料海量更新，让你乐不停"/>
<link rel="stylesheet" type="text/css" media="all" href="http://adam1985.github.io/baoxiaoyike/app/css/style.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<script type="text/javascript" src="http://adam1985.github.io/baoxiaoyike/app/scripts/jquery-2.1.1.min.js" ></script>
<?php if ( is_home() || is_archive() || is_search()) { ?>
<script type="text/javascript">
jQuery(function(){
	$('#main').delegate('.load_more_cont a', 'click', function(e) {
			e.preventDefault();
	        $('.load_more_text a').html('加载中...');
			$.ajax({
				type: "GET",
				url: $(this).attr('href') + '#main',
				dataType: "html",
				success: function(out) {
					result = $(out).find('#content .post_box');
					nextlink = $(out).find('.load_more_cont a').attr('href');
							$("#content").append(result.fadeIn(500));
							$('.load_more_text a').html('查看更多...');
					if (nextlink != undefined) {
						$('.load_more_cont a').attr('href', nextlink);
					} else {
						$('.load_more_cont').remove();
						$('#content').append('<div class="clear"></div>');
					}
				}
			});
	});
});

</script>
<?php } ?>
</head>
<body class="custom-background">
<div id="wrapper">
	<div id="header">
		<h1>
			<a href="<?php echo get_option('home'); ?>/">
				<span class="blog-name"><?php bloginfo('name'); ?></span>
				<span class="blog-title"><?php bloginfo('description'); ?></span>
			</a>
		</h1>
	</div>