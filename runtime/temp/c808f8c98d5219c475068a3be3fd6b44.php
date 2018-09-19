<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"C:\wwwroot\baling.cqyxcn.com\public/../application/admin\view\admin\index.html";i:1517219909;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\header.html";i:1517123229;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\footer.html";i:1517123802;}*/ ?>
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
<section class="layui-larry-box">
	<div class="larry-personal">
		<div class="layui-tab">
			<blockquote class="layui-elem-quote news_search">
				<!--<div class="layui-inline">
					<div class="layui-input-inline">
						<input value="" placeholder="请输入关键字" class="layui-input search_input" type="text">
					</div>
					<a class="layui-btn search_btn">查询</a>
				</div>-->
				<?php if(in_array('admin/addadmin',$operable)): ?>
					<div class="layui-inline">
						<a href="<?php echo url('admin/addadmin'); ?>" class="layui-btn layui-btn-normal newsAdd_btn">添加用户</a>
					</div>
				<?php endif; if(in_array('admin/delete',$operable)): ?>
					<div class="layui-inline">
						<a data-url="<?php echo url('admin/delete'); ?>" class="layui-btn layui-btn-danger batchDel">批量删除</a>
					</div>
				<?php endif; ?>
					
			</blockquote>

			<!-- 操作日志 -->
			<div class="layui-form news_list">
				<table class="layui-table">
					<thead>
						<tr>
							<th>
								<input id="check" type="checkbox" style="display: block;">
							</th>
							<th>用户名</th>
							<th>用户身份</th>
							<th>手机号码</th>
							<th>最后登录时间</th>
							<th>最后登录ip</th>
							<th>账号状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content">
						<?php if(is_array($user['list']) || $user['list'] instanceof \think\Collection || $user['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $user['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<tr>
								<td>
									<input name="check" type="checkbox" value="<?php echo $vo['id']; ?>" style="display: block;">
								</td>
								<td><?php echo $vo['user']; ?></td>
								<td>
									<?php if($vo['realname']): ?>
										<?php echo $vo['realname']; else: ?>
										/
									<?php endif; ?>
								</td>
								<td>
									<?php if($vo['phone']): ?>
										<?php echo $vo['phone']; else: ?>
										/
									<?php endif; ?>
								<td>
									<?php if($vo['last_login_time']): ?>
										<?php echo date('Y-m-d H:i:s',$vo['last_login_time']); else: ?>
										/
									<?php endif; ?>
								</td>
								<td>
									<?php if($vo['last_login_ip']): ?>
										<?php echo $vo['last_login_ip']; else: ?>
										/
									<?php endif; ?>
								</td>
								<td class="status">
									<?php if(in_array('admin/delete',$operable)): if($vo['status'] == 1): ?>
											<input name="show" lay-skin="switch" lay-text="NO|OFF" checked lay-filter="isShow" type="checkbox" value="1">
											<div data-url="<?php echo url('admin/editstatus'); ?>" data-id="<?php echo $vo['id']; ?>" class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>NO</em><i></i></div>
										<?php else: ?>
											<input name="show" lay-skin="switch" lay-text="NO|OFF" lay-filter="isShow" type="checkbox" value="0">
											<div data-url="<?php echo url('admin/editstatus'); ?>" data-id="<?php echo $vo['id']; ?>" class="layui-unselect layui-form-switch" lay-skin="_switch"><em>OFF</em><i></i></div>
										<?php endif; else: if($vo['status'] == 1): ?>
											<input name="show" lay-skin="switch" lay-text="NO|OFF" checked lay-filter="isShow" type="checkbox" value="1">
											<div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>NO</em><i></i></div>
										<?php else: ?>
											<input name="show" lay-skin="switch" lay-text="NO|OFF" lay-filter="isShow" type="checkbox" value="0">
											<div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>OFF</em><i></i></div>
										<?php endif; endif; ?>
										
								</td>
								<td>
									<?php if(in_array('admin/edit',$operable)): ?>
										<a href="<?php echo url('admin/edit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-mini "><i class="iconfont icon-edit"></i> 编辑</a>
									<?php endif; if((in_array('admin/delete',$operable)) AND ($vo['id'] != 1)): ?>
										<a data-url="<?php echo url('admin/delete'); ?>" data-id="<?php echo $vo['id']; ?>" class="layui-btn layui-btn-danger layui-btn-mini delete" data-id="1"><i class="layui-icon"></i> 删除</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<div style="text-align: right;">
					<?php echo $user['page']; ?>
				</div>
			</div>

		</div>
	</div>
</section>
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
		 * 多条删除
		 */
		$(".batchDel").click(function(){
			var checkedList = new Array();   
			$("input[name='check']:checked").each(function() {   
			    checkedList.push($(this).val());   
			})
			var id = checkedList.join(',');
			var url = $(this).attr("data-url");
			layer.open({
				content: '您正在进行删除操作，是否确认?',
				icon : 3,
				yes: function(layero, index){
				    $.ajax({
						type:"post",
						dataType:"json",
						url:url,
						data:{
							id:id
						},
						success:function(date){
							if(date.status == 1){
								layer.msg(date.msg,{icon:1,time:1000});
								setTimeout(function(){
									location.reload();
								},400)
							}else{
								layer.msg(date.msg,{icon:2,time:1000});
							}
						}
					});
			  	}
			});
		})
		
		/**
		 * 全选、全不选
		 */
		$("#check").click(function(){
			var check = $(this).is(":checked");
			if(check){
				$('input[name="check"]').each(function(){
                    $(this).prop("checked",true);  
                }); 
			}else{
				$('input[name="check"]').each(function(){
                    $(this).prop("checked",false);  
                }); 
			}
		})
		
		/**
		 * 单条删除
		 */
		$(".delete").click(function(){
			var status = $(this).prev().val();
			var url = $(this).attr("data-url");
			var id = $(this).attr("data-id");
			layer.open({
				content: '您正在进行删除操作，是否确认?',
				icon : 3,
				yes: function(layero, index){
				    $.ajax({
						type:"post",
						dataType:"json",
						url:url,
						data:{
							id:id
						},
						success:function(date){
							if(date.status == 1){
								layer.msg(date.msg,{icon:1,time:1000});
								setTimeout(function(){
									location.reload();
								},400)
							}else{
								layer.msg(date.msg,{icon:2,time:1000});
							}
						}
					});
			  	}
			});
		})
		
		/**
		 * 修改用户禁用状态
		 */
		$(".status div").click(function(){
			var index = layer.load(0, {time: 100});
			var status = $(this).prev().val();
			var url = $(this).attr("data-url");
			var id = $(this).attr("data-id");
			if(status == 1){
				status = 0;
			}else{
				status = 1;
			}
			if(!url){
				layer.msg('无权限操作此项',{icon:1,time:1000});
			}else{
				$.ajax({
					type:"post",
					dataType:"json",
					url:url,
					data:{
						id:id,
						status:status
					},
					success:function(date){
						layer.close(index);
						if(date.status == 1){
							layer.msg(date.msg,{icon:1,time:1000});
							setTimeout(function(){
								location.reload();
							},400)
						}else{
							layer.msg(date.msg,{icon:2,time:1000});
						}
					}
				})
			}
		})
	})
</script>