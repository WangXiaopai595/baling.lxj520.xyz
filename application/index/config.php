<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
return [
	// 默认跳转页面对应的模板文件
	'dispatch_success_tmpl'  => 'public/redirect',
	'dispatch_error_tmpl'    => 'public/redirect',

	//静态页面变量
	'view_replace_str'   =>  array(
		'__STYLE__'         =>  '/static/wap'
	),
];