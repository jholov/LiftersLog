function addWtExercise(){
    var newInput = document.getElementById("newWtExercise");
    var exerciseSelect = document.getElementById("wt_exercises");
    var newExercise = newInput.value;
    var newOption = document.createElement("option");
    newOption.text = newExercise;
    exerciseSelect.add(newOption);
    newInput.value = "";

    //Ajax request to PHP script to insert the exercise into the database
    //var xhttp = new XMLHttpRequest();
   // xhttp.onreadystatechange = function() {
     // if (this.readyState == 4 && this.status == 200) {
      //  console.log(this.responseText);
     // }
  //  };
  //  xhttp.open("POST", "exercise.php", true);
   // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   // xhttp.send("exerciseName=" + newExercise);
}

function addCdExercise(){
    var newInput = document.getElementById("newCdExercise");
    var exerciseSelect = document.getElementById("cardio_ex");
    var newExercise = newInput.value;
    var newOption = document.createElement("option");
    newOption.text = newExercise;
    exerciseSelect.add(newOption);
    newInput.value = "";
}

function addCaliExercise(){
    var newInput = document.getElementById("newCaliExercise");
    var exerciseSelect = document.getElementById("calist_ex");
    var newExercise = newInput.value;
    var newOption = document.createElement("option");
    newOption.text = newExercise;
    exerciseSelect.add(newOption);
    newInput.value = "";
}