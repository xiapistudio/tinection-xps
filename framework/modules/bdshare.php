<?php

/***************************************

	Theme Name: 	Change
	Theme URI: 		http://www.xiapistudio.com/change
	Description: 	Chage主题，WordPress多模板主题
	Version: 		1.0.1
	Author: 		虾皮工作室
	Author URI: 	http://www.xiapistudio.com/
	License:     	GPLv3
	
***************************************/

?>

<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare baidu-share">
	<a href="#" class="bds_tsina weibo-btn share-btn" data-cmd="tsina">
		<i class="fa fa-weibo"></i><?php _e('分享到微博 ','xiapistudio'); ?>
	</a>
	<a href="#" class="bds_weixin weixin-btn share-btn">
		<i class="fa fa-weixin"></i><?php _e('分享到朋友圈 ','xiapistudio'); ?>
		<div id="weixin-qt" style="display: none; top: 80px; opacity: 1;">
			<img src="http://qr.liantu.com/api.php?text=<?php the_permalink(); ?>" width="120">
			<div id="weixin-qt-msg"><?php _e('打开微信，点击底部的“发现”，使用“扫一扫”即可将网页分享至朋友圈。','xiapistudio'); ?></div>
		</div>
	</a>
	<a href="#" class="bds_more more-btn share-btn" data-cmd="more"><i class="fa fa-share-alt fa-flip-horizontal"></i><span class="pc-text"><?php _e('更多','xiapistudio'); ?></span><span class="mobile-text"><?php _e('分享','xiapistudio'); ?></span></a>
</div>