<?php
session_start();

include "conn.php";

//$id='';
$user=$_SESSION['user'];
//$password='';
$level=$_POST['level'];
//$time='';


$query="update USER set user='{$user}',password='{$password}',level='{$level}',time='{$time}' WHERE user='{$user}'";
$update=mysqli_query($conn,$query);
if ($update) {
	echo "修改成功<br/>";
} else {
	echo "修改失败<br/>";
}

include "result.php";
?>