<?php
session_start();

include "conn.php";


$user=$_SESSION['user'];
$level=$_POST['level'];

/*$user='z123';
$level='2';*/

echo $user;

/*$query="update USER set level='{$level}' WHERE user='{$user}'";
$update=mysqli_query($conn,$query);
if ($update) {
	echo "修改成功<br/>";
} else {
	echo "修改失败<br/>";
}*/


mysqli_close($conn);
?>