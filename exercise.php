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

//wt exercise information grab
$username = $_SESSION['username'];
$exercise=$_POST['wt_exercises'];
$weight=$_POST['wt'];
$sets=$_POST['sets'];
$reps=$_POST['reps'];

//cd exercise information grab
$cd_exercise=$_POST['cardio_ex'];
$distance=$_POST['dist'];
$time=$_POST['time'];
$heartrate=$_POST['hrt_rate'];

//cali exercise information grab
$cali_exercise=$_POST['calist_ex'];
$cali_sets=$_POST['cal_sets'];
$cali_reps=$_POST['cal_reps'];


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
} else {
    echo "Please Pick a Weighted Exercise";
  }

if($cd_exercise != ""){
    //prepares the SQL statement
    $stmt2 = mysqli_prepare($mysql_connect, "INSERT INTO cd_exercises(user_name, exercise, distance_mi, time_min, heart_rate_bpm) VALUES (?, ?, ?, ?, ?)");

    //binds the parameters and execute the statement
    $stmt2->bind_param("ssddi", $username, $cd_exercise, $distance, $time, $heartrate);

    $stmt2->execute();
    if (mysqli_affected_rows($mysql_connect) > 0) {
      echo "Data inserted successfully.";
    } else {
      echo "Error inserting data.";
      echo mysqli_error($mysql_connect);
    }

    mysqli_stmt_close($stmt2);
   

}else{
  echo "Please Pick an Exercise";
}

if($cali_exercise != ""){
  //prepares the SQL statement
  $stmt3 = mysqli_prepare($mysql_connect, "INSERT INTO cali_exercises(user_name, exercise, number_sets, number_reps) VALUES (?, ?, ?, ?)");

  //binds the parameters and execute the statement
  $stmt3->bind_param("ssii", $username, $cali_exercise, $cali_sets, $cali_reps);

  $stmt3->execute();

  if (mysqli_affected_rows($mysql_connect) > 0) {
    echo "Data inserted successfully.";
  } else {
    echo "Error inserting data.";
    echo mysqli_error($mysql_connect);
  }

  mysqli_stmt_close($stmt3);

}else{
  echo "Please Pick a Cali Exercise";
}

mysqli_close($mysql_connect);
?>