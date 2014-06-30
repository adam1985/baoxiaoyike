<?php get_header(); ?>
	<div class="browse">现在位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php $categories = get_the_category(); echo(get_category_parents($categories[0]->term_id, TRUE, ' &gt; '));  ?>正文</div>
	<div id="main">
		<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="primary">
					<h2 class="primary-title"><?php the_title(); ?></h2>
					<div class="archive_info">
						<span class="date"><?php the_time('Y年m月d日') ?></span>
						<span><a class="add-contacts" href="weixin://contacts/profile/gh_7de45f5b71f9">爆笑一刻</a></span>
						<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论数 1', '评论数 %'); ?></span>
						<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
						<span class="edit"><?php edit_post_link('编辑', '  ', '  '); ?></span>
					</div>
					<div class="mini-share">
						<div class="bshare-custom">
							<?php 
								if( isWeixin() ) {
							?>
								<a title="分享到微信" id="share-weixin-icon" class="share-weixin-icon">
									<img src="http://static.bshare.cn/frame/images/logos/s4/weixin.png" />
								</a>
							<?php } else {  ?>
								<a title="分享到微信" class="bshare-weixin"></a>
							<?php } ?>

							<a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
							<a title="分享到腾讯微博" class="bshare-qqmb"></a>
							<a title="分享到QQ空间" class="bshare-qzone"></a>
							<a title="分享到腾讯朋友" class="bshare-qqxiaoyou"></a>
							<a title="分享到人人网" class="bshare-renren"></a>
							<a title="分享到网易微博" class="bshare-neteasemb"></a>
							<span class="BSHARE_COUNT bshare-share-count">0</span>
						</div>
						<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=718feda1-4152-4ab7-ab90-418b8fa918bf&amp;pophcol=2&amp;lang=zh"></script>
						<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>

					</div>
					<div id="weixin-share-tip" class="hide weixin-share-tip">
						<img src="http://adam1985.github.io/baoxiaoyike/app/images/weixin-share.png">
					</div>
				<div id="joke-content">
					<?php the_content('Read more...'); ?>
				</div>
				<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '上一页', 'nextpagelink' => "")); ?><?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?><?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "下一页")); ?>
				<div class="scroll-top"><a href="javascript:scroll(0,0)">返回顶部</a></div>
			 </div>
	        <?php endwhile; ?>
	        <?php endif; ?>
	 		<div class="clear"></div>
		</div>
        <!-- content -->
	</div>
    <!-- main-->
	<div class="navigation">
		<div class="nav-previous"><?php next_post_link('%link', ' &lt; 上一篇', TRUE, ''); ?></div>
		<div class="nav-next"><?php previous_post_link('%link', '下一篇 &gt; ', TRUE, ''); ?></div>
		<div class="clear"></div>
	</div>
<?php include('tab.php'); ?>
<?php comments_template(); ?>

<script type="text/javascript" src="http://adam1985.github.io/baoxiaoyike/app/scripts/WeixinApi.js" ></script>
<script>

var thumbnails = $('#joke-content img'), imgSrc;
if(thumbnails.length){
	imgSrc = thumbnails.first().attr('src');
} else {
	imgSrc = 'http://adam1985.github.io/baoxiaoyike/assets/images/mini_logo.jpg';
}

if(!/http/i.test(imgSrc)) {
	imgSrc = 'http://www.baoxiaoyike.cn/' + imgSrc;
}

WeixinApi.ready(function(Api) {



    // 微信分享的数据
    var wxData = {
        "appId": "", // 服务号可以填写appId
        "imgUrl" : imgSrc,
        "link" : location.href,
        "desc" : '<?php echo setBdText($post); ?>',
        "title" : "<?php echo $post->post_title; ?>"
    };

    // 分享的回调
    var wxCallbacks = {
        // 分享操作开始之前
        ready : function() {
            // 你可以在这里对分享的数据进行重组
            //alert("准备分享");
        },
        // 分享被用户自动取消
        cancel : function(resp) {
            // 你可以在你的页面上给用户一个小Tip，为什么要取消呢？
            //alert("分享被取消");
        },
        // 分享失败了
        fail : function(resp) {
            // 分享失败了，是不是可以告诉用户：不要紧，可能是网络问题，一会儿再试试？
            //alert("分享失败");
        },
        // 分享成功
        confirm : function(resp) {
            // 分享成功了，我们是不是可以做一些分享统计呢？
            //window.location.href='http://192.168.1.128:8080/wwyj/test.html';
            //alert("分享成功");
        },
        // 整个分享过程结束
        all : function(resp) {
            // 如果你做的是一个鼓励用户进行分享的产品，在这里是不是可以给用户一些反馈了？
            //alert("分享结束");
        }
    };

    // 用户点开右上角popup菜单后，点击分享给好友，会执行下面这个代码
    Api.shareToFriend(wxData, wxCallbacks);

    // 点击分享到朋友圈，会执行下面这个代码
    Api.shareToTimeline(wxData, wxCallbacks);

    // 点击分享到腾讯微博，会执行下面这个代码
    //Api.shareToWeibo(wxData, wxCallbacks);
});
</script>
<script type="text/javascript" charset="utf-8">
	bShare.addEntry({
		title: "<?php echo $post->post_title; ?>",
		url: location.href,
		summary: "<?php echo setBdText($post); ?>",
		pic: imgSrc
	});
</script> 
<script>
(function(){
 var ua = navigator.userAgent.toLowerCase(),
	shareWeixinIcon = $('#share-weixin-icon'),
	weixinShareTip = $('#weixin-share-tip'), timeout ;
	if( /micromessenger/i.test( ua ) ) {
		shareWeixinIcon.click(function(e){
			e.stopPropagation();
			weixinShareTip.slideDown();
			document.body.scrollTop = 0;
			timeout = setTimeout( function(){
				if( weixinShareTip.is(':visible') ) {
					timeout && clearTimeout(timeout);
					weixinShareTip.slideUp();
				}
			}, 10 * 1000);
		});
		
		$(document).click(function(){
			timeout && clearTimeout(timeout);
			weixinShareTip.slideUp();
		});

	}
})();
</script>
<?php get_footer(); ?>