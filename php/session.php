<?php

session_start();

if ($_SESSION['islogin'] != '1') {
	$msg[] = array("msg" => '0', "user" => $_SESSION['user']);
	$json = json_encode($msg);
	echo "{" . '"user"' . ":" . $json . "}";
	//header("Location: login.php");
	exit();
}

$msg[] = array("msg" => '1', "user" => $_SESSION['user']);
$msgJson = json_encode($msg);
//echo "{" . '"user"' . ":" . $msgJson . "}";

include "conn.php";

$result = mysqli_query($conn, "SELECT * FROM USER");

while ($row = mysqli_fetch_array($result)) {
	$user = array('id' => $row["id"], 'user' => $row["user"], 'password' => $row["password"], 'level' => $row["level"], 'time' => $row["time"], 'msg' => '1');
	$data[] = $user;
}

$json = json_encode($data);
echo "{" . '"user"' . ":" . $json . "," . '"msg"' . ":" . $msgJson . "}";


mysqli_close($conn);
?>