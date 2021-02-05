<?php
//软件操作

include("../config/conn.php");
include("../config/function.php");
$sj=date("Y-m-d H:i:s");

//获取类别名称
function softtypename($id){
	global $conn;
	$sqluy="select soft_type_name from yjcode_soft_type where id='".$id."'";mysqli_set_charset($conn,"utf8");
	$resuy=mysqli_query($conn,$sqluy);
	$rowname=mysqli_fetch_array($resuy,MYSQLI_ASSOC);
	return $rowname['soft_type_name'];
}

//判断类别名称是否存在
function panname($name){
	global $conn;
	$sqluy="select soft_type_name from yjcode_soft_type where soft_type_name='".$name."'";mysqli_set_charset($conn,"utf8");
	$resuy=mysqli_query($conn,$sqluy);
	$rowname=mysqli_fetch_array($resuy,MYSQLI_ASSOC);
	if($rowname){
		return 1;
	}else{
		return 0;
	}
}

//添加软件信息
if($_POST['soft_type'] == 'soft_insert'){
	$xttype = implode(',',$_POST[soft_xttype]);//系统类型
	$xtsize = implode(',',$_POST[soft_xtsize]);//系统位数
	$typename = softtypename($_POST[soft_type_id]);//类别名称

	$srcname=$_FILES['soft_img']['name'];
    $info = pathinfo($_FILES['soft_img']['name']);
	$sub = $info['extension'];
	//源文件和目标文件
	$srcfile=$_FILES['soft_img']['tmp_name'];
	$dstname=time().'.'.$sub;
    $dstfile='../soft/upload/'.$dstname;
    if(move_uploaded_file($srcfile,$dstfile)){
    	
        $itable = "yjcode_soft";
		$zdarr = "soft_type_id,soft_type_name,soft_name,soft_img,soft_size,soft_xtsize,soft_xttype,soft_change,soft_auth,soft_path,soft_pass,soft_states,soft_seokey,soft_seodes,soft_addtime,soft_renqi";
		$resarr = "'".$_POST[soft_type_id]."','".$typename."','".$_POST[soft_name]."','".$dstname."','".$_POST[soft_size]."','".$xtsize."','".$xttype."','".$_POST[soft_change]."','".$_POST[soft_auth]."','".$_POST[soft_path]."','".$_POST[soft_pass]."','".$_POST[soft_states]."','".$_POST[soft_seokey]."','".$_POST[soft_seodes]."','".$sj."','".$_POST[soft_renqi]."'";
		$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";
		mysqli_set_charset($conn,"utf8");
		$res = mysqli_query($conn,$sqlinto);
		if(!$res){
			echo json_encode([code=>'0',msg=>'添加失败',data=>'soft_list.php']);
		}else{
			echo json_encode([code=>'1',msg=>'添加成功',data=>'soft_list.php']);	
		}
		mysqli_close($conn);
    }
}
//编辑软件信息
if($_POST['soft_type'] == 'soft_update'){
	$xttype = implode(',',$_POST[soft_xttype]);//系统类型
	$xtsize = implode(',',$_POST[soft_xtsize]);//系统位数
	$typename = softtypename($_POST[soft_type_id]);//类别名称

	$id=$_POST[id];
	if(!empty($_FILES['soft_img']['tmp_name'])){
		//判断是否有图片修改
		$info = pathinfo($_FILES['soft_img']['name']);
		$sub = $info['extension'];
		$srcfile=$_FILES['soft_img']['tmp_name'];
		$dstname=time().'.'.$sub;
		$dstfile='../soft/upload/'.$dstname;
		if(move_uploaded_file($srcfile,$dstfile)){
			while0("*","yjcode_soft where id='".$id."'");if(!$row=mysqli_fetch_array($res));
			$path = "../soft/upload/".$row[soft_img];
			unlink($path);
			
			$utable = "yjcode_soft";
			$ures = "soft_type_name='".$typename."',soft_type_id='".$_POST[soft_type_id]."',soft_name='".$_POST[soft_name]."',soft_img='".$dstname."',soft_size='".$_POST[soft_size]."',soft_xtsize='".$xtsize."',soft_xttype='".$xttype."',soft_change='".$_POST[soft_change]."',soft_auth='".$_POST[soft_auth]."',soft_path='".$_POST[soft_path]."',soft_pass='".$_POST[soft_pass]."',soft_states='".$_POST[soft_states]."',soft_seokey='".$_POST[soft_seokey]."',soft_seodes='".$_POST[soft_seodes]."',soft_renqi='".$_POST[soft_renqi]."' where id=".$_POST[id];
			$sqlupdate="update ".$utable." set ".$ures;
			mysqli_set_charset($conn,"utf8");
			$res = mysqli_query($conn,$sqlupdate);
			if(!$res){
				echo json_encode([code=>'0',msg=>'修改失败',data=>'soft_list.php']);
			}else{
				echo json_encode([code=>'1',msg=>'修改成功',data=>'soft_list.php']);	
			}
			mysqli_close($conn);
		}
	}else{
		$utable = "yjcode_soft";
		$ures = "soft_type_name='".$typename."',soft_type_id='".$_POST[soft_type_id]."',soft_name='".$_POST[soft_name]."',soft_size='".$_POST[soft_size]."',soft_xtsize='".$xtsize."',soft_xttype='".$xttype."',soft_change='".$_POST[soft_change]."',soft_auth='".$_POST[soft_auth]."',soft_path='".$_POST[soft_path]."',soft_pass='".$_POST[soft_pass]."',soft_states='".$_POST[soft_states]."',soft_seokey='".$_POST[soft_seokey]."',soft_seodes='".$_POST[soft_seodes]."',soft_renqi='".$_POST[soft_renqi]."' where id=".$_POST[id];
		$sqlupdate="update ".$utable." set ".$ures;
		mysqli_set_charset($conn,"utf8");
		$res = mysqli_query($conn,$sqlupdate);
		if(!$res){
			echo json_encode([code=>'0',msg=>'修改失败',data=>'soft_list.php']);
		}else{
			echo json_encode([code=>'1',msg=>'修改成功',data=>'soft_list.php']);	
		}
		mysqli_close($conn);
		
	}

}


