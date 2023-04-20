

/*function getMax() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "review.php", true);
  xhttp.onreadystatechange = function() {
    if (this.status == 200) {
      var projmax = this.responseText;
      var place = document.getElementById("ProjVal");
      place.innerHTML = projmax;
      console.log("What is this " + projmax);
    }
  };
  xhttp.send();
}*/

/*function getMax(){
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "review.php", true);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var projmax = parseInt(this.responseText);
      if (!isNaN(projmax)) {
        var place = document.getElementById("ProjVal");
        place.innerHTML = projmax;
        console.log("projmax:", projmax);
      } else {
        console.error("Invalid response:", this.responseText);
      }
    } else {
      console.error("Error:", this.status);
    }
  };
  xhttp.send();
}*/

/*document.getElementById("projBtn").addEventListener("click", function() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "review.php", true);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var projmax = parseInt(this.responseText);
      if (!isNaN(projmax)) {
        var place = document.getElementById("ProjVal");
        place.innerHTML = projmax;
        console.log("projmax:", projmax);
      } else {
        console.error("Invalid response:", this.responseText);
      }
    } else {
      console.error("Error:", this.status);
    }
  };
  xhttp.send();
});

/*function getMax(){
  var newInput = document.getElementById("ProjVal");
  newInput.innerHTML ="This button actually works";
}*/

// Get the canvas element





var ctx = document.getElementById('myChart').getContext('2d');

// Create a new chart object
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [], // array of labels for the x-axis
        datasets: [{
            label: 'Weight History', // label for the dataset
            data: [], // array of data points for the y-axis
            borderColor: 'blue', // color of the line
            fill: false // don't fill the area under the line
        }]
    },
    options: {
        responsive: true, // make the chart responsive to window size
        scales: {
            xAxes: [{
                type: 'time', // use time scale for the x-axis
                time: {
                    unit: 'day' // show labels by day
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true // start the y-axis at 0
                }
            }]
        }
    }
});


var sql = "SELECT date_time, weight_lbs FROM wt_exercises'";
$.get("review.php", {sql: sql}, function(response) {
    var data = JSON.parse(response);
    for (var i = 0; i < data.length; i++) {
        myChart.data.labels.push(data[i].date_time);
        myChart.data.datasets[0].data.push(data[i].weight_lbs);
    }
    myChart.update(); // update the chart with the new data
});