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
<script type="text/javascript">
	$('.site_loading').animate({'width':'55%'},50);  //第二个节点
</script>
<?php if(fun_is_mobile()) { ?>
<div id="sidebar" class="clr"></div>
<?php } else { ?>
<?php $sidebar = fun_sidebar_primary(); ?>
<div id="sidebar" class="clr">
<?php dynamic_sidebar($sidebar); ?>
<div class="floatwidget-container">
</div>
</div>
<?php } ?>
<script type="text/javascript">
	$('.site_loading').animate({'width':'78%'},50);  //第三个节点
</script>