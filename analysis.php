<?php

$hs= "localhost";
$us= "root";
$ps = "";
$db = "user_logindb";

$mysql_connect = mysqli_connect("$hs","$us","$ps","$db");
mysqli_select_db($mysql_connect,$db);

if($mysql_connect === false){
    //die("mysql is not connected");
}
else
{
    //echo("mysql is connected");
}

session_start();

//wt exercise information grab
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*$sql="SELECT user_name, exercise, muscle_group, date_time 
          FROM wt_exercises 
          WHERE user_name='$username'";

   $retval = mysqli_query($mysql_connect, $sql);

   $counts = array();
   while ($row = mysqli_fetch_assoc($retval)){
    $muscle_group = $row['muscle_group'];
    if(array_key_exists($muscle_group, $counts)){
        $counts[$muscle_group]++;
    }else {
        $counts[$muscle_group] = 1;
    }
   }
 //finds the muscle group with the highest count
   arsort($counts);
   $highest_count = reset($counts);
   $highest_muscle_group = key($counts);
   $most_active ="";
   $sql2="SELECT exercise
          FROM wt_exercises
          WHERE muscle_group = '$highest_count'";
    
    $retval2 = mysqli_query($mysql_connect, $sql2);
                       
    if(mysqli_num_rows($retval2) > 0){
        while ($row = mysqli_fetch_assoc($retval2)){
           $most_active = $row['exercise'];
        }
    }
   
   echo "You seem to be targeting your " . $most_active ."  a lot. Here are some other exercises that might be helpful:<br>";
   while ($row = mysqli_fetch_assoc($retval2)) {
       echo "- " . $row['exercise'] . "<br>";
   }*/


    
    $sql="SELECT user_name, exercise, muscle_group, date_time 
          FROM wt_exercises 
          WHERE user_name='$username'";

    $retval = mysqli_query($mysql_connect, $sql);

    $counts = array();
    while ($row = mysqli_fetch_assoc($retval)){
        $muscle_group = $row['muscle_group'];
        if(array_key_exists($muscle_group, $counts)){
            $counts[$muscle_group]++;
        }else {
            $counts[$muscle_group] = 1;
        }
    }

    arsort($counts);
    $highest_count = reset($counts);
    $highest_muscle_group = key($counts);
    $least_count = end($counts);
    $least_muscle_group = key(array_slice($counts, -1, 1, true));

    $sql2="SELECT exercise
           FROM wt_exercises
           WHERE muscle_group = '$highest_muscle_group'";

    $retval2 = mysqli_query($mysql_connect, $sql2);

    if ($retval2 === false) {
        echo "Error: " . mysqli_error($mysql_connect);
        exit;
    }

    echo "You seem to be targeting your " . $highest_muscle_group ." a lot. Here are some other exercises that might be helpful:<br>";
    while ($row2 = mysqli_fetch_assoc($retval2)) {
        echo "- " . $row2['exercise'] . "<br>";
    }

    echo "You seem to be targeting your " . $least_muscle_group ." the least. Here are some exercises that might help you improve:<br>";
    $sql3="SELECT exercise
           FROM wt_exercises
           WHERE muscle_group = '$least_muscle_group'";
    
    $retval3 = mysqli_query($mysql_connect, $sql3);

    if ($retval3 === false) {
        echo "Error: " . mysqli_error($mysql_connect);
        exit;
    }

    while ($row3 = mysqli_fetch_assoc($retval3)) {
        echo "- " . $row3['exercise'] . "<br>";
    }
}
