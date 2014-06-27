<?php if( !isAppView() ) { ?>
<div class="bdsharebuttonbox" data-tag="share_1">
	<ul class="clearfix">
	    <li><a class="bds_tsina" data-cmd="tsina"></a></li>
	    <li><a class="bds_tqq" data-cmd="tqq"></a></li>
	    <li><a class="bds_qzone" data-cmd="qzone"></a></li>
	    <li><a class="bds_tqf" data-cmd="tqf"></a></li>
	    <li><a class="bds_weixin" data-cmd="weixin"></a></li>
	</ul>
</div>

<script type="text/javascript">
window._bd_share_config = {"common": {
		"bdText" : "<?php echo setSharetext(get_post());?>",	
		"bdDesc" : "<?php the_title(); ?>",	
		"bdUrl" : "<?php echo get_permalink(); ?>", 	
		"bdPic" : "<?php echo get_share_pic();?>",
		//"searchPic" : "on",
        "bdMini": 2,
        "bdPopupOffsetTop": 0
    }, "share": [
        {
            "bdSize": 24
        }
    ], "selectShare": [
        {
            "bdSelectMiniList": ["tsina", "tqq", "qzone", "tqf", "weixin"]
        }
    ]};
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
<?php } ?>
