<?php include "addons/db_conn.php"; ?>
<?php

if(isset($_GET['id'])){
    
    $delete_id = $_GET['id'];
    
    $delete_notif = mysqli_query($connection, "DELETE from securitynotifications WHERE id='$delete_id'");
    
    if($delete_notif) {
        
        header('location: notifications.php');
    }
    
    else {
        echo mysqli_error($connection);
    }
    
}


?>