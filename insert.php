<?php
include 'conn.php';

//插入数据
$sql="INSERT INTO USER (id,user,password) VALUES ('1','zhjm','zhjm520');";
/* $sql .="INSERT INTO USER (id,user,password) VALUES ('2','GMJ','123');";
 $sql .="INSERT INTO USER (id,user,password) VALUES ('3','zhjmgmj','456');";*/

 if(mysqli_multi_query($conn,$sql)){
 echo "插入成功<br/>";
 }else{
 echo "插入失败<br/>";
 }

include 'result.php';
?>
