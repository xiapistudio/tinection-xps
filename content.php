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
<?php get_template_part('framework/modules/thumbnail'); ?>
<?php if(!is_search()): ?>
<div class="home-blog-entry-text clr">
<h3>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
</h3>
<!-- Post meta -->
<?php fun_post_meta(); ?>
<!-- /.Post meta -->
<p>
<?php if(ot_get_option('content_or_excerpt')=='content'){the_content();}
	else{$contents = get_the_excerpt(); $excerpt = wp_trim_words($contents,ot_get_option('excerpt-length'),''); echo $excerpt.' '.new_excerpt_more('...');}
?>
</p>
</div>
<?php endif; ?>