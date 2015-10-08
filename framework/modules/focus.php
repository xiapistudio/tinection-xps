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
<div id="focus-us">
<?php _e('关注我们','xiapistudio'); ?>
<div id="focus-slide" class="ie_pie">
	<div class="focus-title">关注我们</div>
	<p class="focus-content">
		<a href="http://weibo.com/<?php echo ot_get_option('tin_sinaweibo'); ?>" target="_blank" class="sinaweibo"><span><i class="fa fa-weibo"></i><?php _e('新浪微博','xiapistudio'); ?></span></a>
		<a href="http://t.qq.com/<?php echo ot_get_option('tin_qqweibo'); ?>" target="_blank" class="sinaweibo"><span><i class="fa fa-tencent-weibo"></i><?php _e('腾讯微博','xiapistudio'); ?></span></a>
	</p>
	<div class="focus-title">联系我们</div>
	<p class="focus-content" style="line-height: 20px;margin-bottom: 10px;">
		<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ot_get_option('tin_qq'); ?>&site=qq&menu=yes" target="_blank" class="qq"><span><i class="fa fa-qq"></i><?php _e('QQ','xiapistudio'); ?></span></a>
		<a href="<?php echo ot_get_option('tin_qq_mail'); ?>" target="_blank"><span><i class="fa fa-envelope"></i><?php _e('发送邮件','xiapistudio'); ?></span></a>
		<!-- 可删除 -->
		<?php if(ot_get_option('tin_qqgroup')){ ?><a target="_blank" href="<?php echo ot_get_option('tin_qqgroup'); ?>"><i class="fa fa-users">&nbsp;&nbsp;</i>加入QQ群</a><?php } ?>
		<!-- 删除截止 -->
	</p>
	<div class="focus-title">订阅本站<i class="fa fa-rss"></i></div>
	<p class="focus-content">
		<input type="text" name="rss" class="rss" value="<?php bloginfo('rss2_url'); ?>" />
	</p>
	<p class="focus-content">订阅到： <a rel="external nofollow" target="_blank" href="http://xianguo.com/subscribe?url=<?php bloginfo('rss2_url'); ?>">鲜果</a>
		<a rel="external nofollow" target="_blank" href="http://reader.youdao.com/b.do?keyfrom=bookmarklet&amp;url=<?php bloginfo('rss2_url'); ?>">有道</a>
		<a rel="external nofollow" target="_blank" href="http://feedly.com/index.html#subscription%2Ffeed%2F<?php bloginfo('rss2_url'); ?>">Feedly</a></p>
	<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post">
		<input type="hidden" name="t" value="qf_booked_feedback" />
		<input type="hidden" name="id" value="<?php echo ot_get_option('tin_qqlist'); ?>" />
		<input type="email" name="to" id="to" class="focus-email" placeholder="<?php _e('输入邮箱,订阅本站','xiapistudio'); ?>" required />
		<input type="submit" class="focus-email-submit" value="<?php _e('订阅','xiapistudio'); ?>" />
	</form>

</div>
</div>