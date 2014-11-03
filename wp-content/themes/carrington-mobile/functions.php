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

function trimall($str){
	$qian=array(" ","　","\t","\n","\r");
	$hou=array("","","","","");
	return str_replace($qian,$hou,$str); 
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

			if( preg_match($isVideoUrl, $explodes[0]) ) {
				$videoReadUrl = $explodes[0];
				$firstVideoUrl =$videoReadUrl;
				$videoSource .= "<source type=\"video/mp4\" src=\"$videoReadUrl\" />";
			} else {
				$videoReadUrl = $explodes[0];
				
				$qqvideo = "/v\.qq\.com\/iframe\/player\.html\?vid=(.*)/";
				$firstVideo = ture;
				if ( preg_match($qqvideo, $videoReadUrl, $matchRes) ){
					$vid = $matchRes[1];
					$qqVideoPath = "http://baoxiaoyike.sinaapp.com/qqVideo/getinfo.php?vid=$vid";
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
						
						foreach ($ui as $val) {
							$readyVideoPath = $val->url . $fvPath;
							if( $firstVideo ) {
									$firstVideoUrl = $readyVideoPath;
									$firstVideo = false;
							}
							$videoSource .= "<source type=\"video/mp4\" src=\"$readyVideoPath\" />";
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
								}
							}
						}
					}
				}

				
				// $videoParseContent = file_get_contents($videoUrlParse);	
			}

			$videoStr = "<div class=\"video-list-item\"><video width=\"100%\" height=\"200\" class=\"mediaelementplayer\" src=\"$firstVideoUrl\" controls=\"controls\" autoplay=\"autoplay\" x-webkit-airplay=\"true\" preload=\"auto\">".
							$videoSource.
						"</video></div>";

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
//全部结束
?>