<?php include "addons/db_conn.php"; ?>
<?php

if(isset($_GET['id'])){
    
    $read_id = $_GET['id'];
    
    $read_notif = mysqli_query($connection, "UPDATE securitynotifications SET status=1 WHERE id = '$read_id'");
    
    if($read_notif) {
        
        header('location: unread_notifs.php');
    }
    
    else {
        echo mysqli_error($connection);
    }
    
}


?>

