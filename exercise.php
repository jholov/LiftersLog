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

session_start();
$username = $_SESSION['username'];
$exercise=$_POST['wt_exercises'];
$weight=$_POST['wt'];
$sets=$_POST['sets'];
$reps=$_POST['reps'];

if($exercise != ""){
    //prepares the SQl statement
    $stmt = mysqli_prepare($mysql_connect, "INSERT INTO wt_exercises(user_name, exercise, weight_lbs, number_sets, number_reps) VALUES (?, ?, ?, ?, ?)");

    //binds the parameters and execute the statement
    $stmt->bind_param("ssiii", $username, $exercise, $weight, $sets, $reps);

    $stmt->execute();
    if (mysqli_affected_rows($mysql_connect) > 0) {
        echo "Data inserted successfully.";
      } else {
        echo "Error inserting data.";
        echo mysqli_error($mysql_connect);
      }
    
    mysqli_stmt_close($stmt);
    mysqli_close($mysql_connect);

  } else {
    echo "Please Pick a Exercise";
   }

//if (mysqli_affected_rows($mysql_connect) > 0) {
   // echo "Data inserted successfully.";
 // } else {
   // echo "Error inserting data.";
   // echo mysqli_error($mysql_connect);
  //}

//mysqli_stmt_close($stmt);
//mysqli_close($mysql_connect);

?>