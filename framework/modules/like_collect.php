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
<?php $tinlikes=get_post_meta($post->ID,'tin_post_likes',true); $tincollects=get_post_meta($post->ID,'tin_post_collects',true); if(empty($tinlikes)):$tinlikes=0; endif;if(empty($tincollects)):$tincollects=0; endif;?>
<?php $c_name = 'tin_post_like_'.$post->ID;$cookie = isset($_COOKIE[$c_name])?$_COOKIE[$c_name]:'';?>
	<div class="mark-like-btn tinlike clr">
		<a class="share-btn like-btn <?php if($cookie==1)echo 'love-yes'; ?>" pid="<?php echo $post->ID ; ?>" href="javascript:;" title="<?php _e('点击喜欢','xiapistudio'); ?>">
			<i class="fa fa-heart"></i>
			<?php echo '<span>'.$tinlikes.'</span>'.__('人喜欢 ','xiapistudio'); ?>
		</a>
		<?php $uid = get_current_user_id(); if(!empty($uid)&&$uid!=0){ ?>
		
		<?php $mycollects = get_user_meta($uid,'tin_collect',true);
			$mycollects = explode(',',$mycollects);
			$match = 0;
			foreach ($mycollects as $mycollect){
				if ($mycollect == $post->ID):$match++;endif;
			}		
		?>
		
		<?php if ($match==0){ ?>
		<a class="share-btn collect collect-no" pid="<?php echo $post->ID ; ?>" href="javascript:;" uid="<?php echo get_current_user_id(); ?>" title="<?php _e('点击收藏','xiapistudio'); ?>">
			<i class="fa fa-star"></i>
			<span><?php echo $tincollects; ?><?php _e('人收藏 ','xiapistudio'); ?></span>
		</a>
		<?php }else{ ?>
		<a class="share-btn collect collect-yes" style="cursor:default;" title="<?php _e('你已收藏','xiapistudio'); ?>">
			<i class="fa fa-star"></i>
			<?php _e('你已收藏','xiapistudio'); ?>
		</a>
		<?php } ?>
		<?php }else{ ?>
		<a class="share-btn collect collect-no" style="cursor:default;" title="<?php _e('你必须注册并登录才能收藏','xiapistudio'); ?>">
			<i class="fa fa-star"></i>
			<span><?php echo $tincollects; ?><?php _e('人收藏 ','xiapistudio'); ?></span>
		</a>				
		<?php } ?>
	</div>