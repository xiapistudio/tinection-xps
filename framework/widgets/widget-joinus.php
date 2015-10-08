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

add_action( 'widgets_init', 'joinus_widget_box' );
function joinus_widget_box() {
	register_widget( 'joinus_widget' );
}
class joinus_widget extends WP_Widget {
	
	function joinus_widget() {
		$widget_ops = array( 
			'classname' => 'joinus_widget',
			'description' => '站点说明&加入本站',
		);
		$this->WP_Widget( 'joinus_widget',THEME_NAME .' - '.__( '加入本站' , 'xiapistudio'), $widget_ops);
	}

	function widget($args,$instance){
		extract($args);
	?>
		<?php echo $before_widget; ?>
        <?php if($instance['title'])echo $before_title.$instance['title']. $after_title; ?>
		<div class="joinus">如果您有不错的资源想发布至本站，您可以
		<?php if(is_user_logged_in()){ ?>
			<a href="<?php echo fun_get_user_url('post').'&action=new'; ?>" target="_blank" title="投稿">点击投稿</a>
		<?php }else{ ?>
			<a href="#" class="user-login" title="登录后投稿">点击投稿</a>
		<?php } ?>。我们强烈推荐您注册本站账户或通过QQ、新浪微博登陆本站，使用投稿功能，畅享丰富资源以及积分服务。
		</div>
		<h3><span>站务合作</span></h3>
		<div class="sitecooperate">如果您有站务合作方面的需求，请通过以下方式联系我。<br>QQ: <?php echo ot_get_option('tin_qq'); ?><br>Email: <?php $email = get_option('admin_email'); echo str_replace('@','#',$email)?>(#换成@)</div>
		<?php echo $after_widget; ?>

	<?php }

	function update($new_instance,$old_instance){
		return $new_instance;
	}

	function form($instance){
		$title = esc_attr($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','tinection'); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
	<?php
	}
}
