define(['jquery', './initializeDigg', './initializeShare', './initializeFavorite', './initializeLazyload'], 
	function($, initializeDigg, initializeShare, initializeFavorite, initializeLazyload){
		$(function(){
			// 打分
			initializeDigg();

			// 分享
			initializeShare();

			// 收藏
			initializeFavorite();

			// 图片延时加载
			initializeLazyload();
			
		});
});
