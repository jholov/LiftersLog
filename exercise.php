<?php

$hs= "localhost";
$us= "root";
$ps = "";
$db = "user_logindb";

$mysql_connect = mysqli_connect("$hs","$us","$ps","$db");
mysqli_select_db($mysql_connect,$db);

if($mysql_connect === false){
    die("mysql is not connected");
}
else
{
    echo("mysql is connected");
}

$user= "Select * from loginform where User ='".$_SESSION['User']."';





?>