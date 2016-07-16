/* check inputs-Mahnoush
*
*/


window.CheckInput= function () {

  var EmailUser= $("#email").val();
  var PasswordUser = $("#password").val();

  if ( EmailUser == "" || PasswordUser == "") 
  {
   alert("please complete your information");
  }
  else {
  
   document.getElementById("frmLogin").reset(); 
   $.post("scripts/database/login.php", {'loginEmail' : EmailUser, 'loginPass' : PasswordUser },function (data){
   var data = JSON.parse(data);
      
   var stat = data.wasSuccessful;
   var ustat = data.userStatus;
   var role = data.userType;
   var pass = data.userPass;
   var Id = data.userId;

   if (ustat == "inactive"){
    alert("This user is not active");

   }else if (pass == false){
    alert("Password does not match");

   }else if (stat == true && role == "admin" && ustat == "active" && pass == true ){
    window.location.replace("#adminHome");

   } else if (stat == true && role == "user" && ustat == "active" && pass == true) {  
    window.location.replace("#userHomePage");

   } else{
    alert("This user does not exist! Please register");

   }  
   });    
  }
}




