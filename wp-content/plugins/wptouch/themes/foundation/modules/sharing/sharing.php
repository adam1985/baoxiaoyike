<?php

add_action( 'foundation_module_init_mobile', 'foundation_sharing_init' );
add_action( 'wptouch_admin_page_render_wptouch-admin-theme-settings', 'foundation_sharing_settings' );

function foundation_sharing_init() {
	$settings = foundation_get_settings();

	add_filter( 'the_content', 'foundation_handle_share_links_bottom' );
}

function foundation_sharing_classes() {
	$share_classes = array( 'sharing-options', 'clearfix' );

	$settings = foundation_get_settings();

	$locale = wptouch_get_locale();
	if ( in_array( $locale, array( 'es', 'el', 'pt', 'id_ID', 'ru_RU', 'ar' ) ) ) {
		$share_classes[] = 'long';
	}


	if ( $settings->share_location == 'top' ) {
		$share_classes[] = 'share-top';
	} else {
		$share_classes[] = 'share-bottom';
	}

	$share_classes[] = 'style-' . $settings->share_colour_scheme;

	echo implode( ' ', apply_filters( 'foundation_share_classes', $share_classes ) );
}

function foundation_sharing_content() {
	$settings = foundation_get_settings();

	$content = '';
	if ( $settings->share_on_pages == true ) {
		$is_page = is_page();
	} else {
		$is_page = '';
	}

	if ( $settings->show_share && ( is_single() || $is_page ) ) {
		$content = wptouch_capture_include_file( dirname( __FILE__ ) . '/sharing-html.php' );
	}

	return $content;
}

function foundation_handle_share_links( $content, $top_share = false ) {
	$share_links = foundation_sharing_content();

	if ( !is_feed() && !is_home() && $top_share ) {
		return $share_links . $content;
	} elseif ( !is_feed() && !is_home() ) {
		return $content . $share_links;
	} else {
		return $content;
	}
}

function foundation_handle_share_links_top( $content ) {
	return foundation_handle_share_links( $content, true );
}

function foundation_handle_share_links_bottom( $content ) {
	return foundation_handle_share_links( $content, false );
}

function foundation_sharing_settings( $page_options ) {
	wptouch_add_page_section(
		FOUNDATION_PAGE_BRANDING,
		__( 'Sharing', 'wptouch-pro' ),
		'social-sharing',
		array(
			wptouch_add_setting(
				'checkbox',
				'show_share',
				__( 'Show sharing links', 'wptouch-pro' ),
				__( 'Will show Facebook, Twitter, Google+ and Email buttons on single posts.', 'wptouch-pro' ),
				WPTOUCH_SETTING_BASIC,
				'1.0'
			),
			wptouch_add_setting(
				'checkbox',
				'share_on_pages',
				__( 'Show sharing links on pages', 'wptouch-pro' ),
				__( 'Will show Facebook, Twitter, Google+ and Email buttons on pages as well as single posts.', 'wptouch-pro' ),
				WPTOUCH_SETTING_ADVANCED,
				'2.0'
			),
			wptouch_add_setting(
				'radiolist',
				'share_location',
				__( 'Sharing links location', 'wptouch-pro' ),
				'',
				WPTOUCH_SETTING_ADVANCED,
				'1.0',
				array(
					'top' => __( 'Above post content', 'wptouch-pro' ),
					'bottom' => __( 'Below post content', 'wptouch-pro' )
				)
			),
			wptouch_add_setting(
				'radiolist',
				'share_colour_scheme',
				__( 'Color scheme', 'wptouch-pro' ),
				'',
				WPTOUCH_SETTING_BASIC,
				'1.0',
				array(
					'default' => __( 'Theme colors', 'wptouch-pro' ),
					'vibrant' => __( 'Social network colors', 'wptouch-pro' )
				)
			)
		),
		$page_options,
		FOUNDATION_SETTING_DOMAIN
	);

	return $page_options;
}


function get_share_pic(){
    global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches[1][0];   //获取该图片 src
		if(empty($post_thumbnail_src)){	//如果日志中没有图片，则显示随机图片
			//$random = mt_rand(1, 10);
			//echo get_bloginfo('template_url');
			//echo '/images/pic/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//echo '/images/default_thumb.jpg';
			return "";
		}
	};
	return $post_thumbnail_src;
}

function setSharetext($post){
	$content = mb_strimwidth(strip_tags(apply_filters('the_content', $post -> post_content)), 0, 200,"···");
	$content = trim($content);

	if (strlen($content) < 5){ 
		$content = $post->post_title;
	}

	return $content;
}
