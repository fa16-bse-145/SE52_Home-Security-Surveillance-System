<?php session_start(); 
if($_SESSION['username']==null){
header("Location: /HS-1/HS-1/index.php");
}
?> 


<?php
include "addons/db_conn.php";
?>

<?php

if(isset($_GET['id'])){
    
    $status_id = $_GET['id'];
    
    $notif_status_update =  mysqli_query($connection, "UPDATE securitynotifications SET status=1 WHERE id = '$status_id'");
}

?>


<!-- Header -->
<?php
include "addons/header.php";
?>
    
<!-- Navigation -->
<?php
include "addons/nav.php";
?>


<h1 class="page-header">
    Notification Archives
                   
   
 </h1>


 <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Members -->
            <div class="col-md-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Time</th>
                    <th scope="col">Image</th>
                    <th scope="col">Message</th>
                    <th scope="col">Delete Notification</th>
                </tr>
            </thead>
            
            <tbody>
              
               <?php  
                
                $no =1;
                
                $get_notif =  mysqli_query($connection, "SELECT * from securitynotifications WHERE status=1");
                
                while($notif_data = mysqli_fetch_assoc($get_notif)){
                ?>
                <tr>
                    <th scope="row"> <?php echo $no++; ?></th>
                        
                        <td><?php echo $notif_data['Time'] ?></td>
                        <td><?php echo '<img class="img-responsive" width="80px" height="80px" src="data:image/jpeg;base64,'.base64_encode($notif_data['Image']) .'" />' ?></td>
                        <td><?php echo $notif_data['Message'] ?></td>
                    <td><a href="delete.php?id=<?php echo $notif_data['id'];?>" class="text-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                   
                </tr>
                <?php } ?>
            </tbody>
        </table>
		</div>
          

            </div>
<hr>

<?php
include "addons/footer.php";
?>


