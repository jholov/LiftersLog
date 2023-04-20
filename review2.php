<?php include('review.php'); ?>
<!DOCTYPE html>
<html lang = 'en'>
    <div id = page>
        <Head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
            <title>Lifter's Log Review</title>
            <link rel="stylesheet" href="CSS/review.css">
        </Head>
        <body>
            <div id = "logo">
                <img id="logo" src="img/lifterslog.png" alt="logo" height="300px" width="500px">
            </div>
            <div id = "headline">
                <h1>Previous Results for "<?php echo $username; ?>" </h1>
            </div>
            <div class = "nav">
                <a href="login.html">Login</a>
                <a href="exercise.html">Workout</a>
                <a href="review2.php">Review</a>
            </div>
          
            <h1>Results</h1>
            <table class="table table-bordered text-center">
                <h1>Previous Weight Exercises</h1>
                <td><?php echo $results; ?></td>
            </table>
            <label for="proj_max">Calculate Your Projected Max</label>
            <form id ="projForm" action="review.php" method="post"> 
            <select id = "proj_max" name = "proj_max">
                        <option value="bench">Bench</option>
                        <option value="squat">Squat</option>
                        <option value="deadlift">Deadlift</option>
            </select>
            <button type="button" name="projBtn" id="projBtn" >Submit</button>
            <div id ="ProjVal">Test</div>
            
        <script> 
            $(document).ready(function(){
                $("#projBtn").click(function() {
                    var projOpt = $("#proj_max").val();
                    $.post("review.php", {proj_max: projOpt}, function(data) {
                        console.log($("#ProjVal").text);
                        $("#ProjVal").html(data);
                    });
                });
            });
	    </script> 
                
          
            
            <table class="table table-bordered text-center">
                <h1>Previous Cardio Exercises</h1>
                <td><?php echo $cdResults; ?></td>
            </table>
            <table class="table table-bordered text-center">
                <h1>Previous Calisthenic Exercises </h1>
                <td><?php echo $caliResults; ?></td>

            </table><!-- new stuff-->
                <label for="exercise">Select an exercise:</label>
                <select id="grpExercise" name="grpExercise">
                    <option value="bench">Bench Press</option>
                    <option value="wtsquat">Squat</option>
                     <option value="deadlift">Deadlift</option>
                </select>
            
                <input type="button" name = "chartBtn" id = "chartBtn" value="Generate Chart">
                <canvas id ="myChart"></canvas>
                </form> 
            
            <script>
                var data = JSON.parse('<?php echo $data_json; ?>');
                console.log(data);
            
            </script>
            

        <div>
  
</div>


        </body>
        <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
        <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
        <script src="js/review.js"></script> 
    
    </div>
</html>

</html>