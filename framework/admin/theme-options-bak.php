<?php

/***************************************

	Theme Name: 	Change
	Theme URI: 		http://www.xiapistudio/change
	Description: 	HTML5+CSS3响应式布局，适合不同分辨率的设备，自定义小工具，自动缩略图，ajax评论等功能。
	Version: 		1.0
	Author: 		虾皮
	Author URI: 	http://www.xiapistudio.com/
	License:     	GPLv3
	
***************************************/

/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'custom_theme_options' );

function custom_theme_options() {
	
	/**
	 * Get a copy of the saved settings array.
	 * ot_settings_id() --> option_tree_settings
	 */
	$saved_settings = get_option( ot_settings_id(), array() );
	$blogname = get_bloginfo('name');
	$blogurl = get_bloginfo('url');
	$categories = get_categories(); $cats_output='';foreach ($categories as $cat) {$cats_output .= $cat->cat_ID.' => '.$cat->cat_name.';<br>';}
	$posts = get_posts('numberposts=500&post_type=post&orderby=ID&order=DESC'); $posts_output='';foreach($posts as $post) {$posts_output .= $post->ID.' => '.$post->post_title.'&nbsp;&nbsp;(<span style="color:#1cbdc5">'.$post->post_date.'</span>);<br>';}
	$pages = get_posts('numberposts=50&post_type=page&orderby=ID&order=DESC'); $pages_output='';foreach($pages as $page) {$pages_output .= $page->ID.' => '.$page->post_title.'&nbsp;&nbsp;(<span style="color:#1cbdc5">'.$page->post_date.'</span>);<br>';}
	$products = get_posts('numberposts=100&post_type=store&orderby=ID&order=DESC'); $products_output='';foreach($products as $product) {$products_output .= $product->ID.' => '.$product->post_title.'&nbsp;&nbsp;(<span style="color:#1cbdc5">'.$product->post_date.'</span>);<br>';}
	$theme = wp_get_theme();
	$version = $theme->get('Version');

	
	//Admin Panel Sections
	$sections = array(
		array('id' => 'bases','title' => '基本设置'),
		array('id' => 'layout','title' => '页面布局'),
		array('id' => 'blogform','title' => '文章形式'),
		array('id' => 'webstyle','title' => '网站样式'),
		array('id' => 'adsposit','title' => '广告投放'),
		array('id' => 'advanced','title' => '高级设置'),
//		array('id' => 'mallplus','title' => '积分商城'),	//以后添加商城插件
	);
	
	//Admin Panel Settings
	$settings = array(
		// 基本设置: Favicon图标
        array(
            'id'        => 'favicon',
            'label'     => 'Favicon图标',
            'desc'      => '上传一个16x16像素大小的 Png/Gif 图像作为网站的图标',
            'type'      => 'upload',
            'section'   => 'bases',
        ),
        // 基本设置: 是否开启Logo图像
        array(
            'id'        => 'logo-status',
            'label'     => '网站Logo图像开关',
            'desc'      => '使用图像替代文本作为网站的Logo',
            'type'      => 'on-off',
            'section'   => 'bases',
	    	'std'       => 'off',
        ),
        // 基本设置: 自定义Logo图像
        array(
            'id'        => 'logo',
            'label'     => '网站Logo图像设置',
            'desc'      => '上传一个图像作为网站的Logo，推荐大小60x120(max)像素',
            'type'      => 'upload',
            'section'   => 'bases',
        ),
         // 基本设置: 登录页logo
        array(
            'id'        => 'custom-login-logo',
            'label'     => '登录页Logo图像设置',
            'desc'      => '留空则使用默认wordpress图标',
            'type'      => 'upload',
            'section'   => 'bases'
        ),
        // 基本设置: 首页布局
        array(
            'id'        => 'layout',
            'label'     => '首页布局选择',
            'desc'      => '首页CMS布局或Blog布局或Blocks块状布局',
            'type'      => 'radio',
			'std'		=> 'cms',
            'section'   => 'bases',
            'choices'   => array( 
        		array(
                	'value'     => 'cms',
                    'label'     => 'CMS',
                    ),
                array(
                    'value'     => 'blog',
                    'label'     => 'BLOG',
                    ),
				array(
                    'value'     => 'blocks',
                    'label'     => 'BLOCKS',
                    ),
             )
        ),
        // 基本设置: 背景颜色
        array(
            'id'        => 'bkgdcolor',
            'label'     => '网页背景颜色设置',
            'desc'      => '网页背景颜色',
            'type'      => 'colorpicker',
            'std'       => '#fff',//#f1f4f9
            'section'   => 'bases'
        ),
        // 基本设置: 背景图片效果
        array(
            'id'        => 'bkgdimgeffect',
            'label'     => '网页背景图像开关',
            'desc'      => '是否开启网页背景图像像素化效果',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'bases'
        ),
        // 基本设置: 背景图片
        array(
            'id'        => 'bkgdimg',
            'label'     => '网页背景图像设置',
            'desc'      => '网页背景图像，会覆盖背景色',
            'type'      => 'upload',
            'section'   => 'bases'
        ),
        // 基本设置: 背景图片样式
        array(
            'id'        => 'bkgdimg_style',
            'label'     => '背景图片样式选择',
            'desc'      => '背景图片样式,对小图片选择重复，对大图片请选择平铺覆盖背景',
            'type'      => 'select',
            'std'       => 'cover',
            'section'   => 'bases',
            'choices'   => array( 
                array(
                    'value'     => 'cover',
                    'label'     => '覆盖',
                ),
                array(
                    'value'     => 'repeat',
                    'label'     => '重复',
                ),
           	)
        ),
        // 基本设置: 站点消息
        array(
            'id'        => 'sitenews',
            'label'     => '站点消息',
            'desc'      => '网站顶部显示站点自定义消息，一行一条消息',
            'type'      => 'textarea_simple',
            'rows'       => '5',
            'std'       => '',
            'section'   => 'bases'
        ),
        // 页面布局: 引入用户自定义代码
        array(
            'id'        => 'headercode',
            'label'     => 'Header中加载自定义代码',
            'desc'      => '在网页头部Header中加载用户自定义代码，可以是javascript或者css，包含完整代码外标签',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'layout'
        ),
        // 页面布局: 引入用户自定义代码
        array(
            'id'        => 'footercode',
            'label'     => 'Footer中加载自定义代码',
            'desc'      => '在网页底部Footer中加载用户自定义代码，可以是javascript或者css，包含完整代码外标签',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'layout'
        ),
        // 页面布局: 备案号
        array(
            'id'        => 'beian',
            'label'     => 'Footer中显示备案号',
            'desc'      => '在网页底部Footer中显示备案号',
            'type'      => 'text',
            'rows'      => '1',
            'std'       => '',
            'section'   => 'layout'
        ),
        // 页面布局: 统计代码
        array(
            'id'        => 'statisticcode',
            'label'     => 'Footer中加载统计代码',
            'desc'      => '在网页底部Footer中加载统计代码，推荐百度统计',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'layout'
        ),
        // 页面布局: 版权文字
        array(
            'id'        => 'copyright',
            'label'     => 'Copyright信息',
            'desc'      => '网站底部版权文字描述',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => 'All Rights Reserved',
            'section'   => 'layout'
        ),
        // 页面布局: 底部通栏Widget
        array(
            'id'        => 'footer-widgets-singlerow',
            'label'     => '底部通栏Widget',
            'desc'      => '网站底部单栏边栏工具,仅允许放置一个小工具,主要用于通栏友情链接小工具',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'layout'
        ),
        // 页面布局: Widget Columns
        array(
            'id'        => 'footer-widgets',
            'label'     => 'Footer边栏小工具列数',
            'desc'      => '请选择合适列数开启底部边栏<br /><i>推荐数量：3</i>',
            'std'       => '3',
            'type'      => 'radio-image',
            'section'   => 'layout',
            'class'     => '',
            'choices'   => array(
                array(
                    'value'     => '0',
                    'label'     => 'Disable',
                    'src'       => THEME_FRA_URL . '/admin/images/layout-off.png'
                ),
                array(
                    'value'     => '1',
                    'label'     => '1 Column',
                    'src'       => THEME_FRA_URL . '/admin/images/footer-widgets-1.png'
                ),
                array(
                    'value'     => '2',
                    'label'     => '2 Columns',
                    'src'       => THEME_FRA_URL . '/admin/images/footer-widgets-2.png'
                ),
                array(
                    'value'     => '3',
                    'label'     => '3 Columns',
                    'src'       => THEME_FRA_URL . '/admin/images/footer-widgets-3.png'
                ),
                array(
                    'value'     => '4',
                    'label'     => '4 Columns',
                    'src'       => THEME_FRA_URL . '/admin/images/footer-widgets-4.png'
                )
            )
        ),
        // 页面布局: 关于本站小工具内容
        array(
            'id'        => 'tin_aboutsite',
            'label'     => '关于本站小工具内容',
            'desc'      => '关于本站小工具内容',
            'type'      => 'textarea_simple',
            'std'       => '知言博客是由WordPress爱好者Zhiyan建立的一个WordPress以及WEB资源站，集WordPress教程、主题、插件以及众多前端素材、代码等其他内容于一体，本站汇集为WordPress以及前端开发提供帮助的前端网页特效、建站PSD模板、网页模板、开发教程等素材，相关内容均保证绿色安全、优质实用，是您建站学习好帮手。Zhiyan欢迎大家多多交流，期待共同学习进步。',
            'section'   => 'layout'
        ),
        // 文章形式: 中英文菜单
        array(
            'id'        => 'double_lan_menu',
            'label'     => '中英文菜单',
            'desc'      => '中英文菜单，开启此选项后请至后台菜单编辑界面，在各菜单导航标签属性内加入[span]菜单英文[/span]，例如>>首页<<菜单项，包含小图标和英文的导航标签内容应该为[i class="fa fa-home"]&nbsp;[/i]首页[span]Home[/span]，请更改[ ]为< >',
            'type'      => 'on-off',
			'std'		=> 'off',
            'section'   => 'blogform'
        ),
        // 文章形式: Timthumb.php缩略图裁剪
        array(
            'id'        => 'timthumb',
            'label'     => 'Timthumb.php缩略图裁剪',
            'desc'      => '采用Timthumb.php缩略图裁剪，使用教程见<a href="http://www.zhiyanblog.com/timthumb-php-wordpress-thumbnail.html" target="_blank">Timthumb.php教程</a>;',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'blogform'
        ),
        // 文章形式: CDN云存储缩略图后缀参数
        array(
            'id'        => 'cloudimgsuffix',
            'label'     => 'CDN云存储缩略图后缀参数',
            'desc'      => '如果你使用了CDN图片云存储并关闭Timthumb.php缩略图裁剪，那么推荐你填写该云存储图片裁剪参数,能够有效防止图片大小不均一导致排版错误,建议保持默认即可并推荐使用水煮鱼的七牛插件自动上传网站图片至云空间',
            'type'      => 'text',
            'std'       => '?imageView2/1/w/375/h/250/q/100',
            'section'   => 'blogform'
        ),
        // 文章形式: 图片延迟加载
        array(
            'id'        => 'lazy_load_img',
            'label'     => '图片延迟加载',
            'desc'      => '图片延迟加载,如果出现图片无法加载，请关闭此选项,此外延迟加载对SEO不利',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'blogform'
        ),
		// 文章形式: 文章页特色图
        array(
            'id'        => 'show-single-thumb',
            'label'     => '文章页特色图',
            'desc'      => '文章页上方是否显示特色图，若开启请保证添加独一无二的特色图片，以免与文章图片重复',
            'type'      => 'on-off',
            'std'       => 'on',
            'section'   => 'blogform'
        ),
        // 文章形式: 文章页版权信息
        array(
            'id'        => 'tin_copyright_content_default',
            'label'     => '文章页版权信息',
            'desc'      => '文章页版权信息，为默认值，如果作者投稿添加了版权信息，将会覆盖此默认值',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'section'   => 'blogform',
            'std'       => '<p>除特别注明外，本站所有文章均为<a href="{url}" title="{name}" target="_blank">{name}</a>原创，转载请注明出处来自<a href="{link}" title="{title}">{link}</a></p>',
        ),
        
        // 网站样式: 首页幻灯片
        array(
            'id'        => 'openslider',
            'label'     => '首页幻灯片',
            'desc'      => '是否开启首页幻灯轮播',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'webstyle'
        ),
		// 网站样式: 幻灯样式
        array(
            'id'        => 'slider_style',
            'label'     => '幻灯样式',
            'desc'      => '幻灯样式,非全宽模式下幻灯右侧加载最新文章动态',
            'type'      => 'select',
			'std'		=> 'no_full',
            'section'   => 'webstyle',
            'choices'   => array( 
                array(
                    'value'       => 'full',
                    'label'       => '全宽',
                ),
                array(
                    'value'       => 'no_full',
                    'label'       => '非全宽',
                ),
            )
        ),
        // 网站样式: 幻灯来源
        array(
            'id'        => 'homeslider',
            'label'     => '首页幻灯片列表',
            'desc'      => '首页幻灯片文章及图像来源，请输入需要呈现的文章ID，以英文逗号隔开并为每篇文章设置特色图片',
            'type'      => 'text',
            'section'   => 'webstyle'
        ),
        // 网站样式: 幻灯右侧补充文章排序法
        array(
            'id'        => 'slider_recommend_order',
            'label'     => '首页幻灯片右侧文章来源',
            'desc'      => '首页非全宽幻灯片右侧文章排序',
            'type'      => 'radio',
            'std'       => 'latest_reviewed',
            'section'   => 'webstyle',
            'choices'   => array(
                array(
                    'value'       => 'latest_reviewed',
                    'label'       => '最新评论排序',
                ),
                array(
                    'value'       => 'most_viewed',
                    'label'       => '最多浏览排序',
                ),
                array(
                    'value'       => 'most_reviewed',
                    'label'       => '最多评论排序',
                ),
            )
        ),
        // 网站样式: Blocks布局样式
        array(
            'id'        => 'blocks_style',
            'label'     => 'Blocks布局样式',
            'desc'      => 'Blocks布局样式,等高块或不等高瀑布流,等高模式推荐timthumb裁剪缩略图以保证图片尺寸一致',
            'type'      => 'select',
            'std'       => 'normal_blocks',
            'section'   => 'webstyle',
            'choices'   => array( 
                array(
                    'value'       => 'normal_blocks',
                    'label'       => '等高块',
                ),
                array(
                    'value'       => 'fluid_blocks',
                    'label'       => '瀑布流',
                ),
            )
        ),
        // 网站样式: 浏览器滚动条颜色
        array(
            'id'        => 'browser_scroll_color',
            'label'     => '浏览器滚动条颜色',
            'desc'      => '浏览器滚动条颜色',
            'type'      => 'colorpicker',
            'std'       => '#00d6ac',
            'section'   => 'webstyle'
        ),
		// 网站样式: Body主字体颜色
        array(
            'id'        => 'main_body_color',
            'label'     => 'Body主字体颜色',
            'desc'      => 'Body主字体颜色',
            'type'      => 'colorpicker',
            'std'       => '#666',
            'section'   => 'webstyle'
        ),
		// 网站样式: Body主字体超链接颜色
        array(
            'id'        => 'main_body_a_color',
            'label'     => 'Body主字体超链接颜色',
            'desc'      => 'Body主字体超链接颜色',
            'type'      => 'colorpicker',
            'std'       => '#428bca',
            'section'   => 'webstyle'
        ),
		// 网站样式: Body主字体超链接鼠标悬停颜色
        array(
            'id'        => 'main_body_a_hover_color',
            'label'     => 'Body主字体超链接鼠标悬停颜色',
            'desc'      => 'Body主字体超链接鼠标悬停颜色',
            'type'      => 'colorpicker',
            'std'       => '#51ADED',
            'section'   => 'webstyle'
        ),
		// 网站样式: 块标题底边色
        array(
            'id'        => 'block_border_color',
            'label'     => '块标题底边色',
            'desc'      => '块标题底边色',
            'type'      => 'colorpicker',
            'std'       => '#f98181',
            'section'   => 'webstyle'
        ),
		// 网站样式: 文章标题颜色
        array(
            'id'        => 'title_a_color',
            'label'     => '文章标题颜色',
            'desc'      => '文章标题颜色',
            'type'      => 'colorpicker',
            'std'       => '#000',
            'section'   => 'webstyle'
        ),
		// 网站样式: 文章标题鼠标悬停颜色
        array(
            'id'        => 'title_a_hover_color',
            'label'     => '文章标题鼠标悬停颜色',
            'desc'      => '文章标题鼠标悬停颜色',
            'type'      => 'colorpicker',
            'std'       => '#51ADED',
            'section'   => 'webstyle'
        ),
		// 网站样式: Selection选取背景色
        array(
            'id'        => 'selection_bg_color',
            'label'     => 'Selection选取背景色',
            'desc'      => 'Selection选取背景色',
            'type'      => 'colorpicker',
            'std'       => '#51aded',
            'section'   => 'webstyle'
        ),
		// 网站样式: Selection选取文字颜色
        array(
            'id'        => 'selection_color',
            'label'     => 'Selection选取文字颜色',
            'desc'      => 'Selection选取文字颜色',
            'type'      => 'colorpicker',
            'std'       => '#fff',
            'section'   => 'webstyle'
        ),
		// 网站样式: 导航条背景色
        array(
            'id'        => 'nav_bg_color',
            'label'     => '导航条背景色',
            'desc'      => '导航条背景色',
            'type'      => 'colorpicker',
            'std'       => '#fff',
            'section'   => 'webstyle'
        ),
		// 网站样式: 菜单文字颜色
        array(
            'id'        => 'menu_color',
            'label'     => '菜单文字颜色',
            'desc'      => '菜单文字颜色',
            'type'      => 'colorpicker',
            'std'       => '#333',//#428bca
            'section'   => 'webstyle'
        ),
		// 网站样式: 菜单悬停背景色
        array(
            'id'        => 'menu_hover_bg_color',
            'label'     => '菜单悬停背景色',
            'desc'      => '菜单悬停背景色',
            'type'      => 'colorpicker',
            'std'       => '#f5f5f5',
            'section'   => 'webstyle'
        ),
		// 网站样式: 菜单悬停文字颜色
        array(
            'id'        => 'menu_hover_color',
            'label'     => '菜单悬停文字颜色',
            'desc'      => '菜单悬停文字颜色',
            'type'      => 'colorpicker',
            'std'       => '#51ADED',
            'section'   => 'webstyle'
        ),
		// 网站样式: Logo字体颜色
        array(
            'id'        => 'logo_color',
            'label'     => 'Logo字体颜色',
            'desc'      => 'Logo字体颜色',
            'type'      => 'colorpicker',
            'std'       => '#888',
            'section'   => 'webstyle'
        ),
		// 网站样式: 移动端标题字体大小
        array(
            'id'        => 'mobile_title_font_size',
            'label'     => '移动端标题字体大小',
            'desc'      => '移动端标题字体大小',
            'type'      => 'select',
            'choices'   => array( 
                array(
                    'value'       => '12px',
                    'label'       => '12像素',
                ),
                array(
                    'value'       => '13px',
                    'label'       => '13像素',
                ),
                array(
                    'value'       => '14px',
                    'label'       => '14像素',
                ),
                array(
                    'value'       => '15px',
                    'label'       => '15像素',
                ),
            ),
            'std'       => '12px',
            'section'   => 'webstyle'
        ),
		// 网站样式: 移动端内容字体大小
        array(
            'id'        => 'mobile_content_font_size',
            'label'     => '移动端内容字体大小',
            'desc'      => '移动端内容字体大小',
            'type'      => 'select',
            'choices'   => array( 
                array(
                    'value'       => '10px',
                    'label'       => '10像素',
                ),
                array(
                    'value'       => '11px',
                    'label'       => '11像素',
                ),
                array(
                    'value'       => '12px',
                    'label'       => '12像素',
                ),
                array(
                    'value'       => '13px',
                    'label'       => '13像素',
                ),
            ),
            'std'       => '10px',
            'section'   => 'webstyle'
        ),
        // 广告投放: 顶部广告
        array(
            'id'        => 'headerad',
            'label'     => '顶部自定义广告',
            'desc'      => '在网页顶部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度1120px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 底部广告
        array(
            'id'        => 'bottomad',
            'label'     => '底部自定义广告',
            'desc'      => '在网页底部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度1120px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
		// 广告投放: 首页文章循环内部广告
        array(
            'id'        => 'cmswithsidebar_loop_ad',
            'label'     => '首页文章循环内部广告',
            'desc'      => '带边栏首页文章循环内部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度800px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 文章页上方广告
        array(
            'id'        => 'singletopad',
            'label'     => '文章页上部广告',
            'desc'      => '在文章顶部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度800px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 文章页缩略图下方广告
        array(
            'id'        => 'singlethumbad',
            'label'     => '文章页缩略图下方广告',
            'desc'      => '在文章页缩略图下方加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度800px，如果没有缩略图将不显示',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 文章页下方广告
        array(
            'id'        => 'singlebottomad',
            'label'     => '文章页下部广告',
            'desc'      => '在文章底部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度800px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
		// 广告投放: 文章页下方广告
        array(
            'id'        => 'cmntad1',
            'label'     => '评论区顶部广告',
            'desc'      => '在文章评论顶部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度800px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
		// 广告投放: 文章页下方广告
        array(
            'id'        => 'cmntad2',
            'label'     => '评论区内部广告',
            'desc'      => '在文章评论内部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，最大宽度800px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
		// 广告投放: 文章页上方移动广告
        array(
            'id'        => 'singlead1_mobile',
            'label'     => '文章页上部移动广告',
            'desc'      => '在移动设备文章上部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，推荐宽度320px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
		// 广告投放: 文章页下方移动广告
        array(
            'id'        => 'singlead2_mobile',
            'label'     => '文章页底部移动广告',
            'desc'      => '在移动设备文章底部加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，推荐宽度320px',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 下载页广告1
        array(
            'id'        => 'dlad1',
            'label'     => '下载页广告1',
            'desc'      => '在下载页加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，推荐尺寸336*300以内',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 下载页广告2
        array(
            'id'        => 'dlad2',
            'label'     => '下载页广告2',
            'desc'      => '在下载页加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，推荐尺寸760*90以内',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 下载页广告3
        array(
            'id'        => 'dlad3',
            'label'     => '下载页广告3',
            'desc'      => '在下载页加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，推荐尺寸336*300以内',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 下载页广告4
        array(
            'id'        => 'dlad4',
            'label'     => '下载页广告4',
            'desc'      => '在下载页加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，推荐尺寸336*300以内',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 广告投放: 演示页浮动对联广告
        array(
            'id'        => 'floatad',
            'label'     => '演示页广告',
            'desc'      => '在演示页加载用户自定义广告代码，可以是javascript或者css，包含完整代码外标签，推荐浮动对联广告',
            'type'      => 'textarea_simple',
            'rows'      => '5',
            'std'       => '',
            'section'   => 'adsposit'
        ),
        // 高级设置: 邮件周刊
        array(
            'id'        => 'newsletter',
            'label'     => '邮件周刊',
            'desc'      => '每周向订阅用户发送上周内发布的新文章',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'advanced'
        ),
        // 高级设置: 登录错误提醒
        array(
            'id'        => 'login_failed_notify',
            'label'     => '登陆错误提醒',
            'desc'      => '登陆错误时邮件提醒',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'advanced'
        ),
        // 高级设置: 登录成功提醒
        array(
            'id'        => 'login_success_notify',
            'label'     => '登录成功提醒',
            'desc'      => '登录成功时邮件提醒',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'advanced'
        ),
        // 高级设置: 评论过滤
        array(
            'id'        => 'span_comments',
            'label'     => '评论过滤',
            'desc'      => '纯英文或日文评论过滤',
            'type'      => 'on-off',
            'std'       => 'off',
            'section'   => 'advanced'
        ),
        // 高级设置: 新浪微博
        array(
            'id'        => 'tin_sinaweibo',
            'label'     => '新浪微博',
            'desc'      => '新浪微博，例如我的新浪微博主页http://weibo.com/touchumind/，则填写touchumind即可',
            'type'      => 'text',
            'std'       => 'touchumind',
            'section'   => 'advanced'
        ),
        // 高级设置: 腾讯微博
        array(
            'id'        => 'tin_qqweibo',
            'label'     => '腾讯微博',
            'desc'      => '腾讯微博，例如我的腾讯微博主页http://t.qq.com/touchumind，则填写touchumind即可',
            'type'      => 'text',
            'std'       => 'touchumind',
            'section'   => 'advanced'
        ), 
        // 高级设置: QQ/QQ空间
        array(
            'id'        => 'tin_qq',
            'label'     => 'QQ/QQ空间',
            'desc'      => 'QQ/QQ空间，例如我的QQ空间主页http://user.qzone.qq.com/813920477/，则填写813920477即可',
            'type'      => 'text',
            'std'       => '813920477',
            'section'   => 'advanced'
        ), 
        // 高级设置: 微信
        array(
            'id'        => 'tin_weixin',
            'label'     => '微信',
            'desc'      => '微信二维码图片',
            'type'      => 'upload',
            'std'       => 'http://pic.zhiyanblog.com/?di=Z4EI',
            'section'   => 'advanced'
        ), 
        // 高级设置: QQ群
        array(
            'id'        => 'tin_qqgroup',
            'label'     => 'QQ群链接',
            'desc'      => '加入QQ群链接，用于QQ群推广，请至http://qun.qq.com/join.html获取你的网站QQ群的推广链接',
            'type'      => 'text',
            'std'       => '',
            'section'   => 'advanced'
        ),
        // 高级设置: QQ邮我按钮
        array(
            'id'        => 'tin_qq_mail',
            'label'     => 'QQ邮我按钮',
            'desc'      => 'QQ邮我按钮，用于快速邮件联系，请至http://open.mail.qq.com获取代码',
            'type'      => 'text',
            'std'       => 'http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=cBMYGR4RAxhCQEFAMAYZAF4BAV4THx0',
            'section'   => 'advanced'
        ),
        // 高级设置: QQ List
        array(
            'id'        => 'tin_qqlist',
            'label'     => 'QQ邮件列表',
            'desc'      => 'QQ邮件列表订阅链接中ID值，例如订阅链接为http://list.qq.com/cgi-bin/qf_invite?id=38c32a0083496c8c74265b09a0a7e2af923171f3704f4a7b，仅需填写38c32a0083496c8c74265b09a0a7e2af923171f3704f4a7b即可，详见http://list.qq.com',
            'type'      => 'text',
            'std'       => '38c32a0083496c8c74265b09a0a7e2af923171f3704f4a7b',
            'section'   => 'advanced'
        ),
        // 高级设置: 支付宝收款帐户
		array(
            'id'        => 'alipay_email',
            'label'     => '支付宝收款帐户邮箱',
            'desc'      => '支付宝收款帐户邮箱,要收款必填并务必保持正确',
            'type'      => 'text',
            'std'       => '',
            'section'   => 'advanced'
        ),
		// 高级设置: 支付宝收款二维码
		array(
            'id'        => 'alipay_qr',
            'label'     => '支付宝收款二维码',
            'desc'      => '支付宝收款二维码,请至支付宝获取二维码并填写二维码图片链接',
            'type'      => 'text',
            'std'       => '',
            'section'   => 'advanced'
        ),
        // 高级设置: 支付宝赞助默认金额设置
        array(
            'id'        => 'alipay_donate_num',
            'label'     => '支付宝赞助默认金额设置',
            'desc'      => '支付宝赞助默认金额设置，仅限网页方式的赞助打款，按钮出现在文章页作者信息栏',
            'type'      => 'text',
            'std'       => '10',
            'section'   => 'advanced'
        ),
	);
	
	//Admin Custom settings
	$custom_settings = array(
		'sections' => $sections,
		'settings' => $settings,
	);
	
	//allow settings to be filtered before saving
	$custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
	
	//settings are not the same update the DB
	if ( $saved_settings !== $custom_settings ) {
		update_option( ot_settings_id(), $custom_settings ); 
	}
}
