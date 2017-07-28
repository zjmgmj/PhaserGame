<?php
/*$dbhost="148.66.136.137";
 $username="zhjm";
 $userpass="ZHJM520gmj620";
 $dbdatabase="H5game";
 $link=mysqli_connect($dbhost,$username,$userpass,$dbdatabase);*/
$link = mysqli_connect("148.66.136.137", "zhjm", "ZHJM520gmj620", "H5game");
if (mysqli_connect_error()) {
	echo '失败';
	exit() ;
}
/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

/* Create table doesn't return a resultset */
if (mysqli_query($link, "CREATE TEMPORARY TABLE myCity LIKE test") === TRUE) {
	printf("Table myCity successfully created.\n");
}

/* Select queries return a resultset */
if ($result = mysqli_query($link, "SELECT * FROM `test` LIMIT 0")) {
	
	printf("Select returned %d rows.\n", mysqli_num_rows($result));

	/* free result set */
	mysqli_free_result($result);
}
/* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
if ($result = mysqli_query($link, "SELECT * FROM test", MYSQLI_USE_RESULT)) {

    /* Note, that we can't execute any functions which interact with the
       server until result set was closed. All calls will return an
       'out of sync' error */
    if (!mysqli_query($link, "SET @a:='this will not work'")) {
       // printf("Error: %s\n", mysqli_error($link));
    }
    mysqli_free_result($result);
}
//mysqli_close($link);


?>
