<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"C:\wwwroot\baling.cqyxcn.com\public/../application/admin\view\role\rolenode.html";i:1517142948;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\header.html";i:1517123229;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\footer.html";i:1517123802;}*/ ?>
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
	<input type="hidden" name="id" value="<?php echo $roleID; ?>" />
	
	<div class="layui-form-item" pane="">
		<label class="layui-form-label"></label>
		<div class="layui-input-block">
			<span id="check" style="display: inline-block;">
				<input type="checkbox" lay-skin="primary" title="全选">
			</span>
		</div>
	</div>
	
	<?php if(is_array($node) || $node instanceof \think\Collection || $node instanceof \think\Paginator): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<div class="layui-form-item" pane="">
			<label class="layui-form-label"><?php echo $vo['ptitle']; ?>:</label>
			<span class="parentCheck" style="display: inline-block;">
				<input type="checkbox" class="check" lay-skin="primary" title="全选">
			</span>
			<div class="layui-input-block">
				<?php if(is_array($vo['node']) || $vo['node'] instanceof \think\Collection || $vo['node'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['node'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
					<span style="display: inline-block;" class="childCheck">
						<?php if(in_array($item['id'],$nodeID)): ?>
						 	<input type="checkbox" checked="" name="node_id[]" lay-skin="primary" title="<?php echo $item['title']; ?>" value="<?php echo $item['id']; ?>">
						<?php else: ?>
							<input type="checkbox" name="node_id[]" lay-skin="primary" title="<?php echo $item['title']; ?>" value="<?php echo $item['id']; ?>">
						<?php endif; ?>
						
					</span>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
		
	
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button type="button" class="layui-btn" id="button" data-url='<?php echo url("role/rolenode"); ?>' data-succ='<?php echo url("role/index"); ?>'>立即提交</button>
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
		 * 当子选项取消时，关闭全部选择和父级全选
		 */
		$(".childCheck").click(function(){
			var ischeck = $(this).children('input').is(":checked");
			if(!ischeck){
				$("#check").children('input').prop("checked",false);
				$(".parentCheck").children('input').prop("checked",false);
			}
			form.render();
		})
		/**
		 * 全选
		 */
		$("#check").click(function(){
			var ischeck = $(this).children('input').is(":checked");
			if(ischeck){
				$('input[type="checkbox"]').prop("checked",true);
			}else{
				$('input[type="checkbox"]').prop("checked",false);
			}
			form.render();
		})
		
		/**
		 * 块级全选
		 */
		$(".parentCheck").click(function(){
			var ischeck = $(this).children('input').is(":checked");
			var prcv = $(this).next();
			if(ischeck){
				prcv.children('span').children('input').prop("checked",true);
			}else{
				$("#check").children('span').children('input').prop("checked",false);
				prcv.children('span').children('input').prop("checked",false);
			}
			form.render();
		})
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
	
	layui.use(['form'], function() {
		form = layui.form;
		form.render();
	});
	
</script>