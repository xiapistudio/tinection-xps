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

<div class="breadcrumbs">
	<div class="container clr">
		<!--div class="header-search">
			<form method="get" id="searchform" class="searchform" action="<?php bloginfo('url');?>" role="search">
				<input type="search" class="field" name="s" value="" id="s" placeholder="Search" required></input>
				<button type="submit" class="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
			</form>
		</div-->

<?php $format = get_post_format(); ?>
<?php if(is_home() || is_front_page()):?>
	<div id="breadcrumbs"><h1><?php _e('博客','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><?php bloginfo('description'); ?></div>
<?php elseif ( is_search() ): ?>
	<div id="breadcrumbs"><h1>
		<?php if ( have_posts() && !empty($_GET['s'])): ?><i class="fa fa-search"></i><?php _e(' 网站搜索','xiapistudio'); ?><?php endif; ?>
		<?php if ( !have_posts() || empty($_GET['s'])): ?><i class="fa fa-exclamation-circle"></i><?php _e(' 网站搜索','xiapistudio'); ?><?php endif; ?>
	</h1>
	<div class="breadcrumbs-text">
		<?php $search_count = 0; if(!empty($_GET['s'])&&$_GET['s']!='.'):$search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; endif; echo $search_count;?><?php _e(' 个搜索结果...','xiapistudio'); ?>
	</div>
<?php elseif ( is_404() ): ?>
	<div id="breadcrumbs"><h1><?php _e('404错误','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><?php _e('糟糕，页面未找到','xiapistudio'); ?></div>	
<?php elseif ( is_author() ): ?>
	<?php $author = get_userdata( get_query_var('author') );?>
	<div id="breadcrumbs"><h1><i class="fa fa-user"></i><?php _e(' 用户中心','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><?php echo $author->display_name.' '.fun_author_page_title();?></div>
<?php elseif ( is_category() ): ?>
	<div id="breadcrumbs"><h1><i class="fa fa-folder-open"></i><?php _e(' 分类文章','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><a href="<?php bloginfo('url');?>" title="<?php bloginfo('description');?>"><?php _e('主页','xiapistudio'); ?></a>&nbsp;»&nbsp;<?php echo single_cat_title('', false); ?><?php if ((category_description() != '') && !is_paged()) : ?><?php echo " - ".strip_tags(category_description()); ?><?php endif; ?></div>
<?php elseif ( is_tag() ): ?>
	<div id="breadcrumbs"><h1><i class="fa fa-tags"></i><?php _e(' 标签','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><?php echo single_tag_title('', false); ?></div>
<?php elseif ( is_day() ): ?>
	<div id="breadcrumbs"><h1><i class="fa fa-calendar"></i><?php _e(' 日归档','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><?php echo get_the_time(__('Y年m月j日','xiapistudio')); ?><?php _e(' 的文章归档','xiapistudio'); ?></div>
<?php elseif ( is_month() ): ?>
	<div id="breadcrumbs"><h1><i class="fa fa-calendar"></i><?php _e(' 月归档','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><?php echo get_the_time(__('Y年m月','xiapistudio')); ?><?php _e(' 的文章归档','xiapistudio'); ?></div>	
<?php elseif ( is_year() ): ?>
	<div id="breadcrumbs"><h1><i class="fa fa-calendar"></i><?php _e(' 年归档','xiapistudio'); ?></h1>
	<div class="breadcrumbs-text"><?php echo get_the_time(__('Y年','xiapistudio')); ?><?php _e(' 的文章归档','xiapistudio'); ?></div>
<?php elseif ( is_attachment() ): ?>
	<div id="breadcrumbs"><h1><i class="fa fa-folder"></i><?php _e('附件','xiapistudio'); ?>&nbsp;</h1>
	<div class="breadcrumbs-text"><a href="<?php bloginfo('url');?>" title="<?php bloginfo('description');?>"><?php _e('主页','xiapistudio'); ?></a>&nbsp;»&nbsp;<?php _e('附件','xiapistudio'); ?>&nbsp;»&nbsp;<?php the_title(); ?></div>
<?php elseif ( is_single()): ?>
	<div id="breadcrumbs"><h1>
	<?php if ( has_post_format('audio') ): ?><i class="fa fa-headphones"></i><?php endif; ?>
	<?php if ( has_post_format('aside') ): ?><i class="fa fa-pen"></i><?php endif; ?>
	<?php if ( has_post_format('chat') ): ?><i class="fa fa-comments-o"></i><?php endif; ?>
	<?php if ( has_post_format('gallery') ): ?><i class="fa fa-picture-o"></i><?php endif; ?>
	<?php if ( has_post_format('image') ): ?><i class="fa fa-camera"></i><?php endif; ?>
	<?php if ( has_post_format('link') ): ?><i class="fa fa-link"></i><?php endif; ?>
	<?php if ( has_post_format('quote') ): ?><i class="fa fa-quote-left"></i><?php endif; ?>
	<?php if ( has_post_format('status') ): ?><i class="fa fa-bullhorn"></i><?php endif; ?>
	<?php if ( has_post_format('video') ): ?><i class="fa fa-video-camera"></i><?php endif; ?><?php the_title(); ?></h1>
	<div class="breadcrumbs-text"><a href="<?php bloginfo('url');?>" title="<?php bloginfo('description');?>"><?php _e('主页','xiapistudio'); ?></a>&nbsp;»&nbsp;<?php the_category(' | ',''); ?>&nbsp;»&nbsp;<?php the_title(); ?></div>
<?php elseif ( is_page()): ?>
	<div id="breadcrumbs"><h1><i class="fa fa-bookmark"></i>&nbsp;<?php the_title(); ?></h1>
	<div class="breadcrumbs-text"><a href="<?php bloginfo('url');?>" title="<?php bloginfo('description');?>"><?php _e('主页','xiapistudio'); ?></a>&nbsp;»&nbsp;<?php _e('页面','xiapistudio'); ?>&nbsp;»&nbsp;<?php the_title(); ?></div>
<?php endif;?>
		</div>
	</div>
</div>