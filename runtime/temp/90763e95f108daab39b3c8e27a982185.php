<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"C:\wwwroot\baling.cqyxcn.com\public/../application/index\view\index\build.html";i:1520490056;}*/ ?>
<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,viewport-fit=cover">
		<title>捌零映像设计机构-施工档案</title>
		<script src="/static/wap/jquery-3.2.1/jquery-3.2.1.min.js"></script>
		<link href="/static/wap/css/index.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div class="slider">
			<div class="ullidiv">
				<ul id="lilenght">
					<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="<?php echo $vo['url']; ?>">
								<img src="<?php echo $vo['banner']; ?>">
							</a>
						</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div class="tab_hd">
			<ul>
				<li class="">
					<a href="<?php echo url('index/index'); ?>" style="text-decoration:none;color: #333;" >
						设计案列
					</a>
				</li>
				<li class="active">
					施工档案
				</li>
			</ul>
		</div>
		<div class="div0">
			<?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<a class="list_item" href="<?php echo url('index/detail',['id'=>$vo['id']]); ?>">
					<div class="cover">
						<img src="<?php echo $vo['cover']; ?>">
					</div>
					<div class="cont">
						<h2 class="title"><?php echo $vo['title']; ?></h2>
						<p class="desc">
							<?php echo $vo['sketch']; ?>
						</p>
					</div>
				</a>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php if((empty($article)) OR (count($article) < 10)): ?>
			<p style="text-align: center;color: #778097;font-size: 8px;" id="footer">----我是有底线的----</p>
		<?php else: ?>
			<p style="text-align: center;color: #778097;font-size: 8px;" id="footer">----上拉加载更多----</p>
		<?php endif; ?>
		<script>
			var isRequest = true;
			var page = 1;
			//jquery
			$(window).scroll(function(){
			　　	var scrollTop = $(this).scrollTop();
			　　	var scrollHeight = $(document).height();
			　　	var windowHeight = $(this).height();
			　　	if(scrollTop + windowHeight == scrollHeight){
					if(isRequest){
						$('#footer').html('----加载中----');
						$.ajax({
							type:"post",
							dataType:"json",
							url:'<?php echo url("index/articleMore"); ?>',
							data:{
								page:page,
								type:2
							},
							success:function(date){
								if(date.status == 1){
									page++;
									var length = date.data.length;
									if(length != 0){
										var html = '';
										for(var i = 0; i < length; i++){
											html += '<a class="list_item" href="'+date['data'][i]['url']+'">'
													+'<div class="cover"><img src="'+date['data'][i]['cover']+'"></div>'
													+'<div class="cont"><h2 class="title">'+date['data'][i]['title']+'</h2><p class="desc">'+date['data'][i]['sketch']+'</p></div>'
													+'</a>';
										}
										$('.div0').append(html);
									}
									if(date.data.length < 10){
										$('#footer').html('----我是有底线的----');
										isRequest = false;
									}else{
										$('#footer').html('----上拉加载更多----');
									}
								}else{
									$('#footer').html('----我是有底线的----');
									isRequest = false;
								}
							}
						});
					}
			　　	}
			});
		</script>
		<script>
			$().ready(function() {
				//菜单结束
				//轮播图开始
				var lis = $("#lilenght").children('li').length;
				var widnmu = $(".slider").width()
				$("#lilenght li").width(widnmu)
				var digwhi = lis * widnmu
				$(".ullidiv").width(digwhi)
				var n = 1
				var marginleft = 0
				var marginright = widnmu * (1 - lis)
				var timer = setInterval(function() {
					if(marginleft >= marginright) {
						$(".ullidiv").css("left", marginleft)
						n = n + 1
						marginleft = -n * widnmu
					} else {
						n = 0;
						marginleft = 0;
					}
				}, 4000);
				//轮播图结束
			})
		</script>
	</body>

</html>