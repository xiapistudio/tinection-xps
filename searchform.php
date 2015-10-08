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
<form method="get" class="searchform themeform" action="<?php echo home_url('/'); ?>">
	<div>
		<input type="text" class="search" name="s" onblur="if(this.value=='')this.value='<?php _e('Search..','xiapistudio'); ?>';" onfocus="if(this.value=='<?php _e('Search..','xiapistudio'); ?>')this.value='';" value="<?php _e('Search..','xiapistudio'); ?>" maxlength="20" required="required" />
	</div>
</form>