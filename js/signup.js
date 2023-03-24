

function addForm(){
    //adds first name label
    let newFirst = document.createElement("label");
    newFirst.setAttribute("name", "fname");
    newFirst.innerHTML=("First Name");
    const formLoc = document.getElementById("inputs");
    formLoc.appendChild(newFirst);

    //adds first name input
    let firstInput = document.createElement("input");
    firstInput.setAttribute("type","text");
    firstInput.setAttribute("name","first");
    formLoc.appendChild(firstInput);

    //adds last name label
    let newLast = document.createElement("label");
    newLast.setAttribute("name", "lname");
    newLast.innerHTML=("Last Name");
    formLoc.appendChild(newLast);

    //adds last name input
    let lastInput = document.createElement("input");
    lastInput.setAttribute("type","text");
    lastInput.setAttribute("name","last");
    formLoc.appendChild(lastInput)

    //adds username label
    let newUser = document.createElement("label");
    newUser.setAttribute("for", "newuname");
    newUser.innerHTML=("Username");
    formLoc.appendChild(newUser);

    //adds username input
    let userInput = document.createElement("input")
    userInput.setAttribute("type","text");
    userInput.setAttribute("name","newuname");
    formLoc.appendChild(userInput);

    //adds password label
    let newPass = document.createElement("label");
    newPass.setAttribute("for","pass");
    newPass.innerHTML=("Password");
    formLoc.appendChild(newPass);

    //adds password input
    let passInput = document.createElement("input");
    passInput.setAttribute("type","password");
    passInput.setAttribute("id","pass1")
    passInput.setAttribute("name","newpass");
    formLoc.appendChild(passInput);

    //adds password2 label
    let newPass2 = document.createElement("label");
    newPass2.setAttribute("for","pass");
    newPass2.innerHTML=("Confirm Password");
    formLoc.appendChild(newPass2);

    let passInput2 = document.createElement("input");
    passInput2.setAttribute("type","password");
    passInput2.setAttribute("id","pass2");
    passInput2.setAttribute("name","pass2");
    formLoc.appendChild(passInput2);

    //adds submit button
    let subBtn = document.createElement("button");
    subBtn.setAttribute("type","signup");
    subBtn.innerHTML=("Submit");
    subBtn.setAttribute("onclick","checkPass()");
    formLoc.appendChild(subBtn);

}

function checkPass(){
   let allowPass = true;
   let pwOne = document.getElementById("pass1").value;
   let pwTwo = document.getElementById("pass2").value;

   if(pwOne =="" || pwTwo ==""){

    alert("Please Enter a Password");
    allowPass = !allowPass;
    
   }

   if(pwOne != pwTwo){

    alert("Passwords Do Not Match");
    allowPass = !allowPass;
    
   }else if(allowPass === true){

    alert("Password Accepted");
    location.reload();
    
    }
}