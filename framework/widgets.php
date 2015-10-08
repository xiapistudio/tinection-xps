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

load_template( THEME_FRA_DIR . '/widgets/widget-tabs.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-posts.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-posts-h.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-tagcloud.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-enhanced-text.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-readerwall.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-mailcontact.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-site.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-float-widget.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-bookmark.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-bookmark-h.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-subscribe.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-aboutsite.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-joinus.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-hotsearch.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-creditsrank.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-ucenter.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-donate.php' );
load_template( THEME_FRA_DIR . '/widgets/widget-slider.php' );

/**
 * 注册通用边栏
 */
if ( !function_exists( 'fun_custom_sidebars' ) ) {

	function fun_custom_sidebars() {
		if ( !ot_get_option('sidebar-areas') =='' ) {
			
			$sidebars = ot_get_option('sidebar-areas', array());
			
			if ( !empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					if ( isset($sidebar['title']) 
						&& !empty($sidebar['title']) 
						&& isset($sidebar['id']) 
						&& !empty($sidebar['id']) 
						&& ($sidebar['id'] !='sidebar-') ) {
						
						$data = array(
							'name' => ''.$sidebar['title'].'',
							'id' => ''.strtolower($sidebar['id']).'',
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<h3><span class=widget-title>',
							'after_title' => '</span></h3>'
						);

						register_sidebar($data);
					}
				}
			}
		}
	}
	
}
add_action( 'widgets_init', 'fun_custom_sidebars' );


/**
 * 动态primary边栏
 */
if ( ! function_exists( 'fun_sidebar_primary' ) ) {

	function fun_sidebar_primary() {
		// Default sidebar
		$sidebar = 'primary';

		// Set sidebar based on page
		if ( is_home() && ot_get_option('s1-home') ) $sidebar = ot_get_option('s1-home');
		if ( is_single() && ot_get_option('s1-single') ) $sidebar = ot_get_option('s1-single');
		if ( is_archive() && ot_get_option('s1-archive') ) $sidebar = ot_get_option('s1-archive');
		if ( is_category() && ot_get_option('s1-archive-category') ) $sidebar = ot_get_option('s1-archive-category');
		if ( is_search() && ot_get_option('s1-search') ) $sidebar = ot_get_option('s1-search');
		if ( is_404() && ot_get_option('s1-404') ) $sidebar = ot_get_option('s1-404');
		if ( is_page() && ot_get_option('s1-page') ) $sidebar = ot_get_option('s1-page');

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'fun_sidebar_primary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}
	
}


/**
 * 注册页脚边栏
 */
if ( ! function_exists( 'fun_sidebars' ) ) {
	
	function fun_sidebars() {
		//Primary
		$data = array( 
			'name' => 'Primary',
			'id' => 'primary',
			'description' => __("默认边栏区，请在后台设置选择各页面的边栏",'xiapistudio'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3><span class=widget-title>',
			'after_title' => '</span></h3>'
		);
		register_sidebar($data);
		
		//Float
		$data = array(
			'name' => 'Float',
			'id' => 'float',
			'description' => __("浮动边栏，容纳一定小工具，随鼠标滚动超出可视区域后将浮动重新显示",'xiapistudio'),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3><span class=widget-title>',
			'after_title' => '</span></h3>'
		);
		register_sidebar($data);
		
		//Footer 1
		if ( ot_get_option('footer-widgets') >= '1' ) {
			$data =  array( 
				'name' => 'Footer 1',
				'id' => 'footer-1', 
				'description' => __("底部多列边栏1",'xiapistudio'), 
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3><span class=widget-title>',
				'after_title' => '</span></h3>'
			);
			register_sidebar($data); 
		}
		
		//Footer 2
		if ( ot_get_option('footer-widgets') >= '2' ) { 
			$data = array( 
				'name' => 'Footer 2',
				'id' => 'footer-2',
				'description' => __("底部多列边栏2",'xiapistudio'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3><span class=widget-title>',
				'after_title' => '</span></h3>'
			);
			register_sidebar($data); 
		}
		
		//Footer 3
		if ( ot_get_option('footer-widgets') >= '3' ) { 
			$data = array( 
				'name' => 'Footer 3',
				'id' => 'footer-3', 
				'description' => __("底部多列边栏3",'xiapistudio'), 
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3><span class=widget-title>',
				'after_title' => '</span></h3>'
			);
			register_sidebar($data); 
		}
		
		//Footer 4
		if ( ot_get_option('footer-widgets') >= '4' ) {
			$data =  array( 
				'name' => 'Footer 4',
				'id' => 'footer-4', 
				'description' => __("底部多列边栏4",'xiapistudio'), 
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3><span class=widget-title>',
				'after_title' => '</span></h3>'
			);
			register_sidebar($data); 
		}
		
		//Footer row
		if ( ot_get_option('footer-widgets-singlerow') == 'on' ) { 
			$data = array( 
				'name' => 'Footer row',
				'id' => 'footer-row', 
				'description' => __("底部通栏",'xiapistudio'), 
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3><span class=widget-title>',
				'after_title' => '</span></h3>'
			);
			register_sidebar($data); 
		}
	}
	
}
add_action( 'widgets_init', 'fun_sidebars' );