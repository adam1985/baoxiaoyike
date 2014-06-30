<?php
// 评论回复
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$page = get_query_var('cpage')-1;
		$cpp=get_option('comments_per_page');
		$commentcount = $cpp * $page;
	}
    ?>
   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>">
      <?php $add_below = 'div-comment'; ?>
		<div class="author_box">
			<span  class="comment-author">
				<strong><?php comment_author_link(); ?></strong>&nbsp;
				<span class="datetime">
					<?php comment_date('Y.m.d') ?>
				</span>
				<span class="reply">
					<?php comment_reply_link(array_merge( $args, array('reply_text' => '回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
				</span >
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
		您的评论正在等待审核中...
		<br/>
		<?php endif; ?>
		<?php comment_text() ?>
  </div>
<?php
}
function mytheme_end_comment() {
		echo '</li>';
}

function post_thumbnail_src(){
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
		echo $post->post_content;
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

function setBdText($post){
	$content = mb_strimwidth(strip_tags(apply_filters('the_content', $post -> post_content)), 0, 200,"···");
	$content =preg_replace("/[\r\n]/","",$content); 
	

	if (strlen($content) < 5){ 
		$content = $post->post_title;
	}
	
	$content = trim($content);

	return $content;
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


add_action('publish_post', 'add_poll_good');
add_action('publish_post', 'add_poll_bad');

//判断是否为微信

function isWeixin(){ 

    $agent = strtolower($_SERVER['HTTP_USER_AGENT']); 

    if(preg_match("/micromessenger/i", $agent)){

        return true;

    }else{

        return false;

    }

}

//全部结束
?>