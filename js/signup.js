
function checkPass(){
   let allowPass = true;
   let pwOne = document.getElementById("newpass").value;
   let pwTwo = document.getElementById("confirmpass").value;

   if(pwOne =="" || pwTwo ==""){

    alert("Please Enter a Password");
    allowPass = !allowPass;
    
   }

   if(pwOne != pwTwo){

    alert("Passwords Do Not Match");
    allowPass = !allowPass;
    
   }else if(allowPass === true){

    alert("Password Accepted");
    
    }
}