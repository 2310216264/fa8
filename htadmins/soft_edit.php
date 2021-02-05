<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

$id=$_GET[id];
while0("*","yjcode_soft where id='".$id."'");if(!$row=mysqli_fetch_array($res)){php_toheader("soft_list.php");}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/product.css" rel="stylesheet" type="text/css" />
<link href="css/tool.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu3").className="a1";
</script>

<div class="yjcode">
    <? $leftid=4;include("menu_product.php");?>
    <div class="right">
    	<div class="bqu1">
			<a href="javascript:void(0);" class="a1">软件编辑</a>
			<a href="soft_list.php">返回列表</a>
		</div> 
		<div class="rkuang">
			<form name="f1" id="tf" method="post" enctype="multipart/form-data">
				<input type="hidden" name="soft_type" value="soft_update">
				<input type="hidden" name="id" value="<?=$row[id]?>">
				<ul class="uk">
				<li class="l1">缩略图：</li>
				<li class="l2">
					<div id="upload">
                        <input type="file" id="file" multiple="multiple" name="soft_img" size="250" value="" accept=".jpg,.gif,.jpeg,.png">
                        <span class="inptp" id="xuanze">选择图片上传</span>
                    </div>
				</li>
				<div id="dis_img">
				<li class="l1"></li>
				<li class="l2" style="height:110px;">
				<div class="xgtp" style="margin:0px;">
                    <div id="xgtp2">
                        <div class="d1">
                            <img src="/soft/upload/<?=$row[soft_img]?>" id="img" class="img" alt="" width="75px" height="75px">
                        </div>
                    </div>
                </div>
                </li>
                </div>
                <li class="l1">软件分组：</li>
				<li class="l2">
					<select name="soft_type_id" class="inp" style="width:200px;" id="soft_type_id">
						<option value="0">软件分组</option>
						<?
						while1("*","yjcode_soft_type where level=1 order by id asc");while($row1=mysqli_fetch_array($res1)){
						?>
						<option value="<?=$row1[id]?>" <?if($row[soft_type_id] == $row1[id]){?>selected<?}?>><?=$row1[soft_type_name]?></option>
							<?
							while2("*","yjcode_soft_type where fid=".$row1[id]." and level=2 order by id asc");while($row2=mysqli_fetch_array($res2)){
							?>
							<option <?if($row[soft_type_id] == $row2[id]){?>selected<?}?> value="<?=$row2[id]?>">——<?=$row2[soft_type_name]?></option>
						<? }}?>
					 </select>
				</li>
				<li class="l1">名称：</li>
				<li class="l2"><input type="text" class="inp" size="50" name="soft_name" id="soft_name" value="<?=$row[soft_name]?>"/></li>
				<li class="l1">关键词：</li>
				<li class="l2"><input type="text" value="<?=$row[soft_seokey]?>" class="inp" size="70" name="soft_seokey" /></li>
				<li class="l4">描述：</li>
				<li class="l5"><textarea name="soft_seodes" id="soft_seodes"><?=$row[soft_seodes]?></textarea></li>
				
				<li class="l1">大小：</li>
				<li class="l2"><input type="text" class="inp" name="soft_size" value="<?=$row[soft_size]?>" /></li>
				<li class="l1">系统位数：</li>
				<li class="l2">
					<label><input name="soft_xtsize[]" type="checkbox" <? if(strstr($row[soft_xtsize],49)){?>checked="checked"<? }?> value="1"/> 32位</label>
					<label><input name="soft_xtsize[]" type="checkbox" <? if(strstr($row[soft_xtsize],50)){?>checked="checked"<? }?> value="2" /> 64位</label>
				</li>
				<li class="l1">语言：</li>
				<li class="l2">
					<label><input name="soft_change" type="radio" <?if($row[soft_change]==1){?>checked="checked" <?}?> value="1" /> 中文</label>
					<label><input name="soft_change" type="radio" <?if($row[soft_change]==2){?>checked="checked" <?}?> value="2" /> 英文</label>
				</li>
				<li class="l1">授权方式：</li>
				<li class="l2">
					<label><input name="soft_auth" type="radio" <?if($row[soft_auth]==1){?>checked="checked" <?}?> value="1" /> 免费版</label>
					<label><input name="soft_auth" type="radio" <?if($row[soft_auth]==2){?>checked="checked" <?}?> value="2" /> 共享版</label>
					<label><input name="soft_auth" type="radio" <?if($row[soft_auth]==3){?>checked="checked" <?}?> value="3" /> 收费版</label>
				</li>
				<li class="l1">适合系统：</li>
				<li class="l2">
					<label><input name="soft_xttype[]" type="checkbox" <? if(strstr($row[soft_xttype],49)){?>checked="checked"<? }?> value="1" /> Win7</label>
					<label><input name="soft_xttype[]" type="checkbox" <? if(strstr($row[soft_xttype],50)){?>checked="checked"<? }?> value="2" /> Win8</label>
					<label><input name="soft_xttype[]" type="checkbox" <? if(strstr($row[soft_xttype],51)){?>checked="checked"<? }?> value="3" /> Win10</label>
					<label><input name="soft_xttype[]" type="checkbox" <? if(strstr($row[soft_xttype],52)){?>checked="checked"<? }?> value="4" /> WinVista</label>
					<label><input name="soft_xttype[]" type="checkbox" <? if(strstr($row[soft_xttype],53)){?>checked="checked"<? }?> value="5" /> WinXP</label>
					<label><input name="soft_xttype[]" type="checkbox" <? if(strstr($row[soft_xttype],54)){?>checked="checked"<? }?> value="6" /> MacOS</label>
				</li>
				<li class="l1">网盘地址：</li>
				<li class="l2"><input type="text" value="<?=$row[soft_path]?>" class="inp" size="70" name="soft_path" id="soft_path"/></li>
				<li class="l1">网盘密码：</li>
				<li class="l2"><input type="text" class="inp" name="soft_pass" value="<?=$row[soft_pass]?>" /></li>
				<li class="l1">人气：</li>
				<li class="l2"><input type="text" class="inp" name="soft_renqi" value="<?=$row[soft_renqi]?>" /></li>
				<li class="l1">上架/下架：</li>
				<li class="l2">
					<label><input name="soft_states" type="radio" <?if($row[soft_states]==1){?>checked="checked" <?}?> value="1" /> 上架</label>
					<label><input name="soft_states" type="radio" <?if($row[soft_states]==2){?>checked="checked" <?}?> value="2" /> 下架</label>
				</li>
				</ul>
				
				<!--<ul class="rcap"><li class="l1"></li><li class="l2">辅助参数</li><li class="l3"></li></ul>-->
				<ul class="uk">
				
				
				<li class="l3"><input type="button" value="保存修改" class="btn1" onclick="dosub();" /></li>
				</ul>
			</form>
		</div>
    </div>
