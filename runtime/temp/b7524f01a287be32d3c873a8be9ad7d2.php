<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"C:\wwwroot\baling.cqyxcn.com\public/../application/index\view\index\detail.html";i:1521190721;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,viewport-fit=cover">
    <title>捌零映像设计机构-<?php echo $article['title']; ?></title>
	<meta name="referrer" content="never">
    <script src="/static/wap/jquery-3.2.1/jquery-3.2.1.min.js"></script>
    <link href="/static/wap/css/index.css" rel="stylesheet" type="text/css" />
	<style>
		*{
			max-width: 100%!important;
			margin: 0;
			padding: 0;
			font-style: normal;
			box-sizing: border-box!important;
			-webkit-box-sizing: border-box!important;
			word-wrap: break-word!important;
		}
		img{
			height:auto !important;
		}
	</style>
</head>
<body>

   <div style="margin: 10px;margin-top:20px ">
       <h2 class="rich_media_title" style="font-weight: 600;">
           <?php echo $article['title']; ?>
       </h2>
       <div  class="rich_media_meta_list">
           <span  class="rich_media_meta rich_media_meta_text" style="color: #8c8c8c;font-size: 10px;"><?php echo date("Y-m-d",$article['time']); ?></span>

           <a href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzU4NDQzMDIzMw==&scene=124#wechat_redirect">
           <span class="rich_media_meta rich_media_meta_text rich_media_meta_nickname" style="color: #93a7e4;font-size: 14px;">捌零映像设计机构</span>
           </a>
       </div>
       <div class="rich_media_content ">
           <?php echo htmlspecialchars_decode($article['content']); ?>
       </div>
   </div>
</body>

</html>