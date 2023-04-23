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
  

//wt exercise information grab
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $sql="SELECT user_name, exercise, muscle_group, date_time 
          FROM wt_exercises 
          WHERE user_name='$username'";

    $retval = mysqli_query($mysql_connect, $sql);

    //initlize array to include all groups even if not in database
    $counts = array(
        'Chest' => 0,
        'Back' => 0,
        'Arms' => 0,
        'Legs' => 0,
    );
    //counts the number of times the muscle group is entered
    while ($row = mysqli_fetch_assoc($retval)){
        $muscle_group = $row['muscle_group'];
        if(array_key_exists($muscle_group, $counts)){
            $counts[$muscle_group]++;
        }else {
            $counts[$muscle_group] = 1;
        }
    }
    //sorts the array and picks out the highest targetted muscle group and least
    arsort($counts);
    $highest_muscle_group = key($counts);
    $least_muscle_group = key(array_slice($counts, -1, 1, true));

    $sql2="SELECT exercise
           FROM wt_exercises
           WHERE muscle_group = '$highest_muscle_group'";

    $retval2 = mysqli_query($mysql_connect, $sql2);

    echo "You seem to be targeting your " . $highest_muscle_group ." the most. Here are some other exercises that might be helpful that you haven't done to switch it up:<br>";

    //stores the exercises users have done in an array that match the highest muscle group
    $db_exercises = array();
    while ($row2 = mysqli_fetch_assoc($retval2)) {
        $db_exercises[] = $row2['exercise'];
    }

    //creates an array of exercises the user has not done yet to suggest different exercises for the highest_muscle_group
    $empty_exercises = array();
    $empty_exercises = array_diff($exerciseArray, $db_exercises);
        if(!empty($empty_exercises)){
            echo "These are some other exercises that will target your " . $highest_muscle_group . " that you haven't done yet:<br>";
            foreach ($empty_exercises as $exercise => $muscle_group) {
                if($muscle_group == $highest_muscle_group && !in_array($exercise, $db_exercises)){
                echo "- " . $exercise . "<br>";
                }
            }
        }else{
            echo "It looks like you have done a wide variety of exercises for " . $highest_muscle_group . " keep up the good work and make sure to keep rotating your routine! <br>";
        }
       
    echo "<br>You seem to be targeting your " . $least_muscle_group ." the least. Here are some previous exercises you have done in the past. Remember, consistency is key!<br>";

  
    $sql3="SELECT exercise
           FROM wt_exercises
           WHERE muscle_group = '$least_muscle_group'";
    
    $retval3 = mysqli_query($mysql_connect, $sql3);

    if(mysqli_num_rows($retval3) > 0){
        while ($row = mysqli_fetch_assoc($retval3)) {
            echo $row['exercise'] . "<br>";
        }
        
    }else{
        echo "It looks like you haven't done any exercises that target this area before here are some suggestions <br>";
        foreach ($exerciseArray as $exercise => $muscle_group){
            if($muscle_group == $least_muscle_group){
                echo "-" . $exercise . "<br>";
            }
        }
    }


    while ($row3 = mysqli_fetch_assoc($retval3)) {
        echo "- " . $row3['exercise'] . "<br>";
    }
}
