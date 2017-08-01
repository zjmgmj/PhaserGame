<?php

session_start();

if ($_SESSION['islogin']!='1') {
	$msg[] = array("msg" => '0');
	$json = json_encode($msg);
	echo "{" . '"user"' . ":" . $json . "}";
	//header("Location: login.php");
	exit();
}
?>