function addWtExercise(){
    var newInput = document.getElementById("newWtExercise");
    var exerciseSelect = document.getElementById("wt_exercises");
    var newExercise = newInput.value;
    var newOption = document.createElement("option");
    newOption.text = newExercise;
    exerciseSelect.add(newOption);
    newInput.value = "";

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