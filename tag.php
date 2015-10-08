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
<?php get_header(); ?>
<?php get_template_part('framework/modules/breadcrumbs');?>
<!-- Header Banner -->
<?php $headerad=ot_get_option('headerad');if (!empty($headerad)) {?>
<div id="header-banner">
	<div class="container">
		<?php echo ot_get_option('headerad');?>
	</div>
</div>
<?php }?>
<!-- /.Header Banner -->
<!-- Main Wrap -->
<div id="main-wrap">
<div class="container two-col-container">
<div id="main-wrap-left">
<div class="bloglist-container clr">
<?php if(have_posts()) : while (have_posts()) : the_post();?>
<article class="home-blog-entry col span_1 clr">
	<?php  if(!get_post_format()) { $format = 'standard'; } else { $format = get_post_format(); }?>
	<?php get_template_part('content',esc_attr( $format )); ?>
	<div class="clear"></div>
</article>
<?php endwhile;?>
<?php else : ?>
	<p><?php _e('这里好像什么文章都没有!~','xiapistudio'); ?></p>
<?php endif;?>
</div>
<!-- pagination -->
<div class="clear">
</div>
<div class="pagination">
<?php pagenavi(); ?>
</div>
<!-- /.pagination -->
</div>
<?php get_sidebar();?>
</div>
<div class="clear">
</div>
</div>
<!--/.Main Wrap -->
<!-- Bottom Banner -->
<?php $bottomad=ot_get_option('bottomad');if (!empty($bottomad)) {?>
<div id="bottom-banner">
	<div class="container">
		<?php echo ot_get_option('bottomad');?>
	</div>
</div>
<?php }else{?>
<div style="height:50px;"></div>
<?php }?>
<!-- /.Bottom Banner -->
<?php if(ot_get_option('footer-widgets-singlerow') == 'on'){?>
<div id="ft-wg-sr">
	<div class="container">
	<?php dynamic_sidebar( 'footer-row'); ?>
	</div>
</div>
<?php }?>
<?php get_footer(); ?>