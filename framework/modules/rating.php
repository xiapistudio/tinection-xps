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
<?php
	$rating = get_post_meta($post->ID,'tin_rating',true);
	$rateaverage = get_post_meta($post->ID,'tin_rating_average',true);
	$rating_array = explode(',',$rating);
	$rateone = isset($rating_array[0])?$rating_array[0]:0;
	$ratetwo = isset($rating_array[1])?$rating_array[1]:0;
	$ratethree = isset($rating_array[2])?$rating_array[2]:0;
	$ratefour = isset($rating_array[3])?$rating_array[3]:0;
	$ratefive = isset($rating_array[4])?$rating_array[4]:0;
	$rateaverage = (double)($rateaverage);
	$rateaverage = number_format($rateaverage,1,'.','');
	empty($rateone)?$rateone=0:$rateone=$rateone;
	empty($ratetwo)?$ratetwo=0:$ratetwo=$ratetwo;
	empty($ratethree)?$ratethree=0:$ratethree=$ratethree;
	empty($ratefour)?$ratefour=0:$ratefour=$ratefour;
	empty($ratefive)?$ratefive=0:$ratefive=$ratefive;
	empty($rateaverage)?$rateaverage=0:$rateaverage=$rateaverage;
	$ratetimes = $rateone + $ratetwo + $ratethree + $ratefour + $ratefive;
?>
<div class="rates" pid="<?php echo $post->ID; ?>">
	<span class="ratesdes"><?php _e('文章评分','xiapistudio'); ?>
		<span class="ratingCount"><?php echo $ratetimes ; ?></span><?php _e(' 次，平均分','xiapistudio'); ?>
		<span class="ratingValue"><?php echo $rateaverage ; ?></span> ：
		<span id="starone" class="stars" title="<?php _e('1星','xiapistudio'); ?>" times="<?php echo $rateone; ?>" solid="<?php if($rateaverage>0.5){echo 'y';}else{echo 'n';}?>"><i class="fa fa-star<?php if($rateaverage>0.5){echo '';}else{echo '-o';}?>"></i></span>
		<span id="startwo" class="stars" title="<?php _e('2星','xiapistudio'); ?>" times="<?php echo $ratetwo; ?>" solid="<?php if($rateaverage>1.5){echo 'y';}else{echo 'n';}?>"><i class="fa fa-star<?php if($rateaverage>1.5){echo '';}else{echo '-o';}?>"></i></span>
		<span id="starthree" class="stars" title="<?php _e('3星','xiapistudio'); ?>" times="<?php echo $ratethree; ?>" solid="<?php if($rateaverage>2.5){echo 'y';}else{echo 'n';}?>"><i class="fa fa-star<?php if($rateaverage>2.5){echo '';}else{echo '-o';}?>"></i></span>
		<span id="starfour" class="stars" title="<?php _e('4星','xiapistudio'); ?>" times="<?php echo $ratefour; ?>" solid="<?php if($rateaverage>3.5){echo 'y';}else{echo 'n';}?>"><i class="fa fa-star<?php if($rateaverage>3.5){echo '';}else{echo '-o';}?>"></i></span>
		<span id="starfive" class="stars" title="<?php _e('5星','xiapistudio'); ?>" times="<?php echo $ratefive; ?>" solid="<?php if($rateaverage>4.5){echo 'y';}else{echo 'n';}?>"><i class="fa fa-star<?php if($rateaverage>4.5){echo '';}else{echo '-o';}?>"></i></span>
	</span>
</div>