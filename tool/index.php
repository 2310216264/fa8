<?phpinclude("../config/conn.php");include("../config/function.php");include("../config/xy.php");$sj=date("Y-m-d H:i:s");if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}$px="order by id desc";?><html><head><meta http-equiv="x-ua-compatible" content="ie=7" /><meta http-equiv="Content-Type" content="text/html; charset=utf8" /><title>软件工具 - <?=webname?></title><? include("../tem/cssjs.html");?><link rel="stylesheet" href="./css/index.css"><!--<link rel="stylesheet" href="./css/tool.css">--></head><body><? include("../tem/top.html");?><? include("../tem/top1.html");?><div id="banner_tool">  <h1>前端工具库</h1>  <h2>简单、直观、强悍的前端工具仓库，让Web前端开发更迅速。</h2></div><div class="yjcode"  style="width:1260px;">	<!--前端必备软件-->    <div class="tool_box" style="width:1260px;max-width:1260px;">    	<div class="cn_nav"> <span class="title">前端必备软件</span> </div>    	<ul class="iconlist">    	<?            $ses=" where id<>1000";            // $page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}            pagef($ses,24,"yjcode_tool",$px);while($row=mysqli_fetch_array($res)){        ?>	        <li>            <img class="icon" src="/tool/upload/<?=$row['tool_img']?>">            <div class="info cl">                <h3><?=$row['tool_name']?></h3>                <p><?=$row['tool_title']?></p>                <span>提取码：<?=$row['tool_tqm']?></span>                <a href="<?=$row['tool_link']?>" class="btn btn-primary" target="_blank">下载</a>             </div>         </li>    	<? }?>        </ul>	</div>	<div class="npa">	<?	$nowurl="search";	$nowwd="";	require("../tem/page.html")	?>	</div></div><? include("../tem/bottom.html");?></body></html>