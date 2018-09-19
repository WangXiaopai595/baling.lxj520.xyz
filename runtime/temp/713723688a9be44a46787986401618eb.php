<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"C:\wwwroot\baling.cqyxcn.com\public/../application/admin\view\role\addrole.html";i:1517136988;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\header.html";i:1517123229;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\footer.html";i:1517123802;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<link rel="stylesheet" type="text/css" href="/static/admin/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/admin/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/admin/css/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/admin/css/personal.css" media="all">
	<link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="/static/admin/css/main.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/static/admin/css/boot.css">
</head>
<body class="childrenBody">


<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
	<legend>
		<div class="layui-inline">
			<a href="<?php echo url('role/index'); ?>" class="layui-btn layui-btn-normal">返回列表</a>
		</div>
	</legend>
</fieldset>

<form class="layui-form" id="form">
	
	<div class="layui-form-item">
		<label class="layui-form-label">角色名:</label>
		<div class="layui-input-block" style="width: 50%;">
			<input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入角色名" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux"></div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">排序:</label>
		<div class="layui-input-block" style="width: 50%;">
			<input type="number" name="sort" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux"></div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">备注:</label>
		<div class="layui-input-block" style="width: 50%;">
			<input type="text" name="remark" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux"></div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">启用状态:</label>
		<div class="layui-input-block">
			<input type="checkbox" checked="" name="status" lay-skin="switch" lay-text="ON|OFF" value="1" />
		</div>
	</div>
	
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button type="button" class="layui-btn" id="button" data-url='<?php echo url("role/addrole"); ?>' data-succ='<?php echo url("role/index"); ?>'>立即提交</button>
		</div>
	</div>
	
</form>
<script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/admin/js/layer.js"></script>
<!--<script type="text/javascript" src="/static/admin/layui/layui.js"></script>-->
<script type="text/javascript" src="/static/admin/plugins/layui/layui.js"></script>
<script type="text/javascript" src="//idm-su.baidu.com/su.js"></script>

</body>
</html>
<script>
	$(window).keydown(function(){ 
		if ( event.keyCode==116){ 
			event.keyCode = 0; 
			event.cancelBubble = true; 
			reload();
			return  false;
		} 
	})
	function reload(){
		location.reload();
	}
</script>

<script>
	
	$(function(){
		
		/**
		 * 检测表单
		 */
		function checkForm(){
			var name = $("input[name='name']").val();
			
			if(name == ''){
				layer.msg('角色名不能为空',{icon:0,time:1000});
				return false;
			}
			return true;
		}
		/**
		 * ajax序列化提交表单
		 */
		$("#button").click(function(){
			var succ = $(this).attr("data-succ");
			var url = $(this).attr("data-url");
			var data = $("#form").serialize();
			if(checkForm()){
				$.ajax({
					type:"post",
					dataType:"json",
					url:url,
					data:data,
					success:function(date){
						if(date.status == 1){
							layer.msg(date.msg,{icon:1,time:1000});
							setTimeout(function(){
								location.href = succ;
							},700)
						}else{
							layer.msg(date.msg,{icon:2,time:1000});
						}
					}
				})
			}
		})
	})
	
	layui.use(['form', 'layedit'], function() {});
	
</script>