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

// 启动主题时清理固定链接缓存
function fun_rewrite_flush_rules(){
	global $pagenow,$wp_rewrite;   
	if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){
		$wp_rewrite->flush_rules();
	}
}
add_action( 'load-themes.php', 'fun_rewrite_flush_rules' ); 

// 资料卡URL
function fun_get_user_url( $type='', $user_id=0 ){
	$user_id = intval($user_id);
	if( $user_id==0 ){
		$user_id = get_current_user_id();
	}
	$url = add_query_arg( 'tab', $type, get_author_posts_url($user_id) );
	return $url;
}

//~ 用户页资料页拒绝搜索引擎索引
function fun_author_tab_no_robots(){
	if( is_author() && isset($_GET['tab']) ) wp_no_robots();
}
add_action('wp_head', 'fun_author_tab_no_robots');

//~ 更改编辑个人资料链接
function fun_profile_page( $url ) {
    return is_admin() ? $url : fun_get_user_url('profile');
}
add_filter( 'edit_profile_url', 'fun_profile_page' );

//~ 拒绝普通用户访问后台
function fun_redirect_wp_admin(){
	if( is_admin() && is_user_logged_in() && !current_user_can('edit_users') && ( !defined('DOING_AJAX') || !DOING_AJAX )  ){
		wp_redirect( fun_get_user_url('profile') );
		exit;
	}
}
add_action( 'init', 'fun_redirect_wp_admin' );

//~ 普通用户编辑链接改为前台
function fun_edit_post_link($url, $post_id){
	if( !current_user_can('edit_users') ){
		$url = add_query_arg(array('action'=>'edit', 'id'=>$post_id), fun_get_user_url('post'));
	}
	return $url;
}
add_filter('get_edit_post_link', 'fun_edit_post_link', 10, 2);

//~ 登陆页LOGO及动态背景
function fun_login_logo_bg(){
	$custom_login_logo = ot_get_option('custom-login-logo');
	$default_login_logo = get_bloginfo('template_directory').'/images/wordpress-logo.png';
	$str=@file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1');
 	if(preg_match("/<url>(.+?)<\/url>/ies",$str,$matches)){
  		$imgurl='http://cn.bing.com'.$matches[1];
 	}
	if( !empty($custom_login_logo) ){
		$css = sprintf('background-image:url(%1$s);-webkit-background-size:85px 85px;background-size:85px 85px;width:85px;height:85px;', $custom_login_logo);
	}else{
		$css = sprintf('background-image:url(%1$s);-webkit-background-size:85px 85px;background-size:85px 85px;width:85px;height:85px;', $default_login_logo);;
	}
	?>
	<?php echo '<link rel="stylesheet" href="' . get_bloginfo( 'template_directory' ) . '/includes/css/login.css" type="text/css" media="all" />' . "\n"; ?>
    <style type="text/css">
        body.login div#login h1 a{
			<?php echo $css;?>
		}
		<?php if($imgurl){ ?>
		@media screen and (min-width: 960px){
			body.login{
				background: url( <?php echo $imgurl; ?> );
				background-size: cover;
			}
		}
		<?php } ?>
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'fun_login_logo_bg' );

function fun_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'fun_login_logo_url' );

function fun_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'fun_login_logo_url_title' );

//~ 在后台用户列表中显示昵称
function fun_display_name_column( $columns ) {
	$columns['fun_display_name'] = '显示名称';
	unset($columns['name']);
	return $columns;
}
add_filter( 'manage_users_columns', 'fun_display_name_column' );
 
function fun_display_name_column_callback( $value, $column_name, $user_id ) {

	if( 'fun_display_name' == $column_name ){
		$user = get_user_by( 'id', $user_id );
		$value = ( $user->display_name ) ? $user->display_name : '';
	}

	return $value;
}
add_action( 'manage_users_custom_column', 'fun_display_name_column_callback', 10, 3 );

