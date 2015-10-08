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
<div class="container two-col-container">
	<div id="main-wrap-left">
		<?php get_template_part('framework/modules/stickys'); ?>
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; $uncat = ot_get_option('cmsundisplaycats');query_posts(array('post__not_in'=>get_option('sticky_posts'),'category__not_in'=>$uncat,'paged' => $paged)); ?>
		
		<div class="bloglist-container clr">
			<h2 class="home-heading clr">
				<span class="heading-text-blog">
					<?php _e('最新文章','tinection');?>
				</span>
			</h2>
		<?php $i=0;if(have_posts()):while (have_posts()) : the_post();$i++;?>
			<article class="home-blog-entry col span_1 clr">
				<?php  if(!get_post_format()) { $format = 'standard'; } else { $format = get_post_format(); }?>
				<?php get_template_part('content',esc_attr( $format )); ?>
				<div class="clear"></div>
			</article>
			<?php if($i==2){ ?>
			<?php if(!fun_is_mobile()){ ?>
			<div id="loopad" class="container banner">
			<?php echo ot_get_option('cmswithsidebar_loop_ad'); ?>
			</div>
			<?php }else{ ?>
			<div id="loopad" class="mobile-ad">
			<?php echo ot_get_option('singlead1_mobile'); ?>
			</div>
			<?php }?>
			<?php }?>
			<?php endwhile;?>
		</div>
			<!-- pagination -->
			<div class="clear"></div>
			<div class="pagination">
			<?php pagenavi(); ?>
			</div>
			<!-- /.pagination -->
			<?php endif;?>
	</div>
	<?php wp_reset_query(); ?>
	<?php get_sidebar();?>
</div>
<div class="clear"></div>