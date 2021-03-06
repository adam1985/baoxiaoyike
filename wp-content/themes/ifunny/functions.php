<?php
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	/*if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}*/

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri(), array( 'genericons' ) );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style', 'genericons' ), '20131205' );
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
			'prevText' => __( 'Previous', 'twentyfourteen' ),
			'nextText' => __( 'Next', 'twentyfourteen' )
		) );
	}

	wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20131209', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}

function pagination($query_string){    
	global $posts_per_page, $paged;    
	$my_query = new WP_Query($query_string ."&posts_per_page=-1");    
	$total_posts = $my_query->post_count;    
	if(empty($paged))$paged = 1;    
	$prev = $paged - 1;    
	$next = $paged + 1;    
	$range = 4;  
	$showitems = ($range * 2)+1;    
   
	$pages = ceil($total_posts/$posts_per_page);    

	if(1 != $pages){    
		echo "<ul class=\"cl\">";    
		echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<li><a href='".get_pagenum_link(1)."'>首页</a></li>":"";    
		echo ($paged > 1 && $showitems < $pages)? "<li><a href=\"".get_pagenum_link($prev)."\">上一页</a></li>":"";    
	   
		for ($i=1; $i <= $pages; $i++){    
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){    
				echo ($paged == $i)? "<li class=\"on\"><a>".$i."</a></li>":"<li><a href=\"".get_pagenum_link($i)."\">".$i."</a>";    
			}    
		}    
	   
		echo ($paged < $pages && $showitems < $pages) ? "<li><a href=\"".get_pagenum_link($next)."\">下一页</a></li>" :"";    
		echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<li><a href=\"".get_pagenum_link($pages)."\">尾页</a></li>":"";  

		echo "</ul>";    
	}    
}   

//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
 
function post_thumbnail_src($post){
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
			$img_length = 945;
			$target_img_id = $post->ID % $img_length;
			//$random = mt_rand(0, 945);
			//echo get_bloginfo('template_url');
			//echo '/images/pic/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			$post_thumbnail_src =  "http://adam1985.github.io/baoxiaoyike/pic/".$target_img_id.".jpg";
		}
	};
	return $post_thumbnail_src;
}


function has_thumbnail($content){
	if(preg_match("/<img.*>/i",$content)){
		return true;
	}else{
		return false;
	}
}


function hots_posts($num = 10, $before='<li>', $after='</li>'){         
	global $wpdb;    
	$sql = "SELECT comment_count,ID,post_title ";         
	$sql .= "FROM $wpdb->posts where post_status='publish' && post_type='post' ";         
	$sql .= "ORDER BY comment_count DESC ";         
	$sql .= "LIMIT 0 , $num";         
	$hotposts = $wpdb->get_results($sql);         
	$output = '';   
	$post_thumbnail_src = post_thumbnail_src();    
	
	foreach ($hotposts as $hotpost) {    
		if( $post_thumbnail_src != "") {
			$post_title = stripslashes($hotpost->post_title);             
			$permalink = get_permalink($hotpost->ID);             
			$output .= $before.'<div class="thumbnails"><a href="' . $permalink . '"  rel="bookmark" title="';  
			$output .= $post_title . '">';
			$output .= get_the_post_thumbnail($hotpost->ID, array(130,185) );
			//$output .= "<img src=\"".$post_thumbnail_src."\" width=\"185\" height=\"130\" />";
			$output .= '<p>' . $post_title . '</p></a></div>';             
			$output .= $after;      
		}      

	}         
	if($output==''){             
		$output .= $before.'暂无...'.$after;         
	}         
	echo $output;     
}


function add_poll_good($post_ID) {
	global $wpdb;
	$value=mt_rand(1,10);
	if(!wp_is_post_revision($post_ID)) {
		add_post_meta($post_ID, 'poll_good', $value, true);
	}
}

function add_poll_bad($post_ID) {
	global $wpdb;
	$value=mt_rand(1,3);
	if(!wp_is_post_revision($post_ID)) {
		add_post_meta($post_ID, 'poll_bad', $value, true);
	}
}

function add_poll($post_ID, $type) {
	global $wpdb;
	$value=mt_rand(1,10);
	if(!wp_is_post_revision($post_ID)) {
		add_post_meta($post_ID, $type, $value, true);
	}
}


add_action('publish_post', 'add_poll_good');
add_action('publish_post', 'add_poll_bad');

function digg_action_do(){
        if( isset($_POST['action']) && $_POST['action'] == 'digg'){
        	$post_ID = $_POST['postid'];
        	$poll_Type = $_POST['polltype'];
        	$digg_Value = get_post_meta($post_ID, $poll_Type, true) + 1;
            update_post_meta($post_ID, $poll_Type, $digg_Value); 
            echo get_post_meta($post_ID, $poll_Type, true);
            die();
        }else{
            return;
        }
}

