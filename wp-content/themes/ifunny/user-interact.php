<div class="cl art-footer">
    <div class="fl user-interact" id="user-interact">
        <div class="fl digg-box" data-post-id="<?php the_ID(); ?>">
            <a class="fl digg-up" data-poll-type="poll_good" href="javascript:void(null)">
                <p class="sprites">
                    <?php echo get_post_meta(get_the_ID(), 'poll_good', true); ?>
                </p>
            </a>
            <a class="fl digg-down" data-poll-type="poll_bad" href="javascript:void(null)">
                <p class="sprites">
                    <?php echo get_post_meta(get_the_ID(), 'poll_bad', true); ?>
                </p>
            </a>
            <!--span class="fl">阅读&nbsp<?php echo getPostViews(get_the_ID()); ?>次</span-->
        </div>

        <div class="fr baidu-share">
			<div class="mini-share">
				<div class="bshare-custom icon-medium" data-share-data='<?php createBdshare($post); ?>'>
					<a title="分享到微信" class="bshare-weixin"></a>
					<a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
					<a title="分享到腾讯微博" class="bshare-qqmb"></a>
					<a title="分享到QQ空间" class="bshare-qzone"></a>
					<a title="分享到腾讯朋友" class="bshare-qqxiaoyou"></a>
					<a title="分享到人人网" class="bshare-renren"></a>
					<a title="分享到网易微博" class="bshare-neteasemb"></a>
					<a title="一键分享到各大微博和社交网络" class="bshare-bsharesync"></a>
					<span class="BSHARE_COUNT bshare-share-count">0</span>
				</div>
			</div>
        </div>
    </div>
    <div class="fr user-comment">

    </div>
</div>