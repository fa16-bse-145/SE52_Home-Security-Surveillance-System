<?php include "addons/db_conn.php"; ?>

<?php

if(isset($_GET['id'])){
    
    $status_id = $_GET['id'];
    
    $notif_status_update =  mysqli_query($connection, "UPDATE securitynotifications SET status=1 WHERE id = '$status_id'");
}

?>
<?php include "addons/header.php"; ?>


<?php include "addons/nav.php"; ?>




<div class="container" id="notif_table">
    
    <div class="row">
		<div class="col-md-8">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Username</th>
                    <th scope="col">Time</th>
                    <th scope="col">Image</th>
                    <th scope="col">Message</th>
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
                        <td><?php echo $notif_data['Username'] ?></td>
                        <td><?php echo $notif_data['Time'] ?></td>
                        <td><?php echo '<img class="img-responsive" src="data:image/jpeg;base64,'.base64_encode($notif_data['Image']) .'" />' ?></td>
                        <td><?php echo $notif_data['Message'] ?></td>
                   
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>
	</div>
    
</div>