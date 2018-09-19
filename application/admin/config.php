<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
return [
	// 默认跳转页面对应的模板文件
	'dispatch_success_tmpl'  => 'public/redirect',
	'dispatch_error_tmpl'    => 'public/redirect',

	//静态页面变量
	'view_replace_str'   =>  array(
		'__STYLE__'         =>  '/static/admin'
	),

	'wx_config'		=> [
		'key' => 'b998aedb3db8c40e89418556cd79d0d4',
		'appid' => 'wx779b9fef5504815f',
		'EncodingAESKey' => 'fvkDcwNM6IxrTmoLjksZVyH9uyKH34UZ5S4ozktIIaV',
		'url' => 'http://baling.lxj520.xyz',
		'token' => '2bce7b2ca7f6950f2c1500190145ff5a'
	]
];