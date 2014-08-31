<?php
/**
 * 
 * 后台菜单配置
 * 
 */
return array(
	'index'=>array(
		'name'=>'首页',
		'submenu'=>array(
			'后台首页'=>$this->createUrl('/site/welcome'),
			'关于我们管理' => $this->createUrl('/about/index'),
			'友情链接管理' => $this->createUrl('/flink/index'),
		)
	),

	'article' => array(
		'name' => '资讯',
		'submenu' => array(
			'资讯管理' => $this->createUrl('/article/index'),
			'分类管理' => $this->createUrl('/articleCategory/index'),
			'留言管理' => $this->createUrl('/articleComment/index'),
			
		),
	),

	'ann' => array(
		'name' => '公告',
		'submenu' => array(
			'公告管理' => $this->createUrl('/ann/index'),		
		)
	),

	'product' => array(
		'name' => '产品',
		'submenu' => array(
			'产品管理' => $this->createUrl('/product/index'),
			'分类管理' => $this->createUrl('/productCategory/index'),
			//'留言管理' => $this->createUrl('/productComment/index'),
		),
	),

	'page' => array(
		'name' => '单页管理',
		'submenu' => array(
			'单页列表' => $this->createUrl('/page/index'),
			'添加单页' => $this->createUrl('/page/create'),
		),
	),
	
	'adv' => array(
		'name' => '广告管理',
		'submenu' => array(
			//'广告位管理' => $this->createUrl('/advertisePosition/index'),
			//'模板管理' => $this->createUrl('/advertiseTemplate/index'),
			//'广告管理' => $this->createUrl('/advertise/index'),
			'灯片管理' => $this->createUrl('/slideshow/index'),
			'添加灯片' => $this->createUrl('/slideshow/create'),
		)
	),

	'global'=>array(
		'name'=>'系统',
		'submenu'=>array(
            '网站设置'=>$this->createUrl('/config/index'),
            '单页设置'=>$this->createUrl('/config/page'),
            '联系设置'=>$this->createUrl('/config/contact'),
			'后台用户'=>$this->createUrl('/administrator/index'),
			//'权限管理'=>$this->createUrl('/rights'),
			//'代码生成器'=>$this->createUrl('gii/adminModel/index'),
		)
	),
);