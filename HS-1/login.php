<?php include "main/addons/db_conn.php"; 

//if($connection) {
    
  //  echo "CONN"; } "tested: is connected"
?>

<?php session_start(); ?>

<?php

if(isset($_POST['login'])){
    
   // echo "happening";
    
     $username = $_POST['username'];
     $password = $_POST['password'];
     echo $username;
    

$sql="select * from User Where Username='$username' AND Password='$password'";
$result = $connection->query($sql);
    
    if(!$result){
        
        die("Query Failed". msqli_error($connection));
    }
    else if($result->num_rows==1){
        
        $_SESSION['username'] = $username;
        
        header("Location: main/index.php");
        
    }
    
    //while($row = mysqli_fetch_array($result)){
        // $db_username=$row['Username'];
      //   $db_username=$row['Password'];
    //}
        
    //if($username !== $db_username && $password !== $db_password) {
        
      //  header("Location: index.php");
    //}
    
   // else if($username == $db_username && $password == $db_password) {
        
     //   $_SESSION['username'] = $db_username;
        
     //   header("Location: main/index.php");
        
   // }
    
    else {
        
        header("Location: index.php");
    }
    
    
    
    
    
}
?>
