const form = document.getElementById("review-form");
const container = document.getElementById("results-container");

form.addEventListener("submit", (event) => {
  event.preventDefault(); // prevent form from submitting normally

  // create an XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // set up the request
  xhr.open("POST", form.action, true);

  // set up the onload function
  xhr.onload = function () {
    if (xhr.status === 200) {
      container.innerHTML = xhr.responseText; // display the results in the container
    } else {
      container.innerHTML = "Error: " + xhr.status;
    }
  };

  // send the request
  xhr.send(new FormData(form));
});