<?php
session_start();

include "conn.php";

$user=$_POST['user'];
$password=$_POST['password'];
$loginTime=date("Y-m-d H:i:s");


$query = "SELECT password FROM USER where user='{$user}'";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_row($result);



if($password==$row[0]){
	$insertQuery="update USER set loginTime='{$loginTime}' where user='{$user}'";
	mysqli_query($conn, $insertQuery);
	
	$_SESSION = array();
	
	$_SESSION["user"]=$user;
	$_SESSION['islogin'] = true;
	
	echo "登陆成功";
}else{
	echo "登陆失败";
}

mysqli_close($conn);
?>