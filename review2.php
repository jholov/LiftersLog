<?php include('review.php'); ?>
<!DOCTYPE html>
<html lang = 'en'>
    <div id = page>
        <Head>
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
            <form action="review.php" method="post">
            <select id = "proj_max" name = "proj_max">
            <!-- <option value="">--Select an Option--</option> -->
                        <option value="bench">Bench</option>
                        <option value="squat">Squat</option>
                        <option value="deadlift">Deadlift</option>
            </select>
            <button type="submit" name="projBtn" >Submit</button>
            </form>
            <table class="table table-bordered text-center">
                <h1>Previous Cardio Exercises</h1>
                <td><?php echo $cdResults; ?></td>
            </table>
            <table class="table table-bordered text-center">
                <h1>Previous Calisthenic Exercises </h1>
                <td><?php echo $caliResults; ?></td>
            </table>
            
        </body>

    </div>
</html>

</html>