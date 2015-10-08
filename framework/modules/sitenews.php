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
<?php $sitenews=ot_get_option('sitenews');if (!empty($sitenews)) { ?>
<div class="contextual bg-sitenews">
	<i class="fa fa-volume-up" style=""></i>
	<div id="news-scroll-zone">
		<div class="news-scroll-list">
			<?php $sitenews = explode(PHP_EOL,$sitenews);foreach ($sitenews as $sitenew) {echo '<li class="sitenews-list">'.$sitenew.'</li>';} ?>
		</div>
	</div>
	<span class="infobg-close" style="color:#aaa;"><i class="fa fa-close"></i></span>
</div>
<?php } ?>