<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"C:\wwwroot\baling.cqyxcn.com\public/../application/admin\view\site\index.html";i:1520478931;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\header.html";i:1517123229;s:70:"C:\wwwroot\baling.cqyxcn.com\application\admin\view\public\footer.html";i:1517123802;}*/ ?>
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
				<?php if(in_array('site/articleadd',$operable)): ?>
					<div class="layui-inline">
						<a href="<?php echo url('site/articleadd'); ?>" class="layui-btn layui-btn-normal newsAdd_btn">添加文章</a>
					</div>
				<?php endif; if(in_array('site/articledel',$operable)): ?>
					<div class="layui-inline">
						<a data-url="<?php echo url('site/articledel'); ?>" class="layui-btn layui-btn-danger batchDel">批量删除</a>
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
							<th>标题</th>
							<th>封面图</th>
							<th>简介</th>
							<th>发布时间</th>
							<th>所属板块</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content" id="table">
						<?php if(is_array($article['list']) || $article['list'] instanceof \think\Collection || $article['list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $article['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<tr>
								<td>
									<input name="check" type="checkbox" value="<?php echo $vo['id']; ?>" style="display: block;">
								</td>
								<td><?php echo $vo['title']; ?></td>
								<td>
									<img src="<?php echo $vo['cover']; ?>" style="width: 50px;height: 50px;" />
								</td>
								<td style="20%">
									<div style="width: 100%;height: 50px;overflow: auto;">
										<?php echo $vo['sketch']; ?>
									</div>
								</td>
								<td>
									<span><?php echo date('Y-m-d H:i:s',$vo['time']); ?></span>
								</td>
								<td>
									<?php if($vo['type'] == 1): ?>
										设计案例
									<?php else: ?>
										施工档案
									<?php endif; ?>
								</td>
								<td>
									<?php if(in_array('site/articleedit',$operable)): ?>
										<a href="<?php echo url('site/articleedit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-mini "><i class="iconfont icon-edit"></i> 编辑</a>
									<?php endif; if((in_array('site/articledel',$operable))): ?>
										<a data-url="<?php echo url('site/articledel'); ?>" data-id="<?php echo $vo['id']; ?>" class="layui-btn layui-btn-danger layui-btn-mini delete" data-id="1"><i class="layui-icon"></i> 删除</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<div style="text-align: right;">
					<?php echo $article['page']; ?>
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
		//点击图片查看大图
		$("img").click(function(){
			var id = $(this).attr('data-id');
			layer.photos({
			  	photos: '#table',
			  	anim: 5
			});
		})
		
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