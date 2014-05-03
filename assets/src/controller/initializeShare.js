define(['jquery', 'component/tools', 'interface/share-config'], function($, tools, config){
	return function(){
		var bdsharebuttonbox = $('.bdsharebuttonbox'), shareConfig;
		bdsharebuttonbox.on('click', 'a', function(){
			var bdshare = $(this).closest('.bdsharebuttonbox'),
				shareConfig = eval( '(' + bdshare.attr('data-config') + ')' );
			window._bd_share_config.shareConfig = shareConfig;
		});

		window._bd_share_config = config;

		tools.loadScript('http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=');

	}

		
});
