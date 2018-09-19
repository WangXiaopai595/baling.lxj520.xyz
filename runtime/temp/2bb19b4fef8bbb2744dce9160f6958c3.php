<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"C:\wwwroot\baling.cqyxcn.com\public/../application/admin\view\admin\addadmin.html";i:1517143241;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\header.html";i:1517123229;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\footer.html";i:1517123802;}*/ ?>
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
			<a href="<?php echo url('admin/index'); ?>" class="layui-btn layui-btn-normal">返回列表</a>
		</div>
	</legend>
</fieldset>

<form class="layui-form" id="form">
	<div class="layui-form-item">
		<label class="layui-form-label">用户名</label>
		<div class="layui-input-block" style="width: 50%;">
			<input type="text" name="user" lay-verify="title" autocomplete="off" placeholder="请输入用户名" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux">字母、数字、下划线组成，字母或数字开头，4-16位</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">密码</label>
		<div class="layui-input-block" style="width: 50%;">
			<input type="text" name="password" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux">字母、数字、下划线组成，6-16位</div>
	</div>

	<div class="layui-form-item">
		<div class="layui-inline">
			<label class="layui-form-label">Email</label>
			<div class="layui-input-inline">
				<input type="text" name="email" lay-verify="phone" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-inline">
			<label class="layui-form-label">手机号码</label>
			<div class="layui-input-inline">
				<input type="text" name="phone" lay-verify="email" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-inline">
			<label class="layui-form-label">用户身份</label>
			<div class="layui-input-inline">
				<input type="text" name="realname" lay-verify="required|number" autocomplete="off" class="layui-input">
			</div>
		</div>
	</div>

	<div class="layui-form-item"">
		<div class="layui-inline">
			<label class="layui-form-label">备注说明</label>
			<div class="layui-input-inline">
				<input type="text" name="remark" lay-verify="identity" placeholder="" autocomplete="off" class="layui-input">
			</div>
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">启用状态</label>
		<div class="layui-input-block">
			<input type="checkbox" checked="" name="status" lay-skin="switch" lay-text="ON|OFF" value="1" />
		</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">用户角色</label>
		<div class="layui-input-block" style="width: 50%;">
			<select name="role" lay-filter="aihao">
				<?php if(is_array($role) || $role instanceof \think\Collection || $role instanceof \think\Paginator): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>
	
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button type="button" class="layui-btn" id="button" data-url='<?php echo url("admin/addadmin"); ?>' data-succ='<?php echo url("admin/index"); ?>'>立即提交</button>
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
		 * 验证账号是否合法  4-16位
		 * @param {Object} str 需要验证的字符
		 * 验证规则：字母、数字、下划线组成，字母或数字开头，4-16位
		 */
		function checkUser(str){
			var re = /^[0-9a-zA-z]\w{3,15}$/;
			if(re.test(str)){
				return true;
			}else{
				return false;
			} 
		}
		
		/**
		 * 验证账号是否合法  4-16位
		 * @param {Object} str 需要验证的字符
		 * 验证规则：字母、数字、下划线组成，6-16位
		 */
		function checkPwd(str){
			var re = /^\w{6,16}$/;
			if(re.test(str)){
				return true;
			}else{
				return false;
			} 
		}
		
		/**
		 * 验证手机号码是否合法
		 * @param {Object} str 需要验证的字符
		 * 验证规则：11位数字，以1开头。
		 */
		function checkMobile(str) {
			var re = /^1[34578]\d{9}$/
			if(re.test(str)){
				return true;
			}else{
				return false;
			} 
		}
		
		/**
		 * 验证邮箱是否合法
		 * @param {Object} str 需要验证的字符
		 * 验证规则：姑且把邮箱地址分成“第一部分@第二部分”这样 第一部分：由字母、数字、下划线、短线“-”、点号“.”组成，
		 * 第二部分：为一个域名，域名由字母、数字、短线“-”、域名后缀组成，
		 * 而域名后缀一般为.xxx或.xxx.xx，一区的域名后缀一般为2-4位，如cn,com,net，现在域名有的也会大于4位
		 */
		function checkEmail(str){
			var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/
			if(re.test(str)){
				return true;
			}else{
				return false;
			}
		}
		
		function checkForm(){
			var user = $("input[name='user']").val();
			var pwd = $("input[name='password']").val();
			var email = $("input[name='email']").val();
			var phone = $("input[name='phone']").val();
			
			if(!checkUser(user)){
				layer.msg('请按照规则输入用户名',{icon:0,time:1000});
				return false;
			}
			if(!checkUser(pwd)){
				layer.msg('请按照规则输入密码',{icon:0,time:1000});
				return false;
			}
			if(!checkEmail(email) && email != ''){
				layer.msg('请输入正确的邮箱',{icon:0,time:1000});
				return false;
			}
			if(!checkMobile(phone) && phone != ''){
				layer.msg('请输入正确的手机号码',{icon:0,time:1000});
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