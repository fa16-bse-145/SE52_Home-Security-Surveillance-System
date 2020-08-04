<?php
session_start();
include "addons/db_conn.php";


$no =1;
                
$get_notif =  mysqli_query($connection, "SELECT * from MemberRequest Where Username='".$_SESSION['username']."'");
                
while($notif_data = mysqli_fetch_assoc($get_notif)){

	
	$time=$notif_data['Time'];
	$img = '<img class="img-responsive" width="100px" height="100px" src="data:image/jpeg;base64,'.base64_encode($notif_data['Image']) .'" />';
	$image = base64_encode($notif_data['Image']);
	$message= $notif_data['Message'];
	//echo '<a href="unread_notifs.php">View all</a>';
}
	
$allow= '<a href="send_request.php?id=1">Allow</a>';
$deny= '<a href="send_request.php?id=0">Deny</a>';
if($time==null){
	$message = "No New Request";
	$allow = null;
	$deny = null;
}

$data= [
	
	'time' => $time,
	'image' => $image,
	'message' => $message,
	'img' => $img,
	'allow' => $allow,
	'deny' => $deny
];

echo json_encode($data);

?>