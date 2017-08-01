<?php
	session_start();
	if(!$_SESSION['islogin']){
		header("Location: login.php");
		exit;
	}
	
?>