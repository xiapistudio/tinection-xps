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
<?php //get_template_part( 'framework/modules/breadcrumbs');?>

<!-- Main Wrap -->
<div id="main-wrap">
	<div id="sitenews-wrap" class="container">
	<?php get_template_part('framework/modules/sitenews'); ?>
	</div>
	
	<?php 
		if (ot_get_option('openslider')=='on') {
			$slider = (ot_get_option('slider_style')=='no_full') ? 'slider-nar' : 'slider'; 
			get_template_part( 'framework/modules/'.$slider );
		} 
	?>
	
	<!-- Header Banner -->
	<?php $headerad=ot_get_option('headerad');if (!empty($headerad)) {?>
	<div id="header-banner" class="banner">
		<div class="container">
			<?php echo ot_get_option('headerad');?>
		</div>
	</div>
	<?php }?>
	<!-- /.Header Banner -->
	
	<?php get_template_part( 'loop', 'index' );?>
</div>
<!--/.Main Wrap -->

<!-- Bottom Banner -->
<?php $bottomad=ot_get_option('bottomad');if (!empty($bottomad)) {?>
<div id="bottom-banner" class="banner">
	<div class="container">
		<?php echo ot_get_option('bottomad');?>
	</div>
</div>
<?php }else{?>
<div style="height:20px;"></div>
<?php }?>
<!-- /.Bottom Banner -->

<?php if(ot_get_option('footer-widgets-singlerow') == 'on'){?>
<div id="ft-wg-sr">
	<div class="container">
	<?php dynamic_sidebar( 'footer-row'); ?>
	</div>
</div>
<?php }?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>