add_action('template_redirect', 'digg_action_do');

// 保存视频地址
function save_video_url(){

}

add_action('publish_post', 'save_video_url');


function remote_upload_img(){
	    if( isset($_GET['action']) && $_GET['action'] == 'remoteUpload'){

        	$filePath = 'http://'.$_GET['path'];
			//$handle = fopen ($filePath, "rb");
			//$contents = "";

			//while (!feof($handle)) {
			    //$contents .= fread($handle, 8192);
			//}
			$cnt=0;
			while($cnt < 3 && ($contents=@file_get_contents($filePath))===FALSE) $cnt++; 
			//$contents = file_get_contents($filePath);
			//fclose($handle);
			if($contents === FALSE ) {
				echo '';
			} else {
				echo $contents;
			}
			
            die();
        }else{
            echo "";
        }
}

add_action('template_redirect', 'remote_upload_img');

function thumbSrc($ID){
	$thumbnail= wp_get_attachment_image_src ( get_post_thumbnail_id ( $ID ));
	echo $thumbnail[0];
}

function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return '刚刚';     
    $interval = array (         
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

function getPostViews($postID){
	$count_key = "post_views_count";
	$count = get_post_meta($postID, $count_key, true);
	if($count==""){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, "0"); return "0";
	}
	return $count."";
}
function setPostViews($postID) {
	$count_key = "post_views_count";
	$count = get_post_meta($postID, $count_key, true);
	if($count==""){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, ’0′);
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}



 // 定义一个百度分享数据 
class bdShare{  
    var $title;  
    var $summary;  
    var $url;  
    var $pic;    
}  
      
 

function setBdText($post){
	$content = preg_replace("/\[\[[^\]]+\]\]/m", '', $post -> post_content);

	$content = mb_strimwidth(strip_tags(apply_filters('the_content', $content)), 0, 200,"···");
	$content = trim($content);

	if (strlen($content) < 5){ 
		$content = $post->post_title;
	}

	return $content;
}


function createBdshare($post){
	$videoReg = "/\[\[[^\]]+\]\]/m";

    $bdShare = new bdShare(); 

    $bdShare -> title = setBdText($post);
    $bdShare -> summary = $post->post_title;
    $bdShare -> url = get_permalink();

    $videoTimg = videoReaderUrlParse($post);
    if( preg_match_all($videoReg, $post->post_content, $matches)) {
    	$explodes = explode('||', base64_decode($videoTimg[0])); 
    	$bdShare -> pic = "$explodes[1]";
    } else {
    	$bdShare -> pic = post_thumbnail_src($post);
    }
    
	echo json_encode( $bdShare ); 
}

 // 定义一个微信笑话接口
class mpjoke{  
    var $title;  
    var $description;  
    var $picUrl;  
    var $url;    
} 


function get_joke_list(){
		
        if( isset($_GET['action']) && $_GET['action'] == 'getjoke'){
			/*if( isset($_GET['start']) ) {
				$start = isset($_GET['start']);
			} else {
				$start = 1;
			}
			
			if( isset($_GET['pagesize']) ) {
				$pagesize = isset($_GET['pagesize']);
			} else {
				$pagesize = 5;
			}*/
		
			global $wpdb;
			
			$json=array();

			//$articles = $wpdb->get_results("SELECT ID, post_title, post_content FROM $wpdb->posts WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM $wpdb->posts ) and post_status='publish' ORDER BY id LIMIT 5");
			
			//$articles = $wpdb->get_results("SELECT ID, post_title, post_content FROM $wpdb->posts limit 0,5");
			
			$articles = get_posts('numberposts=5&orderby=rand&post_status=publish');
			
			foreach ($articles as $article) {
				$mpjoke = new mpjoke(); 
				$mpjoke -> title = $article->post_title;
				$mpjoke -> description = setBdText($article);
				$mpjoke -> picUrl = post_thumbnail_src($article);
				$mpjoke -> url = get_permalink($article->ID);
				array_push($json, $mpjoke);  
			}
			
			echo json_encode($json);

            die();
        }else{
            return;
        }
}

add_action('template_redirect', 'get_joke_list');

function videoReaderUrlParse( $post ){
	$videoReaderUrls = array();
	$content = $post->post_content;
	$videoRex = "/\[\[videoBase64=([^\]]+)\]\]/m";
	if( preg_match_all($videoRex, $content, $matches) ) {
		$videoReaderUrls = $matches[1];
	}
	return $videoReaderUrls;
}


