<?php
include("../config/conn.php");
include("../config/function.php");
sesCheck();
//获取用户信息
$sj=date("Y-m-d H:i:s");

//推荐位置信息
$sqltuijian="select * from yjcode_tuijian where id='".$_POST[tuijian_id]."'";mysqli_set_charset($conn,"utf8");$restuijian=mysqli_query($conn,$sqltuijian);
$rowtuijian=mysqli_fetch_array($restuijian);

//位置状态
if($rowtuijian[zt]==0){
	//商品是否已经推荐
	$sqltuijian1="select * from yjcode_tuijian where pro_bh='".$_POST[pro_bh]."' and user_id='".$_POST[uid]."'";mysqli_set_charset($conn,"utf8");$restuijian1=mysqli_query($conn,$sqltuijian1);
	$rowtuijian1=mysqli_fetch_array($restuijian1);
	
	if(!$rowtuijian1){
		
		if($_POST[uid]){
			//获取用户信息
			$sqluser="select id,money1,uid,nc from yjcode_user where uid='".$_POST[uid]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
			$rowuser=mysqli_fetch_array($resuser);
			$money1 = str_replace("-0.00","0",sprintf("%.2f",$rowuser[money1]));
			
			//获取商品信息
			if($_POST[pro_bh]){
				$pro_bh = $_POST[pro_bh];//商品编码
				$sqlpro="select * from yjcode_pro where bh='".$pro_bh."'";mysqli_set_charset($conn,"utf8");$respro=mysqli_query($conn,$sqlpro);
				$rowpro=mysqli_fetch_array($respro);
				if($rowpro){
					
					//商品审核通过
					if($rowpro[zt]==0){
						$tancan_id = $_POST[R1];//套餐ID
						//获取套餐信息
						$sqlyouhui="select * from yjcode_youhui where id='".$tancan_id."' and type=1";mysqli_set_charset($conn,"utf8");$resyouhui=mysqli_query($conn,$sqlyouhui);
						$rowyouhui=mysqli_fetch_array($resyouhui);
						
						//计算  按月计算  到期时间
						if($rowyouhui[d1]==0){
							$kai_time = $rowyouhui[das].'月';//开通时间
							// $zhekou = $rowyouhui[zhekou];//折扣
							// $weizhi_price = $rowtuijian[price];//位置价格
							
							$s_price = $rowyouhui[das]*$rowtuijian[price];
							$e_price = $s_price*($rowyouhui[zhekou]/10);//折扣的价格
							
							$add_time = "+".$rowyouhui[das]."month";
							$end_time = date('Y-m-d H:i:s',strtotime($add_time));//到期时间
							
						// 按年计算
						}else{
							$kai_time = $rowyouhui[das].'年';//开通时间
							// $zhekou = $rowyouhui[zhekou];//折扣
							// $weizhi_price = $rowtuijian[price];//位置价格
							
							$s_price = $rowyouhui[das]*12*$rowtuijian[price];
							$e_price = $s_price*($rowyouhui[zhekou]/10);//折扣的价格
							
							$add_time = "+".$rowyouhui[das]."year";
							$end_time = date('Y-m-d H:i:s',strtotime($add_time));//到期时间
						
							
						}
						//余额是否充足
						if($money1>$e_price){
							
							//修改位置信息  扣除余额
							$tjtable = "yjcode_tuijian";
							$ures = "pro_bh='".$pro_bh."',user_id='".$_POST[uid]."',user_name='".$rowuser[nc]."',end_time='".$end_time."',zt=1 where id=".$_POST[tuijian_id];
							$sqlupdate="update ".$tjtable." set ".$ures;
							mysqli_set_charset($conn,"utf8");
							$res = mysqli_query($conn,$sqlupdate);
							
							$e_prices=sprintf("%.2f",$e_price);
							updatetable("yjcode_user","money1=money1-(".$e_prices.") where id=".intval($rowuser[id]));
							
							if($res){
								
								//购买记录
								$itable = "yjcode_tuijianlog";
								$zdarr = "tj_bh,tj_type,user_id,user_name,pro_bh,pro_time,pro_price,start_time,end_time";
								$resarr = "'".$rowtuijian[bianhao]."',".$rowtuijian[type].",'".$_POST[uid]."','".$rowuser[nc]."','".$pro_bh."','".$kai_time."','".$e_price."','".$sj."','".$end_time."'";
								$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";
								mysqli_set_charset($conn,"utf8");
								mysqli_query($conn,$sqlinto);
								//购买记录
								
								//消费记录
								$e_prices=$e_price*(-1);
								PointIntoM($rowuser[id],"购买".$rowtuijian[bianhao]."推荐位置".$kai_time,$e_prices);
								//消费记录
								echo json_encode([code=>'1',msg=>'购买成功',data=>'product_mytuijian.php']);
							}else{
								
								echo json_encode([code=>'0',msg=>'购买失败',data=>'']);	
							}
							
						}else{
							echo json_encode([code=>'2',msg=>'余额不足！',data=>'pay.php']);return false;
						}
						//余额是否充足
						
					}else{
						echo json_encode([code=>'0',msg=>'商品未审核或审核未通过！',data=>'']);return false;
					}
					//商品审核通过
					
				}else{
					//商品不存在
					echo json_encode([code=>'0',msg=>'商品不存在！',data=>'']);return false;
				}
			}
			//获取商品信息
		}
		
	}else{
		echo json_encode([code=>'0',msg=>'商品已推荐，不能重复推荐！',data=>'']);return false;
	}
	//商品是否已经推荐
	
}else{
	echo json_encode([code=>'0',msg=>'位置使用中！',data=>'']);return false;
}
//位置是否闲置
mysqli_close($conn);



//用户同个商品不能重复推荐
//用户信息
//商品信息
//位置信息
//套餐信息
//推荐记录
//积分记录
//扣除用户积分


