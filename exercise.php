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
$exercise=$_POST['wt_exercises'];
$weight=$_POST['wt'];
$sets=$_POST['sets'];
$reps=$_POST['reps'];
$muscle_group='';
$user_exer_mg=$_POST['muscle_group'];

//cd exercise information grab
$cd_exercise=$_POST['cardio_ex'];
$distance=$_POST['dist'];
$time=$_POST['time'];
$heartrate=$_POST['hrt_rate'];

//cali exercise information grab
$cali_exercise=$_POST['calist_ex'];
$cali_sets=$_POST['cal_sets'];
$cali_reps=$_POST['cal_reps'];

//stores exercise names as keys and muscle group as values
$exerciseArray = array(
  "Bench" => "Chest",
  "Incline_Bench" => "Chest",
  "Decline_Bench" => "Chest",
  "Dumbbell_Bench" => "Chest",
  "Incline_Dumbbell_Bench" => "Chest",
  "Decline_Dumbbell_Bench" => "Chest",
  "Chest_Flies" => "Chest",
  "Barbell_Squat" => "Legs",
  "Leg_Press" => "Legs",
  "Leg_Curls" => "Legs",
  "Knee_Extensions" => "Legs",
  "Weighted_Lunges" => "Legs",
  "Calf_Raises" => "Legs",
  "Deadlift" => "Back",
  "Bent_Over_Dumbbell_Rows" => "Back",
  "Lat_Pulldowns" => "Back",
  "Reverse_Flies" => "Back",
  "Dumbbell_Curl" => "Arms",
  "Barbell_Curl" => "Arms",
  "Hammerfist_Curl" => "Arms",
  "Dumbbell_Tricep_Extension" => "Arms",
  "Barbell_Tricep_Extension" => "Arms",
);

if (array_key_exists($exercise, $exerciseArray) && $exercise!=""){
  $muscle_group = $exerciseArray[$exercise];
  //prepares the SQl statement
  $stmt = mysqli_prepare($mysql_connect, "INSERT INTO wt_exercises(user_name, exercise, weight_lbs, number_sets, number_reps, muscle_group) VALUES (?, ?, ?, ?, ?, ?)");

  //binds the parameters and execute the statement
  $stmt->bind_param("ssiiis", $username, $exercise, $weight, $sets, $reps, $muscle_group);

  $stmt->execute();
  if (mysqli_affected_rows($mysql_connect) > 0) {
      echo "Data inserted successfully.";
    } else {
      echo "Error inserting data.";
      echo mysqli_error($mysql_connect);
    }
  mysqli_stmt_close($stmt);
}else if($exercise!=""){
  $muscle_group = $user_exer_mg;
   //prepares the SQl statement
   $stmt = mysqli_prepare($mysql_connect, "INSERT INTO wt_exercises(user_name, exercise, weight_lbs, number_sets, number_reps, muscle_group) VALUES (?, ?, ?, ?, ?, ?)");

   //binds the parameters and execute the statement
   $stmt->bind_param("ssiiis", $username, $exercise, $weight, $sets, $reps, $muscle_group);
 
   $stmt->execute();
   if (mysqli_affected_rows($mysql_connect) > 0) {
       echo "Data inserted successfully.";
     } else {
       echo "Error inserting data.";
       echo mysqli_error($mysql_connect);
     }
   mysqli_stmt_close($stmt);
 
}else{}

if($cd_exercise != ""){
    //prepares the SQL statement
    $stmt2 = mysqli_prepare($mysql_connect, "INSERT INTO cd_exercises(user_name, exercise, distance_mi, time_min, heart_rate_bpm) VALUES (?, ?, ?, ?, ?)");

    //binds the parameters and execute the statement
    $stmt2->bind_param("ssddi", $username, $cd_exercise, $distance, $time, $heartrate);

    $stmt2->execute();
    if (mysqli_affected_rows($mysql_connect) > 0) {
      //echo "Data inserted successfully.";
    } else {
      //echo "Error inserting data.";
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
    //echo "Data inserted successfully.";
  } else {
    //echo "Error inserting data.";
    echo mysqli_error($mysql_connect);
  }

  mysqli_stmt_close($stmt3);

}else{
  //echo "Please Pick a Cali Exercise";
}

mysqli_close($mysql_connect);
?>