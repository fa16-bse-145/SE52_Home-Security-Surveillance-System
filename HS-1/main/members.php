<?php session_start(); 
if($_SESSION['username']==null){
header("Location: /HS-1/HS-1/index.php");
}
?> 
<style>
img:hover {
  width: 300px;
  height: 300px;
}
</style>


<?php
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

<!--
<h1 class="page-header">
    Welcome  
                   
    <small><?php //echo $_SESSION['username'] ?></small>
 </h1>
 -->

 <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Members -->
            
            <div class="col-md-12">
            
                <?php
		
                $query = "SELECT * from member";
                
                $select_member_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_member_query)) {
                    
                    $member_name       = $row['Name'];
			
		    $member_email      = $row['Email'];

                    $member_image      = $row['c14'];
                    
                    
                ?>

                <!-- displaying the Members -->
                
                
                <div class="col-md-8" >
                
                <hr>
                
                <h1 id=name class="page-header">
                    Member: 
                    <strong><?php echo $member_name ?></strong>                                   <!--dynamically getting member name -->
                   
    
                </h1>
                   
                   
                  
                 <?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode($row['c14']) .'" />' ?> <!--dynamically getting member image -->
            
		<h1>
                    Email: 
                    <a href="mailto:<?php echo $member_email ?>"><?php echo $member_email ?></a>                                   <!--dynamically getting member name -->
                   
    
                </h1>

                </div>
      
                <?php   }   ?>
   
              </div>
               

                <!-- Pager (addons) -->
            

            </div>
<hr>

<?php
include "addons/footer.php";
?>