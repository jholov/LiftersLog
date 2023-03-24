<!DOCTYPE html>

<?php

    $hs= "localhost";
    $us= "root";
    $ps = "";
    $db = "user_logindb";

    $mysql_connect = mysqli_connect("$hs","$us","$ps");
    mysqli_select_db($mysql_connect,$db);
    
    if($mysql_connect === false){
        die("mysql is not connected");
    }
    else
    {
        echo("mysql is connected");
    }

    if(isset($_POST['uname'])){
        $username=$_POST['uname'];
        $password=$_POST['pass'];

        $sql="Select * from loginform where User='".$username."' AND Pass='".$password."' limit 1";

        $result=mysqli_query($mysql_connect,$sql);

        if(mysqli_num_rows($result)==1){
            echo("You Have Successfully Logged in");
            exit();
        }
        else
        {
            echo("You Have Entered Incorrect Password");
            exit();
        }

    }

    if(isset($_POST['signbtn'])){
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $newuser = $_POST['newuname'];
        $newpass = $_POST['newpass'];

        //datebase insert SQL code
        $newsql = "INSERT INTO 'users'('first_name', 'last_name', 'user_name', 'password') VALUES ('$firstname', '$lastname', '$newuser', '$newpass')";

        //insert into database
        $nu = mysqli_query($mysql_connect, $newsql);

        if($nu)
        {
        echo("You Have Successfully Signed Up!");
        }

    }

?>