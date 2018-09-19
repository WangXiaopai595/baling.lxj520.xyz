<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"C:\wwwroot\baling.cqyxcn.com\public/../application/admin\view\site\banneredit.html";i:1520490374;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\header.html";i:1517123229;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\footer.html";i:1517123802;}*/ ?>
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
			<a href="<?php echo url('site/banner'); ?>" class="layui-btn layui-btn-normal">返回列表</a>
		</div>
	</legend>
</fieldset>

<form class="layui-form" id="form">
	<input type="hidden" name="id" value="<?php echo $banner['id']; ?>" />
	<div class="layui-form-item">
		<label class="layui-form-label">Banner图:</label>
		<div class="layui-input-block" style="width: 50%;">
			<img id="cover" style="width: 70px;height: 70px;" src="<?php echo $banner['banner']; ?>" />
			<input id="img" type="file" accept="image/gif, image/jpeg, image/png, image/jpg" style="display: none;" name="banner" />
		</div>
		<label class="layui-form-label"></label>
		<div class="layui-form-mid layui-word-aux">建议尺寸750:360，图片大小不得超过2M</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">跳转地址:</label>
		<div class="layui-input-block" style="width: 50%;">
			<input type="text" name="url" lay-verify="title" autocomplete="off" placeholder="请输入跳转地址" class="layui-input" value="<?php echo $banner['url']; ?>">
		</div>
		<div class="layui-form-mid layui-word-aux">如：https://www.baidu.com,若不跳转请输入'#'</div>
	</div>
	
	<div class="layui-form-item">
		<label class="layui-form-label">排序权重:</label>
		<div class="layui-input-block" style="width: 50%;">
			<input type="number" name="sort" lay-verify="title" autocomplete="off" placeholder="" class="layui-input" value="<?php echo $banner['sort']; ?>">
		</div>
		<div class="layui-form-mid layui-word-aux"></div>
	</div>
	
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button type="button" class="layui-btn" id="button" data-url='<?php echo url("site/banneredit"); ?>' data-succ='<?php echo url("site/banner"); ?>'>立即提交</button>
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
		
		
		$("#cover").click(function(){
	 		$("#img").click();
	 	})
	    $('#img').change(function() { 
	        var html = '';
			for(var i=0;i<(this.files).length;i++){
				var file = this.files[i]; 
		        var r = new FileReader(); 
		        r.readAsDataURL(file);
		        $(r).load(function() {
		        	$("#cover").attr('src',this.result);
		        }) 
			}
	    }) 
		
		
		function checkForm(){
			var url = $("input[name='url']").val();
			if(!url){
				layer.msg('跳转地址不能为空',{icon:0,time:1000});
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
			var data = new FormData($("#form")[0]); 
			if(checkForm()){
				$.ajax({ 
				    url: url, 
				    type: 'POST', 
				    data: data, 
				    async: false, 
				    cache: false, 
				    contentType: false, 
				    processData: false, 
				    success: function(date) {
				    	if(date.status == 1){
				    		layer.msg(date['msg'], {icon: 1,time:1000});
				    		setTimeout(function(){
								location.href = succ;
							},700)
				    	}else{
				    		layer.msg(date['msg'], {icon: 2,time:1000});
				    	}
				    }
				}); 
			}
		})
	})
	
	layui.use(['form', 'layedit'], function() {});
</script>