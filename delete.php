<?php
include 'conn.php';
$deletData='1';
//删除数据
$delet = mysqli_query($conn, "DELETE FROM USER WHERE id='{$deletData}'");
if ($delet) {
	echo "删除成功<br/>";
} else {
	echo "删除失败<br/>";
}

include 'result.php';
?>