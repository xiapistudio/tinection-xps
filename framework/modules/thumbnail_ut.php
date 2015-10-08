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
<?php if ( has_post_thumbnail() ) { ?>
	<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
	<?php $imgsrc = $large_image_url[0]; ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="fancyimg home-blog-entry-thumb">
			<div class="thumb-img">
			<img src="<?php echo $imgsrc; ?>" alt="<?php the_title(); ?>">
			<span><?php the_article_icon();?></span>
			</div>
		</a>
<?php }?>
	<?php if ( !has_post_thumbnail() ) {  ?>
	<?php $imgsrc = catch_first_image(); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="fancyimg home-blog-entry-thumb">
			<div class="thumb-img">
			<img src="<?php echo $imgsrc;?>" alt="<?php the_title(); ?>">
			<span><?php the_article_icon();?></span>			
			</div>
		</a>
<?php }?>