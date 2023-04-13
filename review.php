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

$username = "admin";

$sql = 'SELECT user_name, exercise, weight_lbs, number_sets, number_reps, date_time FROM wt_exercises' ;
$retval = mysqli_query($mysql_connect, $sql);

if (mysqli_num_rows($retval) > 0) {
    // Generate HTML output
    echo "<table>";
    echo "<tr><th>User Name</th><th>exercise</th><th>weight</th><th>sets</th><th>reps</th><th>date/time</th></tr>";
    while ($row = mysqli_fetch_assoc($retval)) {
      echo "<tr><td>" . $row["user_name"] . "</td><td>" . $row["exercise"] . "</td><td>" . $row["weight_lbs"] . "</td><td>" . $row["number_sets"] . "</td><td>" . $row["number_reps"] .  "</td><td>" . $row["date_time"] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "No results found.";
  }
  
  // Close the database connection
  mysqli_close($conn);
  ?>
 
  
  
  
  
  