<?php session_start(); ?> 
<?php include "addons/db_conn.php"; ?>
<?php

if(isset($_GET['id'])){
    
    $read_un = $_GET['id'];
	
	$get_notif =  mysqli_query($connection, "SELECT * from securitynotifications WHERE Status=1 ORDER BY id desc LIMIT 1");
	while($notif_data = mysqli_fetch_assoc($get_notif)){

	$mid=$notif_data['id'];
	$u=$notif_data['Username'];
	$time=$notif_data['Time'];
	$image = $notif_data['Image'];
	$message= $notif_data['Message'];
	}
	
	if ($read_un==1){
    
    $request = mysqli_query($connection, "UPDATE MemberRequest SET status=1 WHERE Username = '".$_SESSION['username']."'");
		
	
	$update_notif = mysqli_query($connection, "UPDATE securitynotifications SET Message='This person was GRANTED ACCESS to become Member' WHERE id = '".$mid."'");
	}
	
	
	elseif($read_un==0){
		$update_notif = mysqli_query($connection, "UPDATE securitynotifications SET Message='This person was NOT GRANTED ACCESS to become Member' WHERE id = '".$mid."'");
		
		$delete=mysqli_query($connection, "Delete from MemberRequest WHERE  Username = '".$_SESSION['username']."'");
	}
	
		
	
	
    if($get_notif){
	echo "selected";
		
}
if($update_notif){
	echo "inserted";
}
    if($get_notif&&$update_notif) {
        
        header('location: index.php');
    }
    
    else {
        echo mysqli_error($connection);
    }
    
}


?>