//~ 侧边栏用户中心小工具
function fun_user_profile_widget(){
	
	if(is_user_logged_in()):
	$current_user = wp_get_current_user();	
	$li_output = '';
	$li_output .= '<li style="line-height:36px;clear: both;">'.fun_get_avatar( $current_user->ID , '36' , fun_get_avatar_type($current_user->ID), false ) .
		sprintf(__('登录者 <a href="%1$s">%2$s</a>','tinection'), get_edit_profile_url($current_user->ID), $current_user->display_name) . 
		'<a href="'.wp_logout_url(fun_get_current_page_url()).'" title="'.esc_attr__('登出本帐号').'">' .
		__('登出 &raquo;') . 
		'</a></li>';

	if(!filter_var($current_user->user_email, FILTER_VALIDATE_EMAIL)){
		
		$li_output .= '<li><a href="'.fun_get_user_url('profile').'#pass">'.__('【重要】请添加正确的邮箱以保证账户安全','tinection').'</a></li>';
		
	}

	$shorcut_links[] = array(
		'title' => __('个人主页','tinection'),
		'url' => get_author_posts_url($current_user->ID)
	);
	
	if( current_user_can( 'manage_options' ) ) {
		$shorcut_links[] = array(
			'title' => __('管理后台','tinection'),
			'url' => admin_url()
		);
	}
	
	$can_post_cat = ot_get_option('fun_can_post_cat');
	if( count($can_post_cat) ) {
		$shorcut_links[] = array(
			'title' => __('文章投稿','tinection'),
			'url' => add_query_arg('action','new',fun_get_user_url('post'))
		);
	}
	
	$shorcut_html = '<li class="active">';
	foreach( $shorcut_links as $shorcut ){
		 $shorcut_html .= '<a href="'.$shorcut['url'].'">'.$shorcut['title'].' &raquo;</a>';
	}
	 $shorcut_html .= '</li>';

	$credit = intval(get_user_meta( $current_user->ID, 'fun_credit', true ));
	$credit_void = intval(get_user_meta( $current_user->ID, 'fun_credit_void', true ));
	$unread_count = intval(get_fun_message($current_user->ID, 'count', "( msg_type='unread' OR msg_type='unrepm' )"));
	$collects = get_user_meta($current_user->ID,'fun_collect',true)?get_user_meta($current_user->ID,'fun_collect',true):0;
	$collects_array = explode(',',$collects);
	$collects_count = $collects!=0?count($collects_array):0;
	
	$info_array = array(
		array(
			'title' => __('文章','tinection'),
			'url' => fun_get_user_url('post'),
			'count' => count_user_posts($current_user->ID)
		),
		array(
			'title' => __('评论','tinection'),
			'url' => fun_get_user_url('comment'),
			'count' => get_comments( array('status' => '1', 'user_id'=>$current_user->ID, 'count' => true) )
		),
		array(
			'title' => __('收藏','tinection'),
			'url' => fun_get_user_url('collect'),
			'count' => intval($collects_count)
		),
	);
		
	if($unread_count){
		$info_array[] = array(
				'title' => __('未读','tinection'),
				'url' => fun_get_user_url('message'),
				'count' => $unread_count
			);
	}
	
	$info_array[] = array(
			'title' => __('积分','tinection'),
			'url' => fun_get_user_url('credit'),
			'count' => ($credit)
		);
	
	$info_html = '<li>';
	
	foreach( $info_array as $info ){
		$info_html .= $info['title'].'<a href="'.$info['url'].'"> '.$info['count'].'</a>';
	}
	
	$info_html .= fun_whether_signed($current_user->ID);
	
	$info_html .= '</li>';
	
	$friend_html = '
	<li>
		<div class="input-group">
			<span class="input-group-addon">'.__('本页推广链接','tinection').'</span>
			<input class="fun_aff_url form-control" type="text" class="form-control" value="'.add_query_arg('aff',$current_user->ID,fun_canonical_url()).'">
		</div>
	</li>
	';

	return $li_output.$shorcut_html.$info_html.$friend_html;;
	
	else:
	
	$html = '<li><span class="local-account"><a data-sign="0" class="btn btn-primary user-login"><i class="fa fa-wordpress"></i>'.__('本地帐号','tinection').'</a></span>';
	if(ot_get_option('fun_open_qq')=='on') {
    $html .= '<span class="other-sign"><a class="qqlogin btn" href="'.home_url('/?connect=qq&action=login&redirect='.urlencode(fun_get_redirect_uri())).'"><i class="fa fa-qq"></i><span>'.__('QQ 登 录','tinection').'</span></a></span>';
	}
	if(ot_get_option('fun_open_weibo')=='on') {
	$html .= '<span class="other-sign"><a class="weibologin btn" href="'.home_url('/?connect=weibo&action=login&redirect='.urlencode(fun_get_redirect_uri())).'"><i class="fa fa-weibo"></i><span>'.__('微博登录','tinection').'</span></a></span>';
	}
	$html .= '</li>';
	
	return $html;
	endif;
}