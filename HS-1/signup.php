<?php include "main/addons/db_conn.php"; 

//if($connection) {
    
  //  echo "CONN"; } "tested: is connected"
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="signup.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>


<div class= "sign-up-form">
     
    <h1> Sign Up </h1>
    
    <?php
    if(isset($_POST['submit'])){
        
        $user_username = $_POST['uname'];
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_phone = $_POST['phone'];
        $user_password = $_POST['pass'];
        
        
        $query= "INSERT into User(Username, Name, Email, Phone, Password) VALUES ('{$user_username}', '{$user_name}', '{$user_email}', {$user_phone}, '{$user_password}')";
        
        $create_user =mysqli_query($connection, $query);
        
        
        if(!$create_user){
            
            die("Query Failed".mysqli_error($connection));
        }
    }
    
    ?>
    
    <form acion="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        
        
        <div class="form-group">
        <input type="text" class="input-box" id="uname" placeholder="Enter your username" name="uname" required>
        <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        
        <div class="form-group">
        <input type="text" class="input-box" id="name" placeholder="Enter your name" name="name" required>
        <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        
        
        <div class="form-group">
        <input type="text" class="input-box" id="email" placeholder="Enter your email" name="email" required>
        <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        
        
        <div class="form-group">
        <input type="phone" class="input-box" id="phone" placeholder="Enter your contact number" name="phone" required>
        <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        
        <div class="form-group">
        <input type="password" class="input-box" id="pass" placeholder="Enter password" name="pass" required>
        <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
        </div>
       
       <div class="form-group">
        <input type="password" class="input-box" id="repass" placeholder="Re-enter password" name="repass" required>
        <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        
        <!--
        <p><span><input type="checkbox"></span> I agree to the terms and conditions of the services.</p>
        -->
        
        <button type="submit" class="signup-btn" name="submit">Sign Up</button>
        
        <hr>
        <p class= "or">OR</p>
        <p> Have an account already? <a href="index.php">Sign In</a></p>
        
        
    </form>    
</div>

<script>
    
    //Disable form submission if password and confirm password dont match.
    var password = document.getElementById("pass")
  , confirm_password = document.getElementById("repass");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
    
    
    
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
   
   
    </body>
    
</html>