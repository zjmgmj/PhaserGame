<?php

	include "conn.php";
	
	$user=$_POST["user"];
	$password=$_POST["password"];
	$time=date("Y-m-d H:i:s");;
	
	
	
	$idSql=mysqli_query($conn,"select max(id) from USER");
	$getid=mysqli_fetch_row($idSql);
	$id=$getid[0]+1;
	
	
	$verification="select user from USER where user='{$user}'";
	$res_ver=mysqli_query($conn, $verification);
	$res_user=mysqli_fetch_row($res_ver);
	if($res_user[0]==$user){
		echo "用户已注册";
		exit();
	}
	
	
	$query="insert into USER(id,user,password,regTime) values('{$id}','{$user}','{$password}','{$time}')";
	$result=mysqli_multi_query($conn,$query);
	if($result){
		echo "注册成功";
	}else{
		echo "注册失败";
	}
	

?>