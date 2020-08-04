<?php
session_start();
include "addons/db_conn.php";
$query_sensor = "SELECT * from Cam";

        $result = mysqli_query($connection, $query_sensor);

        while($row = mysqli_fetch_assoc($result)) {
                    
            $status   = $row['Status'];
           
		}
$data= [
	'viewCount' => $status
];

echo json_encode($data);

?>