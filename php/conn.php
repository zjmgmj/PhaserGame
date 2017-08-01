<?php
$dbhost = "148.66.136.137";
$username = "zhjm";
$userpass = "ZHJM520gmj620";
$dbdatabase = "H5game";
//链接数据库
$conn = mysqli_connect($dbhost, $username, $userpass, $dbdatabase);
if (mysqli_connect_error()) {
	echo '失败';
	exit();
}
?>