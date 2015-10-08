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

define ('THEME_NAME',	"Change" );
define ('THEME_FOLDER',	"change" );
define ('THEME_VER', 	"1.0.1");

/** 
 * File Security Check 
 * demo:D:\AppServ/
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** 
 * Sets the path to the parent theme directory. 
 * demo:D:\AppServ/wp-content/themes/xiapi
 */
if ( !defined( 'THEME_DIR' ) ) {
	define( 'THEME_DIR', get_template_directory() );
}

/** 
 * Sets the path to the parent theme directory URI. 
 * demo:http://localhost/wp-content/themes/xiapi
 */
if ( !defined( 'THEME_URI' ) ) {
	define( 'THEME_URI', get_template_directory_uri() );
}

/**
 * Sets the path to the theme framework directory
 * demo:D:\AppServ/wp-content/themes/xiapi/framework
 */
if (!defined('THEME_FRA_DIR') ) {
	define('THEME_FRA_DIR', THEME_DIR . '/framework');
}

/** 
 * Sets the path to the parent theme directory URI. 
 * demo:http://localhost/wp-content/themes/xiapi/framework
 */
if ( !defined( 'THEME_FRA_URL' ) ) {
	define( 'THEME_FRA_URL', get_template_directory_uri() . '/framework' );
}


/**
 * OptionTree framework integration: Use in theme mode
 */
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_settings_import', '__return_true' );
add_filter( 'ot_show_settings_export', '__return_true' );
add_filter( 'ot_show_docs', '__return_false' );
load_template( THEME_FRA_DIR . '/admin/option-tree/ot-loader.php' );


/**
 * 
 * 移除头部多余信息
 */
function wpbeginner_remove_version(){
	return;
}
add_filter('the_generator', 'wpbeginner_remove_version');//wordpress的版本号
remove_action('wp_head', 'feed_links', 2);//包含文章和评论的feed
remove_action('wp_head','index_rel_link');//当前文章的索引
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页
remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇 
remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
remove_action('wp_head', 'rel_canonical' );


/**
 * 
 * Load theme files
 * @param string $local
 */
function fun_theme_localized($local){
	if(ot_get_option('lan_en')=='on'){
		$local = 'en_US';
	}else{
		$local = 'zh_CN';
	}
	return $local;
}
add_filter('locale','fun_theme_localized');

if ( ! function_exists( 'fun_load' ) ) {
	function fun_load() {
		// Load theme options
		load_template( THEME_FRA_DIR . '/admin/theme-options.php' );	
			
		// Load custom widgets
		load_template( THEME_FRA_DIR . '/widgets.php' );
		
		// Load functions
		load_template( THEME_FRA_DIR . '/functions/theme-functions.php' );
		load_template( THEME_FRA_DIR . '/functions/theme-customize.php' );
		load_template( THEME_FRA_DIR . '/functions/open-social.php' );
		load_template( THEME_FRA_DIR . '/functions/message.php' );
		load_template( THEME_FRA_DIR . '/functions/credit.php' );
		load_template( THEME_FRA_DIR . '/functions/recent-user.php' );
		load_template( THEME_FRA_DIR . '/functions/tracker.php' );
		load_template( THEME_FRA_DIR . '/functions/user-page.php' );
		load_template( THEME_FRA_DIR . '/functions/meta.php' );
		load_template( THEME_FRA_DIR . '/functions/comment.php' );
		load_template( THEME_FRA_DIR . '/functions/shortcode.php' );
		load_template( THEME_FRA_DIR . '/functions/IP.php' );
		load_template( THEME_FRA_DIR . '/functions/mail.php' );
		load_template( THEME_FRA_DIR . '/functions/meta-box.php' );
		load_template( THEME_FRA_DIR . '/functions/newsletter.php' );
		load_template( THEME_FRA_DIR . '/functions/ua.php' );
		load_template( THEME_FRA_DIR . '/functions/download.php' );
		load_template( THEME_FRA_DIR . '/functions/no_category_base.php' );
		load_template( THEME_FRA_DIR . '/functions/shop.php' );
		load_template( THEME_FRA_DIR . '/functions/membership.php' );
		load_template( THEME_FRA_DIR . '/functions/auto-save-image.php' );
		
		if (is_admin()) {
			require_once( THEME_FRA_DIR . '/functions/class-tgm-plugin-activation.php' );
		}
		
		// Load language
		load_theme_textdomain('xiapistudio',THEME_DIR . '/languages');
		load_theme_textdomain( 'option-tree',THEME_FRA_DIR . '/admin/option-tree/languages');
		
		// 移除自动保存和修订版本 
		if(ot_get_option('wp_auto_save')=='on'){
			add_action('wp_print_scripts','fun_disable_autosave' );
			remove_action('post_updated','wp_save_post_revision' );
		}

		//建立Avatar上传文件夹
		fun_add_avatar_folder();
	}
}
add_action( 'after_setup_theme', 'fun_load' );


/**
 * 
 * 建立Avatar上传文件夹
 */
function fun_add_avatar_folder() {
    $upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/avatars';
    if (! is_dir($upload_dir)) {
       mkdir($upload_dir,0755);
    }
}

/**
 * 
 * 移除自动保存
 */
function fun_disable_autosave() {
  wp_deregister_script('autosave');
}

