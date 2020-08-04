<?php
include "addons/db_conn.php";
session_start();

$query = "SELECT * from User";
                
                $user_profile_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($user_profile_query)) {
                    
                    $username   = $row['Username'];
                    $user_name       = $row['Name'];
                    $user_email   = $row['Email'];
                    $user_phone   = $row['Phone'];
                    $user_password   = $row['Password'];
}
	
	$data= [
	'email' => $user_email
			
		];

if(isset($_POST['email'])){
	
	$email = $_POST['email'];
	

                
    $changeEmail =  mysqli_query($connection, "UPDATE User SET Email='$email' WHERE Username = '".$_SESSION['username']."'");
	
	if($changeEmail){
		$Email =  mysqli_query($connection, "Select Email From User WHERE Username = '".$_SESSION['username']."'");
		$data= [
	'email' => $Email
	
];



	}
}
echo json_encode($data);
?>