function getArticleContent ( $post ){
	$videoUrls = videoReaderUrlParse( $post );
	$content = $post->post_content;
	$isSingle = is_single();
	if( $isSingle ) {
		$preload = "preload=\"auto\"";
		$autoPlay = "autoplay=\"autoplay\"";
	} else {
		$preload = "preload=\"none\"";
		$autoPlay = "";
	}
	$videoRex = "/\[\[videoBase64=([^\]]+)\]\]/m";
	$isVideoUrl = "/\.mp4/";
	if( count($videoUrls) > 0 ) {
		foreach ($videoUrls as $key=>$value){
			$explodes = explode('||', base64_decode($value)); 
			if( !isset($explodes[1])) {
				$thumbnail = post_thumbnail_src( $post );
			} else {
				$thumbnail = $explodes[1];
			}
			
			echo "<img class=\"tindex\" src=\"$thumbnail\" />";

			$videoSource  = "";
			$firstVideoUrl="";

			if( preg_match($isVideoUrl, $explodes[0]) ) {
				$videoReadUrl = $explodes[0];
				$firstVideoUrl = $videoReadUrl;
				$videoSource .= "<source type=\"video/mp4\" src=\"$videoReadUrl\" />";
			} else {
				$videoReadUrl = $explodes[0];
				$qqvideo = "/v\.qq\.com\/iframe\/player\.html\?vid=(.*)/";
				$firstVideo = ture;

				if ( preg_match($qqvideo, $videoReadUrl, $matchRes) ){
					$vid = $matchRes[1];
					$qqVideoPath = "http://ibao.sturgeon.mopaas.com/qqVideo/getinfo.php?vid=$vid";
					$postCnt=0;
					while($postCnt < 3 && ($videoParseContent=@file_get_contents($qqVideoPath))===FALSE) $postCnt++; 
					if($videoParseContent === FALSE ) {
						$videoSource =  '';
					} else {
						$videoParseContent = preg_replace("/QZOutputJson=|;/", "", $videoParseContent);	
						$videoParseJson = json_decode($videoParseContent);

						$vi = $videoParseJson->vl->vi[0];
						$ui = $vi->ul->ui;
						$fvPath = $vi->fn . "?vkey=" . $vi->fvkey;
						if(is_array($ui)) {
							foreach ($ui as $val) {
								$readyVideoPath = $val->url . $fvPath;
								if( $firstVideo ) {
										$firstVideoUrl = $readyVideoPath;
										$firstVideo = false;
								}
								$videoSource .= "<source type=\"video/mp4\" src=\"$readyVideoPath\" />";
							}
						} else {
							$videoSource = "该视频暂时不能播放!";
						}

					}
				} else {
					$videoReadUrl = preg_replace("/http:\/\//", "http:##", $videoReadUrl);	
					$videoReadUrl = base64_encode($videoReadUrl);
					$videoUrlParse = "http://api.flvxz.com/token/c6257bb3e4848d341c6be62c7ce19257/url/" . $videoReadUrl . "/jsonp/purejson/ftype/mp4";
					$postCnt=0;
					while($postCnt < 3 && ($videoParseContent=@file_get_contents($videoUrlParse))===FALSE) $postCnt++; 
					if($videoParseContent === FALSE ) {
						$videoSource =  '';
					} else {
						$videoParseJson = json_decode($videoParseContent);
						if(is_array($videoParseJson)) {
							foreach ($videoParseJson as $val) {
								foreach ($val->files as $value) {
									if( $firstVideo ) {
										$firstVideoUrl = $value->furl;
										$firstVideo = false;
									}
									$videoSource .= "<source type=\"video/mp4\" src=\"$value->furl\" />";
									//$videoPath = $value->furl;
									//break;
								}
							}
						}
					}
				
					// $videoParseContent = file_get_contents($videoUrlParse);
				}
	
			}

			$videoStr = "<div class=\"video-list-item\"><video class=\"mediaelementplayer\" width=\"485\" height=\"275\" poster=\"$explodes[1]\" type=\"video/mp4\" controls=\"controls\" $autoPlay $preload>".
							$videoSource.
						"<p>亲，您的浏览器不支持视频播放，firefox，chrome，safari，ie9以上版本的主流浏览器，赶紧去升级!</p></video></div>";
			
			/*if( isset( $videoPath ) ) {
				$time = time();
				$videoPlayer = "<div class=\"video-list-item\" id=\"jw_$time\" data-url=\"$videoPath\" data-pic=\"$explodes[1]\"></div>";
				$content = preg_replace($videoRex, $videoStr, $post->post_content);		
			}*/
			
			$content = preg_replace($videoRex, $videoStr, $post->post_content);		
  
		}

		echo $content;

	} else {
		echo $content;

		if( !has_thumbnail( $content ) ) {
			$thumbnail = post_thumbnail_src($post);
			echo "<p><img src=\"$thumbnail\" /></p>";
		}
		
	}


}



