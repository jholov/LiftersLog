<!DOCTYPE html>

<?php

    $hs= "localhost";
    $us= "root";
    $ps = "";
    $db = "user_logindb";

    $mysql_connect = mysqli_connect("$hs","$us","$ps","$db");
    mysqli_select_db($mysql_connect,$db);
    
    if($mysql_connect === false){
       // die("mysql is not connected");
    }
    else
    {
       // echo("mysql is connected");
    }
    //checks login credentials
    if(isset($_POST['uname'])){
        $username=$_POST['uname'];
        $password=$_POST['pass'];

        $sql="Select * from loginform where User='".$username."' AND Pass='".$password."' limit 1";

        $result=mysqli_query($mysql_connect,$sql);

        if(mysqli_num_rows($result)==1){
            echo("You Have Successfully Logged in");

            //starts the session after log in
            session_start();
            $session_id = session_id();
            $_SESSION['username'] = $username;
            header("Location: exercise.html");
            exit();
        }
        else
        {
            echo("You Have Entered Incorrect Password");
            
        }


    }

        //signup page retrievals
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $newuser = $_POST['newuname'];
        $newpass = $_POST['newpass'];
        $confirmpass =$_POST['confirmpass'];
        $ID = abs( crc32(uniqid()));

        //grabs usernames to check if inputted one is in use
        $sql2="Select * from loginform where User='".$newuser."' limit 1";
        $result2=mysqli_query($mysql_connect,$sql2);

        $conn = new mysqli("$hs", "$us", "$ps", "$db");

        if($firstname =="" || $lastname =="" || $newuser=="" || $newpass==""){
            echo ("Please Fill in Missing Information");
        }else if($newpass != $confirmpass){
            echo ("Your Passwords Do Not Match");
        }else if(mysqli_num_rows($result2)==1){
            echo ("Your Username is Already Being Used, Pick Another");
        }
        else
        {   
            //inserts for new users
            $stmt = $mysql_connect->prepare("insert into users(first_name, last_name, user_name, password)
            values(?, ?, ?, ?)");

            $stmt->bind_param("ssss", $firstname, $lastname, $newuser, $newpass);
            $stmt->execute();

            //inserts for loginform
            $stmt2 = $mysql_connect->prepare("insert into loginform(ID, User, Pass)
            values(?, ?, ?)");

            $stmt2->bind_param("iss",$ID, $newuser, $newpass);
            $stmt2->execute();

            echo "registration Successfully";
            $stmt->close();
            $stmt2->close();
            $conn->close();
        }

     
    

?>