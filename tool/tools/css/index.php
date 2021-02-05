<?php
include("../../../config/conn.php");
include("../../../config/function.php");
include("../../../config/xy.php");
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>软件工具 - <?=webname?></title>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache" content="no-cache">

<link rel="shortcut icon" href="<?=weburl?>img/favicon.ico?t=<?=$glosxbh?>" type="image/x-icon" />
<link href="<?=weburl?>css/global.css?t=<?=$glosxbh?>" rel="stylesheet" type="text/css" />
<link href="<?=weburl?>css/basic.css?t=<?=$glosxbh?>" rel="stylesheet" type="text/css" />
<link href="./style.css?t=<?=$glosxbh?>" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=weburl?>js/global.js?t=<?=$glosxbh?>"></script>
<script language="javascript" src="<?=weburl?>js/basic.js?t=<?=$glosxbh?>"></script>
<script language="javascript" src="<?=weburl?>js/jquery.min.js?t=<?=$glosxbh?>"></script>
<script language="javascript" src="<?=weburl?>js/layer.js?t=<?=$glosxbh?>"></script>
<script language="javascript" src="<?=weburl?>js/header.js?t=<?=$glosxbh?>"></script>

<link rel="stylesheet" href="../../css/index.css">
</head>

<body>
<? include("../../../tem/top.html");?>
<? include("../../../tem/top1.html");?>

<div id="container" class="container">
        <div class="content category centralnav"> 
            <div id="primary" class="primary list"> 
            <script language="javascript">
                if (window.parent.length>0){window.parent.document.all.mainframe.style.height=document.body.scrollHeight;}
            </script>
            <div class="article" role="main">
                <div class="frame_tool">
                <div class="ti_too"> <span class="img"> <img src="https://cnmmm.com/skin/1.0/images/tool_css.gif" width="90" height="90" alt="CSS压缩/格式化工具"> </span>
                    <h2 class="h2">CSS压缩/格式化工具</h2>
                    <p class="p">在线css美化、格式化、压缩</p>
                    <div class="crumbs"> 当前位置：<a href="https://cnmmm.com/">主页</a> &gt; <a href="/tools/">菜鸟工具</a> &gt; <a href="/tools/css/">CSS压缩/格式化工具</a></div>
                </div>
                <div class="content_pg"><iframe frameborder="0" height="504" id="web" name="web" onload="this.height=web.document.body.scrollHeight+20" src="https://cnmmm.com/tools/tool/css.html" width="100%"></iframe></div>
                </div>
            </div>
            <div id="sidebar" class="sidebar-container" role="complementary">
                <div class="sidebar-inner">
                <aside id="hot-posts" class="widget hot-posts">
                    <h3 class="widget-title"><i class="fa fa-file-archive-o"></i>其它工具</h3>
                    <ul>
                    
                    <li> <a class="thumb" href="/tools/css/" title=""> <img width="50" height="50" src="/skin/1.0/images/tool_css.gif"> </a>
                        <div class="meta"> <a href="/tools/css/"><b>CSS压缩/格式化工具</b></a> <span style="color:#999;">在线css美化、格式化、压缩</span> </div>
                    </li>
                    
                    <li> <a class="thumb" href="/tools/Js/" title=""> <img width="50" height="50" src="/skin/1.0/images/tool_js.gif"> </a>
                        <div class="meta"> <a href="/tools/Js/"><b>Js压缩/格式化工具</b></a> <span style="color:#999;">在线js美化、压缩、解压缩、混淆</span> </div>
                    </li>
                    
                    <li> <a class="thumb" href="/tools/robots/" title=""> <img width="50" height="50" src="/skin/1.0/images/tool_robots.gif"> </a>
                        <div class="meta"> <a href="/tools/robots/"><b>robots.txt文件生成工具</b></a> <span style="color:#999;">该功能可以帮助站长不了解robots协议快速生成robots.txt文件</span> </div>
                    </li>
                    
                    <li> <a class="thumb" href="/tools/dxx/" title=""> <img width="50" height="50" src="/skin/1.0/images/tool_dxx.gif"> </a>
                        <div class="meta"> <a href="/tools/dxx/"><b>字母大小写转换工具</b></a> <span style="color:#999;">字母大小写转换工具,可以方便快速的转换字母的大小写.</span> </div>
                    </li>
                    
                    <li> <a class="thumb" href="/tools/html/" title=""> <img width="50" height="50" src="/skin/1.0/images/tool_html.gif"> </a>
                        <div class="meta"> <a href="/tools/html/"><b>JS/HTML格式化工具</b></a> <span style="color:#999;">简单易用的JS/HTML格式化工具</span> </div>
                    </li>
                    
                    <li> <a class="thumb" href="/tools/htmljs/" title=""> <img width="50" height="50" src="/skin/1.0/images/tool_jshtml.gif"> </a>
                        <div class="meta"> <a href="/tools/htmljs/"><b>HTML/JS转换工具</b></a> <span style="color:#999;">htmljs代码互转,html代码转换为js代码.</span> </div>
                    </li>
                    
                    </ul>
                </aside>
               
                </div>
            </div>
            </div>
        </div>
    </div>



<? include("../../../tem/bottom.html");?>
</body>
</html>