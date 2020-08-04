<?php session_start(); 
if($_SESSION['username']==null){
header("Location: /HS-1/HS-1/index.php");
}
?> 


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

                    $member_image      = $row['c14'];
                    
                    
                ?>

                <!-- displaying the Members -->
                
                
                <div class="col-md-8" >
                
                <hr>
                
                <h1 class="page-header">
                    Member: 
                    <a href="#"><?php echo $member_name ?></a>                                   <!--dynamically getting member name -->
                   
    
                </h1>
                   
                   
                  
                 <?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode($row['c14']) .'" />' ?> <!--dynamically getting member image -->
            
                </div>
      
                <?php   }   ?>
   
              </div>
               

                <!-- Pager (addons) -->
            

            </div>
<hr>

<?php
include "addons/footer.php";
?>