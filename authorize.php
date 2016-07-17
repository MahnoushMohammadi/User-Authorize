<?php
  session_start();

  // We do it this way so that if we forget to include a page that requires admin in the array, it will require admin access by default
  function doesNotRequireAdmin($page) {
    $pagesRequireAdmin = array("#Cooperatives", "#Users", "#editUser","#editCoop","#KPIs","#AddKPI","#editKPI","#Attribute","#adminHome","adminComment");
    $requiresAdmin = in_array($page, $pagesRequireAdmin);
    return !$requiresAdmin;
  }

  // if not logged in, redirect to login page
  // unless it is a page that does not require login:

  $p = $_POST["toPage"];

   if ($_SESSION["isLoggedIn"] == false && $p != "#newuser" && $p != "#changepassword" && $p != "#newpassword" ) {
    echo "#login";
  }
  
   /*if($_SESSION["isLoggedIn"] && ){ //isLoggedIn and destination is login page
     echo homepage
   }*/

   if (doesNotRequireAdmin($_POST["toPage"])){
   //echo the toPage
    echo ($p);
 }
  
  // If a regular user tries to access an admin page, redirect to homepage:

   if (!$_SESSION["isAdmin"]){ 
   echo "#userHomePage";
 }

   elseif ($_SESSION["isAdmin"]){ 
     echo ($p);
   }

?>