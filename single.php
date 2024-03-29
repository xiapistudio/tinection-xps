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
<div id="header-banner" class="banner">
	<div class="container">
		<?php echo ot_get_option('headerad');?>
	</div>
</div>
<?php }?>
<!-- /.Header Banner -->
<!-- Main Wrap -->
<div id="main-wrap">
	<div id="sitenews-wrap" class="container"><?php get_template_part('framework/modules/sitenews'); ?></div>
	<div id="single-blog-wrap" class="container two-col-container">
		<div id="main-wrap-left">
		<!-- Content -->
		<div class="content">
		<?php while ( have_posts() ) : the_post(); ?>
		<!-- Post meta -->
		<?php fun_post_meta(); ?>
		<!-- /.Post meta -->
		<!-- Rating plugin -->
		<?php get_template_part('framework/modules/rating'); ?>
		<!-- /.Rating plugin -->
		<!-- Single article intro -->
		<?php $intro = get_post_field('post_excerpt',$post->ID); if(!empty($intro)){ ?>
			<div class="single-intro contextual">
			<span><?php _e('导语：','xiapistudio'); ?></span><?php echo $intro; ?>
			</div>
		<?php } ?>
		<!-- /.Single article intro -->
		<!-- Top ad -->
		<?php if(!fun_is_mobile()){ ?>
			<div id="singletop-banner" class="banner">
			<?php echo ot_get_option('singletopad');?>
			</div>
		<?php }else{ ?>
			<div id="loopad" class="mobile-ad">
			<?php echo ot_get_option('singlead1_mobile'); ?>
			</div>
		<?php }?>
		<!-- /.Top ad -->
		<div class="single-thumb">
			<?php if(has_post_thumbnail()&&ot_get_option('show-single-thumb')=='on'){ 
				$url = get_post_meta( $post->ID, 'tin_thumb_url', true );
				$url = explode('|',$url);
				$link = isset($url[0]) ? $url[0]:'';
				$title = isset($url[1]) ? $url[1]:'';
			?><a href="<?php echo $link; ?>" title="<?php echo $title; ?>" target="_blank"><?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); $url = $large_image_url[0]; $url = tin_thumb_source($url,800,300); ?><img src="<?php echo $url; ?>" /></a>
			<div id="singlethumb-banner"><?php echo ot_get_option('singlethumbad'); ?></div>
			<?php } ?>
		</div>
		<div class="single-text">
		<?php the_content(); ?>
		<?php get_template_part('framework/modules/download'); ?>
		<!-- Page links -->
		<?php
			wp_link_pages('before=<div id="article-page-links">&after=</div>&next_or_number=number');
		?>
		<!-- /.Page links -->
		</div>
		<?php the_tags('<div class="sg-tag"><i class="fa fa-tag"></i>&nbsp;&nbsp;',' ','</div>'); ?>
		<!-- Single Copyright -->
		<?php fun_post_copyright($post->ID); ?>
		<!-- /.Single Copyright -->
		<!-- Bottom ad -->
		<?php if(!fun_is_mobile()){ ?>
			<div id="singlebottom-banner" class="banner">
			<?php echo ot_get_option('singlebottomad');?>
			</div>
		<?php }else{ ?>
			<div id="loopad" class="mobile-ad">
			<?php echo ot_get_option('singlead2_mobile'); ?>
			</div>
		<?php }?>
		<!-- /.Bottom ad -->
		<!-- Single Activity -->
		<div class="sg-act">
			<?php get_template_part('framework/modules/like_collect'); ?>
			<?php get_template_part('framework/modules/bdshare'); ?>
		</div>
		<!-- /.Single Activity -->
		<!-- Single Author Info -->
		<?php get_template_part('framework/modules/author-info'); ?>
		<!-- /.Single Author Info -->
		<!-- Related Articles -->
		<?php get_template_part('framework/modules/related'); ?>		
		<!-- /.Related Articles -->				
		<!-- Prev or Next Article -->
		<div class="navigation">
			<div class="navigation-left">
				<span><?php _e('上一篇','xiapistudio'); ?></span>
				<?php previous_post_link('%link'); echo"<a>&nbsp;</a>"; ?>
			</div>
			<div class="navigation-right">
				<span><?php _e('下一篇','xiapistudio'); ?></span>
				<?php echo"<a>&nbsp;</a>"; next_post_link('%link'); ?>
			</div>
		</div>
		<!-- /.Prev or Next Article -->
		
		<!-- Comments ad1 -->
		<?php if(!fun_is_mobile()){ ?>
			<div id="cmnt-banner1" class="banner">
			<?php echo ot_get_option('cmntad1');?>
			</div>
		<?php }else{ ?>
			<div id="loopad" class="mobile-ad">
			<?php echo ot_get_option('singlead1_mobile'); ?>
			</div>
		<?php }?>
		<!-- /.Comments ad1 -->

		</div>
		<!-- /.Content -->		
		<!-- Comments -->
		<?php if (comments_open()) comments_template( '', true ); ?>
		<!-- /.Comments -->
		<?php endwhile; ?>
		</div>
		<!-- Sidebar -->
			<?php get_sidebar(); ?>
		<!-- /.Sidebar -->
	</div>
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
<div style="height:10px;"></div>
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