//软件单个删除
if($_POST['soft_type'] == 'soft_onedel'){
	$id = $_POST['id'];
	$dsql = "yjcode_soft where id='".$id."'";
	$sqldelete="delete from ".$dsql;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqldelete);
	if(!$res){
		echo json_encode([code=>'0',msg=>'删除失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'删除成功',data=>'']);	
	}
	mysqli_close($conn);
}





//父类修改
if($_POST['soft_type'] == 'soft_edit'){
	$utable = "yjcode_soft_type";
	$ures = "soft_type_name='".$_POST[soft_type_name]."',soft_seokey='".$_POST[soft_seokey]."',soft_seodes='".$_POST[soft_seodes]."',sorts='".$_POST[sorts]."' where id=".$_POST[id];
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'修改失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'修改成功',data=>'']);	
	}
	mysqli_close($conn);
}

//添加父类
if($_POST['soft_type'] == 'soft_add'){
	
	$res = panname($_POST[soft_type_name]);
	if($res==1){
		echo json_encode([code=>'1',msg=>'分组名称已存在',data=>'']);
		die();
	}
	$itable = "yjcode_soft_type";
	$zdarr = "soft_type_name,soft_seokey,soft_seodes,sorts,add_time";
	$resarr = "'".$_POST[soft_type_name]."','".$_POST[soft_seokey]."','".$_POST[soft_seodes]."','".$_POST[sorts]."','".$sj."'";
	$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlinto);
	if(!$res){
		echo json_encode([code=>'0',msg=>'添加失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'添加成功',data=>'']);	
	}
	mysqli_close($conn);
}



//添加子类
if($_POST['soft_type'] == 'soft_sadd'){
	$res = panname($_POST[soft_type_name]);
	if($res==1){
		echo json_encode([code=>'1',msg=>'分组名称已存在',data=>'']);
		die();
	}
	$itable = "yjcode_soft_type";
	$zdarr = "fid,soft_type_name,soft_seokey,soft_seodes,sorts,add_time,level";
	$resarr = "'".$_POST[fid]."','".$_POST[soft_type_name]."','".$_POST[soft_seokey]."','".$_POST[soft_seodes]."','".$_POST[sorts]."','".$sj."','2'";
	$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlinto);
	if(!$res){
		echo json_encode([code=>'0',msg=>'添加失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'添加成功',data=>'']);	
	}
	mysqli_close($conn);
}


//子类修改
if($_POST['soft_type'] == 'soft_sedit'){
	$utable = "yjcode_soft_type";
	$ures = "soft_type_name='".$_POST[soft_type_name]."',soft_seokey='".$_POST[soft_seokey]."',soft_seodes='".$_POST[soft_seodes]."',sorts='".$_POST[sorts]."' where id=".$_POST[id];
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'修改失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'修改成功',data=>'']);	
	}
	mysqli_close($conn);
}



//分组删除
if($_POST['soft_type'] == 'soft_type_del'){
	$id = $_POST['id'];
	$dsql = "yjcode_soft_type where id='".$id."'";
	$sqldelete="delete from ".$dsql;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqldelete);
	if(!$res){
		echo json_encode([code=>'0',msg=>'删除失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'删除成功',data=>'']);	
	}
	mysqli_close($conn);
}




