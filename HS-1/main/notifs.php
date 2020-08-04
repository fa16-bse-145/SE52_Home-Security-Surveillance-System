<?php
session_start();
include "addons/db_conn.php";


$no =1;
                
$get_notif =  mysqli_query($connection, "SELECT * from securitynotifications WHERE status=0 ORDER BY id desc LIMIT 1");
                
while($notif_data = mysqli_fetch_assoc($get_notif)){

	$no;
	$time=$notif_data['Time'];
	$img = '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode($notif_data['Image']) .'" />';
	$image = base64_encode($notif_data['Image']);
	$message= $notif_data['Message'];
	//echo '<a href="unread_notifs.php">View all</a>';
}

$link= '<a href="unread_notifs.php" class="btn btn-primary">See All Unread</a>';
if($time==null){
	$message = "No New Notifications";
	$link = '<a href="notifications.php" class="btn btn-primary">See All</a>';
}

$data= [
	'viewCount' => $no,
	'time' => $time,
	'image' => $image,
	'message' => $message,
	'img' => $img,
	'link' => $link
];

echo json_encode($data);

?>