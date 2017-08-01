<?php
include "conn.php";

$user=$_POST['user'];
$password=$_POST['password'];



$query = "SELECT password FROM USER where user='{$user}'";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_row($result);



if($password==$row[0]){
	echo "登陆成功";
}else{
	echo "登陆失败";
}

mysqli_close($conn);
?>