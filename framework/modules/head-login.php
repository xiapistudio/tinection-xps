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
<?php if (!(current_user_can('level_0'))) { ?>
	<?php if(get_option('users_can_register')==1) $register = 'on'; else $register = 'off'; ?>
		<div id="login-reg">
			<span data-sign="0" id="user-login" class="user-login ie_pie <?php if($register == 'off') echo 'only-login'; ?>"><?php _e(' 登录','xiapistudio'); ?></span>
			<?php if($register == 'on') { ?><span data-sign="1" id="user-reg" class="user-reg ie_pie"><?php _e('注册','xiapistudio'); ?></span><?php }?>
		</div>
<?php }else{global $current_user; get_currentuserinfo();?>
			<div class="login-yet-click">
				<div class="login-yet-click-inner">
					<?php echo fun_get_avatar( $current_user->ID , '35' , fun_get_avatar_type($current_user->ID) ); ?>
					<a href="<?php bloginfo('url'); ?>/wp-admin/profile.php" title="<?php _e('用户管理','xiapistudio'); ?>"><?php echo $current_user->display_name;?></a>
					<?php $unread = intval(fun_get_message($current_user->ID, 'count', "msg_type='unread' OR msg_type='unrepm'")); if($unread>0) { ?><a href="<?php echo fun_get_user_url('message'); ?>" title="<?php _e('新消息','xiapistudio'); ?>" class="new-message-notify"></a><?php } ?>
				</div>
				<div class="user-tabs">
					<span><i class="fa fa-book"></i>&nbsp;<a href="<?php echo fun_get_user_url('post'); ?>" title="<?php _e('我的文章','xiapistudio'); ?>"><?php _e('我的文章','xiapistudio'); ?></a></span>
					<span><i class="fa fa-edit"></i>&nbsp;<a href="<?php echo fun_get_user_url('post').'&action=new'; ?>" title="<?php _e('发布文章','xiapistudio'); ?>"><?php _e('发布文章','xiapistudio'); ?></a></span>
					<span><i class="fa fa-heart"></i>&nbsp;<a href="<?php echo fun_get_user_url('collect'); ?>" title="<?php _e('我的收藏','xiapistudio'); ?>"><?php _e('我的收藏','xiapistudio'); ?></a></span>
					<span><i class="fa fa-envelope"></i>&nbsp;<a href="<?php echo fun_get_user_url('message'); ?>" title="<?php _e('站内消息','xiapistudio'); ?>"><?php _e('站内消息','xiapistudio'); ?><?php if($unread>0) echo '('.$unread.')'; ?></a></span>
					<span><i class="fa fa-cny"></i>&nbsp;<a href="<?php echo fun_get_user_url('credit'); ?>" title="<?php _e('我的积分','xiapistudio'); ?>"><?php _e('积分查询','xiapistudio'); ?></a></span>
					<span><i class="fa fa-cog"></i>&nbsp;<a href="<?php echo fun_get_user_url('profile'); ?>" title="<?php _e('编辑资料','xiapistudio'); ?>"><?php _e('编辑资料','xiapistudio'); ?></a></span>
					<span><i class="fa fa-sign-out"></i>&nbsp;<a href="<?php if(is_singular()){echo wp_logout_url( get_permalink() ); }else{echo wp_logout_url(get_bloginfo('url'));} ?>" title="<?php _e('注销登录','xiapistudio'); ?>"><?php _e('注销登录','xiapistudio'); ?></a></span>
				</div>
			</div>
<?php } ?>