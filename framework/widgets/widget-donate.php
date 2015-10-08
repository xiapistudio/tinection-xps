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

add_action( 'widgets_init', 'donate_widget_box' );
function donate_widget_box() {
	register_widget( 'donate_widget' );
}
class donate_widget extends WP_Widget {
	
	function donate_widget() {
		$widget_ops = array( 
			'classname' => 'donate_widget',
			'description' => '支付宝赞助收款',
		);
		$this->WP_Widget( 'donate_widget',THEME_NAME .' - '.__( '赞助站长' , 'xiapistudio'), $widget_ops);
	}

	function widget($args,$instance){
		extract($args);
	?>
		<?php echo $before_widget; ?>
        <?php if($instance['title'])echo $before_title.$instance['title']. $after_title; ?>
		<div class="donate"><?php $alipay_qr = ot_get_option('alipay_qr'); if(!empty($alipay_qr)){ ?><img src="<?php echo $alipay_qr; ?>" title="赞助站长" alt="赞助站长" /><?php } ?><?php echo fun_alipay_post_gather('',1,0); ?></div>
		<?php echo $after_widget; ?>

	<?php }

	function update($new_instance,$old_instance){
		return $new_instance;
	}

	function form($instance){
		$title = esc_attr($instance['title']);
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('标题：','xiapistudio'); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
	<?php
	}
}
