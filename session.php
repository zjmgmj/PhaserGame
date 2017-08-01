<?php

session_start();

if ($_SESSION['islogin']!='1') {
	$msg[] = array("msg" => "0");
	$json = json_encode($msg);
	echo "{" . '"msg"' . ":" . $json . "}";
	//header("Location: login.php");
	exit();
}
?>