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

if(!have_posts()){
	//如果没有文章，则显示未找到页面
	get_template_part( 'framework/modules/not-found' );
}else {
	global $loop_layout;
	
	//如果为空，获取对应的设置
	if(empty($loop_layout)){
		$loop_layout = fun_get_layout();
	}
	
	//根据设置，选择相应的模板
	switch($loop_layout){
		case 'cms':
			get_template_part( 'framework/loops/loop-cms' );
			break;
		case 'blocks':
			get_template_part( 'framework/loops/loop-blocks' );
			break;
		default:
			get_template_part( 'framework/loops/loop-blog' );
	}
}

?>