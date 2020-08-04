<?php
session_start();
include "db_conn.php";


$get_count = "SELECT * from securitynotifications WHERE Status = 0";
                
                $result = mysqli_query($connection, $get_count);
                
                $count = mysqli_num_rows($result);


$data= [
	'count' => $count
];

echo json_encode($data);

?>