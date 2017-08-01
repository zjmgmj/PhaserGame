<?php
include 'session.php';

include 'conn.php';

//查询读取
$result = mysqli_query($conn, "SELECT * FROM USER");

while ($row = mysqli_fetch_array($result)) {
	$user = array('id' => $row["id"], 'user' => $row["user"], 'password' => $row["password"], 'level' => $row["level"], 'time' => $row["time"],'msg'=>'1');
	$data[] = $user;
	
	/*echo $row["id"].' '.$row["user"].' '.$row["password"].' '.$row["level"].' '.$row["time"];
	echo "<br/>";*/
}

$json = json_encode($data);
echo "{" . '"user"' . ":" . $json . "}";

mysqli_close($conn);
?>