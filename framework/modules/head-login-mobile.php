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
<div id="login-box-mobile">
<?php if (!(current_user_can('level_0'))) { ?>
	<div class="login-box-mobile-form">
		<button data-sign="0" class="btn btn-primary user-login"><?php _e('登录','xiapistudio'); ?></button>
		<?php if(get_option('users_can_register')==1){ ?><button data-sign="1" class="btn btn-success user-reg"><?php _e('注册','xiapistudio'); ?></button><?php } ?>
	</div>
<?php } else { ?>
	<div class="login-yet-mobile">
<?php global $current_user; get_currentuserinfo();?>
		<div class="login-yet-mobile-avatar">
			<?php echo fun_get_avatar( $current_user->ID , '60' , fun_get_avatar_type($current_user->ID) ); ?>
		</div>
		<div class="login-yet-mobile-manageinfo">
		<a href="<?php bloginfo('url'); ?>" class="title"><?php bloginfo('name');?></a>
		<a href="<?php echo fun_get_user_url('profile'); ?>" class="name">@&nbsp;<?php echo $current_user->display_name;?></a>
		<?php $unread = intval(fun_get_message($current_user->ID, 'count', "msg_type='unread' OR msg_type='unrepm'")); if($unread>0) { ?><a href="<?php echo fun_get_user_url('message'); ?>" title="<?php _e('新消息','xiapistudio'); ?>" class="new-message-notify"></a><?php } ?>
		</div>
		<div class="clr"></div>
	</div>
<?php }?>
</div>