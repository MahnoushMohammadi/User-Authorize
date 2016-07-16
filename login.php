<?php
/*Mahnoush*/
 
session_start();
 $servername = "159.203.1.85";
 $username = "cpi";
 $password = "dev";

try {
    $conn = new PDO('mysql:host=localhost;dbname=cpi_app', $username, $password);

    $conn -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   if($_POST){

    $loginEmeil = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPass'];    
   
    $sql = "SELECT user.iduser, user.email, user.password, user.ustatus, access.role FROM user, access WHERE user.email = '$loginEmeil' AND user.iduser = access.user_iduser ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $count = count($result); 

    $status = new stdClass();

    if ($count == 5 && $loginPassword == $result["password"]){
    
         $status->wasSuccessful = true;
         $status->userPass = true;
         $status->userType = $result["role"];
         $status->userStatus = $result["ustatus"];
         $status->userId = $result["iduser"];
         $_SESSION["userlogin"] = $result["iduser"];
         $_SESSION["isLoggedIn"] = true;
         $_SESSION["isAdmin"] = true;

    }elseif ($count == 5 && $loginPassword != $result["password"]) {
         $status->wasSuccessful = true;
         $status->userPass = false;
         $status->userType = $result["role"];
         $status->userStatus = $result["ustatus"];
         $status->userId = $result["iduser"];
         $_SESSION["userlogin"] = $result["iduser"];
         $_SESSION["isLoggedIn"] = true;
         $_SESSION["isAdmin"] = false;   
    }

    else{

        $status->wasSuccessful = false;
        $_SESSION["isLoggedIn"] = false;
    }  
     

    echo json_encode($status);  
  }
}
catch(PDOException $e)
{
  echo "Connection failed: " . $e->getMessage();
}
$conn = null;
?>