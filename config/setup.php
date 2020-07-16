<?php

$db = "supportdb";
$pwd = "";
$host = "localhost";

$con = mysqli_connect($host, $db, $pwd);

if(mysqli_connect_error()){
	echo "Failed to establish database connection.";
	die();
}

?>