define(['jquery', './initializeDigg', './initializeShare', './initializeFavorite'], 
	function($, initializeDigg, initializeShare, initializeFavorite){
		$(function(){
			// 打分
			initializeDigg();

			// 分享
			initializeShare();

			// 收藏
			initializeFavorite();
			
		});
});
