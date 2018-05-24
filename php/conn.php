<?php
$dbhost = "";
$username = "";
$userpass = "";
$dbdatabase = "";
//链接数据库
$conn = mysqli_connect($dbhost, $username, $userpass, $dbdatabase);
if (mysqli_connect_error()) {
	echo '失败';
	exit();
}
?>
