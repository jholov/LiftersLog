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

$username = $_SESSION['username'];

//query for weight exercises for user logged in
$sql = "SELECT user_name, exercise, weight_lbs, number_sets, number_reps, date_time FROM wt_exercises WHERE user_name='$username'" ;
$retval = mysqli_query($mysql_connect, $sql);

if (!$retval) {
  die('Error executing query: ' . mysqli_error($mysql_connect));
}

$results = "";


if (mysqli_num_rows($retval) > 0) {
    // Generate HTML output
    $results .= "<table>";
    $results .= "<tr><th>Exercise</th><th>Weight(lbs)</th><th>Sets</th><th>Reps</th><th>Date/Time</th></tr>";
    while ($row = mysqli_fetch_assoc($retval)) {
      $results .= "<tr><td>" . $row["exercise"] . "</td><td>" . $row["weight_lbs"] . "</td><td>" . $row["number_sets"] . "</td><td>" . $row["number_reps"] .  "</td><td>" . $row["date_time"] . "</td></tr>";

    }
    $results .= "</table>";
  } else {
    $results .= "No results found.";
  }

  //query for cardio exercises for user logged in
  $sql2 = "SELECT user_name, exercise, distance_mi, time_min, heart_rate_bpm, date_time FROM cd_exercises WHERE user_name='$username'";
  $retval2 = mysqli_query($mysql_connect, $sql2);

  if (!$retval2) {
    die('Error executing query: ' . mysqli_error($mysql_connect));
  }

  $cdResults = "";

  if (mysqli_num_rows($retval2) > 0) {
    //Generates HTML output
    $cdResults .= "<table>";
    $cdResults .= "<tr><th>Exercise</th><th>Distance(mi)</th><th>Time(min)</th><th>Heart Rate(bpm)</th><th>Date/Time</th></tr>";
    while ($row = mysqli_fetch_assoc($retval2)) {
        $cdResults .= "<tr><td>" . $row["exercise"] . "</td><td>" . $row["distance_mi"] . "</td><td>" . $row["time_min"] . "</td><td>" . $row["heart_rate_bpm"] .  "</td><td>" . $row["date_time"] . "</td></tr>";

    }
    $cdResults .= "</table>";
  }else {
    $cdResults .= "No results found.";
  }

 //query for cardio exercises for user logged in
  $sql3 = "SELECT user_name, exercise, number_sets, number_reps, date_time FROM cali_exercises WHERE user_name='$username'";
  $retval3 = mysqli_query($mysql_connect, $sql3);

  if (!$retval3) {
    die('Error executing query: ' . mysqli_error($mysql_connect));
  }

  $caliResults = "";

  if (mysqli_num_rows($retval3) > 0) {
    //Generates HTML output
    $caliResults .= "<table>";
    $caliResults .= "<tr><th>Exercise</th><th>Sets</th><th>Reps</th><th>Date/Time</th></tr>";
    while ($row = mysqli_fetch_assoc($retval3)) {
        $caliResults .= "<tr><td>" . $row["exercise"] . "</td><td>" . $row["number_sets"] . "</td><td>" . $row["number_reps"] .  "</td><td>" . $row["date_time"] . "</td></tr>";

    }
    $caliResults .= "</table>";
  }else {
    $caliResults .= "No results found.";
  }

  //sql statments for the projected max
  //if (isset($_POST['projBtn'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

     $projOpt = $_POST['proj_max'];
    


    if($projOpt == "bench"){
     $sql4 = "SELECT user_name, exercise, weight_lbs, number_reps, date_time FROM wt_exercises WHERE user_name='$username' AND exercise='$projOpt' ORDER BY date_time DESC LIMIT 1";
        $retval4 = mysqli_query($mysql_connect, $sql4);

        if(mysqli_num_rows($retval4) > 0){
            while ($row = mysqli_fetch_assoc($retval4)){
                $benchWt = $row["weight_lbs"];
                $benchReps = $row["number_reps"];
                $exercise = $row["exercise"];
            }
        }
        //forumla for projected one rep max bench
        $projVal = ($benchWt * $benchReps * .0333) + $benchWt;

        $intProjVal = intval($projVal);
        echo "Your Projected Max Bench is " .$intProjVal;
       
        
        
        //squat projected max query   
    }else if ($projOpt == "squat"){
        $sql5 = "SELECT user_name, exercise, weight_lbs, number_reps, date_time FROM wt_exercises WHERE user_name='$username' AND exercise='wtsquat' ORDER BY date_time DESC LIMIT 1";
        $retval5 = mysqli_query($mysql_connect, $sql5);

        if(mysqli_num_rows($retval5) > 0){
            while ($row = mysqli_fetch_assoc($retval5)){
                $squatWt = $row["weight_lbs"];
                $squatReps = $row["number_reps"];
                $exercise = $row["exercise"];
            }
        }
        //formula for projected one rep max squat
        $projVal = ($squatWt * $squatReps * .0333) + $squatWt;
        $intProjVal = intval($projVal);
        echo "Your Projected Max Squat is " . $intProjVal;
      

    }else if ($projOpt == "deadlift"){
        $sql6 = "SELECT user_name, exercise, weight_lbs, number_reps, date_time FROM wt_exercises WHERE user_name='$username' AND exercise='$projOpt' ORDER BY date_time DESC LIMIT 1";
        $retval6 = mysqli_query($mysql_connect, $sql6);

        if(mysqli_num_rows($retval6) > 0){
            while ($row = mysqli_fetch_assoc($retval6)){
                $deadWt = $row["weight_lbs"];
                $deadReps = $row["number_reps"];
                $exercise = $row["exercise"];
            }
        }

        $projVal = ($deadWt * $deadReps * .0333) + $deadWt;
        
        $intProjVal = intval($projVal);
        echo "Your Projected Max Deadlift is " . $intProjVal;
        
  }
}

//graphing the outputs
  $weight="";
  $reps="";
  $data = array();
  $grpExer ="";

  if (isset($_POST['chartBtn'])){
   

    $grpExer = $_POST['grpExercise'];

    $sql7 = "SELECT user_name, exercise, weight_lbs, number_sets, number_reps, date_time FROM wt_exercises WHERE user_name='$username' AND exercise='$grpExer'";
    $retval7= mysqli_query($mysql_connect, $sql7);
    
    //loop through the returned data
    while ($row = mysqli_fetch_array($retval7)){
      $weight = $weight . '"' . $row["weight_lbs"]. '",';
      $reps = $reps . '"' . $row["number_reps"];

      $data[] = array("weight" => $row["weight_lbs"], "reps" => $row["number_reps"]);
    }

    $data_json = json_encode($data);
                
    //echo $weight . " " . $reps;
  };

  // Close the database connection
  mysqli_close($mysql_connect);
  ?>
 
  
  
  
  
  