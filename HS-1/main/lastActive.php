<?php
session_start();
include "addons/db_conn.php";
$query_camera = "SELECT * from camera";

        $result = mysqli_query($connection, $query_camera);

        while($row = mysqli_fetch_assoc($result)) {
                    
            $ctime     = $row['Time'];
           
		}

$query_lock = "SELECT * from DoorLock";

        $result = mysqli_query($connection, $query_lock);

        while($row = mysqli_fetch_assoc($result)) {
                    
         
            $ltime     = $row['Time'];
		}

$query_sensor = "SELECT * from PIRSensor";

        $result = mysqli_query($connection, $query_sensor);

        while($row = mysqli_fetch_assoc($result)) {
                    
          
            $mtime     = $row['Time'];
		}

$data= [
	'camera' => $ctime,
	'lock' => $ltime,
	'motion' => $mtime
];
echo json_encode($data);

?>