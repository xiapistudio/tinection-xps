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
<?php get_template_part( 'framework/modules/breadcrumbs');?>
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
<div id="blocks-bar" class="container two-col-container">
<div id="main-wrap-left">
<div class="bloglist-container clr">
<?php while (have_posts()) : the_post();?>
<span class="col span_1_of_3">
<article class="home-blog-entry clr">
	<?php  if(!get_post_format()) { $format = 'standard'; } else { $format = get_post_format(); }?>
	<?php get_template_part('framework/modules/thumbnail',esc_attr( $format )); ?>
	<div class="home-blog-entry-text contentcms-entry-text">
		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<p>
			<?php $contents = get_the_excerpt(); $excerpt = wp_trim_words($contents,120,ot_get_option('readmore')); echo $excerpt;?>
		</p>
		<div class="line"></div>
		<!-- Post meta -->
		<?php tin_post_meta(1); ?>
		<!-- /.Post meta -->
	</div>
	<div class="clear"></div>
</article>
</span>
<?php endwhile;?>
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