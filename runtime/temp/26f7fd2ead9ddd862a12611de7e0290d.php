<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"C:\wwwroot\baling.cqyxcn.com\public/../application/admin\view\index\index.html";i:1520490199;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>捌零映像设计机构-管理后台</title>
    <link rel="stylesheet" href="/static/admin/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" type="text/css" href="/static/admin/css/boot.css">
    <link rel="stylesheet" href="/static/admin/build/css/app.css" media="all">
</head>

<body>
    <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">捌零映像设计机构-管理后台</div>
            <div class="layui-logo kit-logo-mobile">K</div>
            <ul class="layui-nav layui-layout-left kit-nav">
                <!--<li class="layui-nav-item"><a href="javascript:;">控制台</a></li>
                <li class="layui-nav-item"><a href="javascript:;">商品管理</a></li>
                <li class="layui-nav-item"><a href="javascript:;" id="pay"><i class="fa fa-gratipay" aria-hidden="true"></i> 其他</a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;">其它系统</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">邮件管理</a></dd>
                        <dd><a href="javascript:;">消息管理</a></dd>
                        <dd><a href="javascript:;">授权管理</a></dd>
                    </dl>
                </li>-->
            </ul>
            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="http://m.zhengjinfan.cn/images/0.jpg" class="layui-nav-img"> <?php echo $member['user']; ?>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;"><?php echo $member['realname']; ?></a></dd>
                        <!--<dd><a href="javascript:;">安全设置</a></dd>-->
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="<?php echo url('index/loginOut'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a></li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black kit-side">
            <div class="layui-side-scroll">
                <div class="kit-side-fold"><i class="fa fa-navicon" aria-hidden="true"></i></div>
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                	<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($k == 1): ?>
                			<li class="layui-nav-item layui-nav-itemed">
                		<?php else: ?>
                			<li class="layui-nav-item">
                		<?php endif; ?>
	                        <a class="" href="javascript:;"><i class="<?php echo $vo['micon']; ?>" aria-hidden="true"></i><span> <?php echo $vo['mname']; ?></span></a>
	                        <dl class="layui-nav-child">
	                        	<?php if(is_array($vo['menu']) || $vo['menu'] instanceof \think\Collection || $vo['menu'] instanceof \think\Paginator): $key = 0; $__LIST__ = $vo['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($key % 2 );++$key;?>
	                        		<dd>
		                                <a href="javascript:;" data-url="<?php echo url($item['url']); ?>" data-icon="<?php echo $item['cicon']; ?>" data-title="<?php echo $item['title']; ?>" kit-target data-id='<?php echo $k; ?><?php echo $key; ?>'>
		                                	<i class="<?php echo $item['icon']; ?>" aria-hidden="true"></i>
		                                	<span> <?php echo $item['title']; ?></span>
		                                </a>
		                            </dd>
	                        	<?php endforeach; endif; else: echo "" ;endif; ?>
	                        </dl>
	                    </li>
                	<?php endforeach; endif; else: echo "" ;endif; ?>
                    <!--<li class="layui-nav-item">
                        <a href="javascript:;" data-url="/components/table/table.html" data-name="table" kit-loader><i class="fa fa-plug" aria-hidden="true"></i><span> 表格(page)</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-url="/views/form.html" data-name="form" kit-loader><i class="fa fa-plug" aria-hidden="true"></i><span> 表单(page)</span></a>
                    </li>-->
                </ul>
            </div>
        </div>
        <div class="layui-body" id="container">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">主体内容加载中,请稍等...</div>
        </div>

        <!--<div class="layui-footer">
            Copyright © 版权所有 备案号： 
            <a href="http://www.miitbeian.gov.cn/">渝ICP备*****号</a>

        </div>-->
    </div>
    
    <script src="/static/admin/js/jquery.min.js"></script>
    <script src="/static/admin/plugins/layui/layui.js"></script>
    <script>
        var message;
        layui.config({
            base: '/static/admin/build/js/'
        }).use(['app', 'message'], function() {
            var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
            //将message设置为全局以便子页面调用
            message = layui.message;
            //主入口
            app.set({
                type: 'iframe'
            }).init();
            $('#pay').on('click', function() {
                layer.open({
                    title: false,
                    type: 1,
                    content: '<img src="/static/admin/build/images/pay.png" />',
                    area: ['500px', '250px'],
                    shadeClose: true
                });
            });
        });
    </script>
</body>

</html>
<script>
	$(window).keydown(function(){ 
		if ( event.keyCode==116){ 
			event.keyCode = 0; 
			event.cancelBubble = true; 
			return  false;
		} 
	})
</script>