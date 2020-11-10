<?php

/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digitalmtx_dtmmtx";
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
//mysql_set_charset('utf8',$conn);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}