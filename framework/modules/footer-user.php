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
<!--  links -->
<div id="footer-links-icons">
	<span class="footer-wordpress-link">
		<a href="http://wordpress.org" target="_blank" class="wordpress">
			<span><i class="fa fa-wordpress"></i></span>
			<br>WordPress
		</a>
	</span>
	<span class="footer-aliyun-link">
		<a href="http://www.zhiyanblog.com/go/aliyun" target="_blank" class="aliyun">
			<span><i class="fa fa-cloud"></i></span>
			<br>Aliyun
		</a>
	</span>
	<?php if(ot_get_option('opt_sinaweibo')){ ?>
	<span class="footer-sinaweibo-link">
		<a href="http://weibo.com/<?php echo ot_get_option('tin_sinaweibo'); ?>" target="_blank" class="sinaweibo">
			<span><i class="fa fa-weibo"></i></span>
			<br>Weibo
		</a>
	</span>
	<?php } ?> 
	<?php if(ot_get_option('opt_qq')){ ?>
	<span class="footer-qq-link">
		<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ot_get_option('tin_qq'); ?>&site=qq&menu=yes" target="_blank" class="qq">
			<span><i class="fa fa-qq"></i></span>
			<br>QQ
		</a>
	</span>
	<?php } ?> 
	<span class="footer-rss-link">
		<a href="<?php bloginfo('rss2_url'); ?>" target="_blank" class="rss">
			<span><i class="fa fa-rss"></i></span>
			<br>RSS
		</a>
	</span>
	<?php if(ot_get_option('page_newsletter')&&ot_get_option('newsletter')=='on'){ ?>
	<span class="footer-newsletter-link">
		<a href="<?php echo get_bloginfo('url').'/'.ot_get_option('page_newsletter','newsletter'); ?>" target="_blank" class="newsletter">
			<span><i class="fa fa-envelope"></i></span>
			<br>Newsletter
		</a>
	</span>
	<?php } ?> 
</div>
<!-- /.links -->
<div class="clear clr"></div>