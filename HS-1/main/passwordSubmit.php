<?php
include "addons/db_conn.php";
?>

<html>
<body>


<?php
$password = $_GET["password"];

$changePassword =  mysqli_query($connection, "UPDATE User SET Password='$password' WHERE Username = 'samrakhalid00'");

	
	if($changePassword){
		$result =  mysqli_query($connection, "Select * From User WHERE Username = 'samrakhalid00'");
			
                    
            header('location: profile.php');


}
?>
</body>
</html>