</div>
<script>
$(function () {
    $("#file").change(function (e) {
        var file = e.target.files[0] || e.dataTransfer.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function () {
                $("#img").attr("src", this.result);
                $("#xuanze").text('重新选择');
            }
            reader.readAsDataURL(file);
        }
    });
})

function dosub(obj){
	if((document.getElementById("soft_type_id").value).replace(/\s/,"")=="0"){layer.msg("请选择软件分组");return false;}
    if((document.getElementById("soft_name").value).replace(/\s/,"")==""){layer.msg("请输入软件名称");return false;}
    if((document.getElementById("soft_seodes").value).replace(/\s/,"")==""){layer.msg("请输入软件描述");return false;}
    if((document.getElementById("soft_path").value).replace(/\s/,"")==""){layer.msg("请输入下载地址");return false;}
    var formData = new FormData(document.getElementById("tf"));
    $.ajax({
        type: 'POST',
        url: 'yjadmin_soft.php', 
        data: formData,
	    dataType: "json",
	    processData : false, // 使数据不做处理
        contentType : false, // 不要设置Content-Type请求头
        success: function (data) {
        	// console.log(data);
			if(data.code == 1){
				layer.msg(data.msg,{time:2000},function(){
					window.location.href=data.data;  
				})
		    }else{
				layer.msg(data.msg);
			}
        }
    })		 
	return false;			 
}
</script>
</body>
</html>

