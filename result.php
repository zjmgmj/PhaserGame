<?php
include 'conn.php';
//查询读取
$result = mysqli_query($conn, "SELECT * FROM USER");
while ($row = mysqli_fetch_array($result)) {
	echo $row['id'] . " " . $row['user'] ." ". $row['password'];
	echo "<br/>";
}
mysqli_close($conn);
?>