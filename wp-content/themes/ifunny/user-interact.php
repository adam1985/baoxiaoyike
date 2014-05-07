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
            <div class="bdsharebuttonbox" data-tag="share_1" data-config='<?php createBdshare($post); ?>'>
                <a class="bds_weixin" data-cmd="weixin"></a>
                <a class="bds_tsina" data-cmd="tsina"></a>
                <a class="bds_tqq" data-cmd="tqq"></a>
                <a class="bds_qzone" data-cmd="qzone"></a>
                <a class="bds_tqf" data-cmd="tqf"></a>
                <a class="bds_sqq" data-cmd="sqq"></a>
                <a class="bds_renren" data-cmd="renren"></a>
                <a class="bds_baidu" data-cmd="baidu"></a>
                <a class="bds_more" data-cmd="more">更多</a>
            </div>
        </div>
    </div>
    <div class="fr user-comment">

    </div>
</div>