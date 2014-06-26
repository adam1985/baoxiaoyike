<?php get_header(); ?>
	<div class="browse">现在位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php $categories = get_the_category(); echo(get_category_parents($categories[0]->term_id, TRUE, ' &gt; '));  ?>正文</div>
	<div id="main">
		<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="primary">
					<h2 class="primary-title"><?php the_title(); ?></h2>
					<div class="archive_info">
						<span class="date"><?php the_time('Y年m月d日') ?></span>
						<span><a href="javascript:viewProfile();">爆笑一刻</a></span>
						<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论数 1', '评论数 %'); ?></span>
						<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
						<span class="edit"><?php edit_post_link('编辑', '  ', '  '); ?></span>
					</div>
				<?php the_content('Read more...'); ?>
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
<?php get_footer(); ?>
<script>
        var nickname = "爆笑一刻";
        var user_name = "gh_7de45f5b71f9";
function viewProfile() {
    typeof WeixinJSBridge != "undefined" && WeixinJSBridge.invoke && WeixinJSBridge.invoke("profile", {
        username: user_name,
        scene: "57"
});
</script>