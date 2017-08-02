<?php

session_start();
include "conn.php";


$currerUser=$_SESSION['user'];


if ($_SESSION['islogin'] != '1') {
	$msg[] = array("msg" => '0', "user" => $currerUser);
	$json = json_encode($msg);
	echo "{" . '"user"' . ":" . $json . "}";
	//header("Location: login.php");
	exit();
}


$inquire="select level from USER where user='{$currerUser}'";
$inquireResult=mysqli_query($conn, $inquire);
$inResultVal=mysqli_fetch_row($inquireResult);
$currer[] = array("msg" => '1', "user" => $currerUser,"level"=>$inResultVal[0]);
$currerJson = json_encode($currer);


$result = mysqli_query($conn, "SELECT * FROM USER");

while ($row = mysqli_fetch_array($result)) {
	$user = array('id' => $row["id"], 'user' => $row["user"], 'password' => $row["password"], 'level' => $row["level"], 'time' => $row["time"], 'msg' => '1');
	$data[] = $user;
}

$json = json_encode($data);
echo "{" . '"user"' . ":" . $json . "," . '"msg"' . ":" . $currerJson . "}";


mysqli_close($conn);
?>