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
<?php if ( is_home()||is_front_page() ) { ?><title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(__(' - 第 %s 页 ','xiapistudio'),$paged); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title><?php _e('搜索结果','xiapistudio'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php $page = get_query_var('page'); if ( $page > 1 ) printf(__('_第 %s 页 ','xiapistudio'),$page); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php if(isset($_GET['pid'])):echo '《'.get_the_title($_GET['pid']).'》- '.__('资源下载','xiapistudio'); else:echo trim(wp_title('',0)); endif; ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(__(' - 第 %s 页 ','xiapistudio'),$paged); ?></title><?php } ?>
<?php if ( is_year() ) { ?><title><?php the_time(__('Y年','xiapistudio')); ?><?php _e('日志归档','xiapistudio'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time(__('Y年n月','xiapistudio')); ?><?php _e('日志归档','xiapistudio'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_day() ) { ?><title><?php the_time(__('Y年n月j日','xiapistudio')); ?><?php _e('日志归档','xiapistudio'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php  single_tag_title("", true); ?> - <?php bloginfo('name'); ?><?php $paged = get_query_var('paged'); if ( $paged > 1 ) printf(__(' - 第 %s 页 ','xiapistudio'),$paged); ?></title><?php } ?><?php } ?>
<?php if ( is_author() ) {?><title><?php wp_title('');?><?php echo fun_author_page_title(); ?> - <?php bloginfo('name'); ?></title><?php }?>
<?php if ( is_404() ) {?><title><?php wp_title('');?> - <?php bloginfo('name'); ?></title><?php }?>
<?php
if ( is_single() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
   if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
    $post_content = $result['1'];
   } else {
    $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
    $post_content = $post_content_r['0'];
   }
         $description = utf8Substr($post_content,0,220);  
  } 
    $keywords = "";     
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}
if(is_page()&&isset($_GET['pid'])){
	$pid=$_GET['pid'];
	if(get_post_field('post_excerpt',$pid)){$description=get_post_field('post_excerpt',$pid);}else{
		if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags(get_post_field('post_content',$pid),"<p>")),$result)){
			$post_content = $result['1'];
		} else {
			$post_content_r = explode("\n",trim(strip_tags(get_post_field('post_content',$pid))));
			$post_content = $post_content_r['0'];
		}
         $description = utf8Substr($post_content,0,220);
	}
	$keywords = "";     
    $tags = wp_get_post_tags($pid);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}

if (is_page()&&!isset($_GET['pid'])) {
	$description = get_post_meta($post->ID, "description", true);   
	$keywords = get_post_meta($post->ID, "keywords", true);   	
} 
?>
<?php if(function_exists('store_seo_info')) echo store_seo_info(); ?>
<?php echo "\n"; ?>
<?php if ( is_single() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_home()||is_front_page() ) { ?>
<meta name="description" content="<?php echo ot_get_option('tin_description'); ?>" />
<meta name="keywords" content="<?php echo ot_get_option('tin_keywords'); ?>" />
<?php } ?>
<?php if ( is_category() ) { ?>
<meta name="description" content="<?php echo strip_tags(category_description($cat_ID)); ?>" />
<meta name="keywords" content="<?php echo get_option('tin_keywords'); ?>" />
<?php } ?>
<?php if ( is_page()&&!is_front_page() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_tag() ) { ?>
<meta name="description" content="<?php echo sprintf(__('%1$s上关于%2$s的所有日志聚合','xiapistudio'),get_bloginfo('name'),single_tag_title()); ?>" />
<?php } ?>
<?php if ( is_year() ) { ?>
<meta name="description" content="<?php echo sprintf(__('%1$s上%2$s发布的所有日志聚合','xiapistudio'),get_bloginfo('name'),the_time(__('Y年','xiapistudio'))); ?>" />
<?php } ?>
<?php if ( is_month() ) { ?>
<meta name="description" content="<?php echo sprintf(__('%1$s上%2$s份发布的所有日志聚合','xiapistudio'),get_bloginfo('name'),the_time(__('Y年n月','xiapistudio'))); ?>" />
<?php } ?>
<?php if ( is_day() ) { ?>
<meta name="description" content="<?php echo sprintf(__('%1$s上%2$s发布的所有日志聚合','xiapistudio'),get_bloginfo('name'),the_time(__('Y年n月j日','xiapistudio'))); ?>" />
<?php } ?>