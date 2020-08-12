<?php
session_start();
if($_SESSION['username']==null){
header("Location: /HS-1/HS-1/index.php");
}

include "addons/db_conn.php";
?>

<!-- Header -->
<?php
include "addons/header.php";


?>
    
<!-- Navigation -->
<?php
include "addons/nav.php";
?>



 <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Members -->
            
            <div class="col-md-8">

            
                <?php
                $query = "SELECT * from User";
                
                $user_profile_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($user_profile_query)) {
                    
                    $username   = $row['Username'];
                    $user_name       = $row['Name'];
                    $user_email   = $row['Email'];
                    $user_phone   = $row['Phone'];
                    $user_password   = $row['Password'];
                    
                    
                    
                ?>

                <!-- displaying the Members -->
                
                
                <div class="col-md-8" >
                
                                
                <h2 class="page-header">
                    User: 
                    <?php echo $user_name  ?>   <button type="button" class="btn btn-primary" id="doIt">Edit</button>                                <!--dynamically getting user name -->
                   <hr>
                
                    <small>    
                        <p class="lead">
                    Username: <?php echo  $username ?>                  <!--dynamically member username -->
                        </p>    
                    </small>
                    
                    <small>    
                        <p class="lead">
                    Email: <a href="mailto:<?php echo $user_email ?>" id="e"><?php echo $user_email ?></a> <br>                 <!--dynamically member username -->
                        </p>    
                    </small>
                    
                 <!--   <small>    
                        <p class="lead">
                    Password: <?php echo  $user_password ?>                  dynamically member username 
                        </p>    
                    </small> -->
                    
                    <small>    
                        <p class="lead">
                    Phone: <strong id="p"><?php echo  $user_phone ?><br></strong>                  <!--dynamically member username -->
                        </p>    
                    </small>
                </h2>
                  
                 
                
                </div>
      
                <?php   }   ?>
   
              </div>
          <!-- Pager (addons) -->
            

      </div>
		
		<div class="row">
		
			<div class="col-md-4">
				<div id="form" style="visibility: hidden">
<form action="profileSubmit.php" method="get">

E-mail:<br> <input type="text" name="email"><br>
	Phone: <br> <input type="text" name="phone"><br>
<input type="submit" id="send" class="btn btn-primary"><button type="button" class="btn btn-primary" id="cancel1">Cancel</button>   
</form>
<br>
</div> </div>
<div class="col-md-4">
			<div>
 <button type="button" class="btn btn-primary" id="pass">Change Password</button>
<form action="passwordSubmit.php" method="get" id="passForm" style="visibility: hidden">

New Password:<br> <input type="password" name="password"><br>
<input type="submit" id="sendPass" class="btn btn-primary"><button type="button" class="btn btn-primary" id="cancel2">Cancel</button> 
</form>

</div>
			</div>

                

      
		</div>
<hr>

<?php
include "addons/footer.php";
?>
<script>
		const email = document.getElementById('doIt');
		email.onclick = function(){
			document.getElementById("form").style.visibility='visible';
			document.getElementById("doIt").style.visibility='hidden';
			
		}
		document.getElementById('send').onclick = function(){
				document.getElementById("form").style.visibility='hidden';
				document.getElementById("doIt").style.visibility='visible';
			
		}
		document.getElementById('pass').onclick = function(){
				document.getElementById("passForm").style.visibility='visible';
				document.getElementById("pass").style.visibility='hidden';
				
			
		}
		document.getElementById('sendPass').onclick = function(){
				document.getElementById("passForm").style.visibility='hidden';
				document.getElementById("pass").style.visibility='visible';
			
		}
		document.getElementById('cancel1').onclick = function(){
				document.getElementById("form").style.visibility='hidden';
				document.getElementById("doIt").style.visibility='visible';
			
		}
		document.getElementById('cancel2').onclick = function(){
				document.getElementById("passForm").style.visibility='hidden';
				document.getElementById("pass").style.visibility='visible';
			
		}



		
	

		
		</script>