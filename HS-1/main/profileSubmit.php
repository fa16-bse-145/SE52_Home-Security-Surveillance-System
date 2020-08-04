<?php
include "addons/db_conn.php";
?>

<html>
<body>


<?php
$phone = $_GET["phone"];
$email = $_GET["email"];

$changeEmail =  mysqli_query($connection, "UPDATE User SET Email='$email' WHERE Username = 'samrakhalid00'");
$changePhone =  mysqli_query($connection, "UPDATE User SET Phone='$phone' WHERE Username = 'samrakhalid00'");
	
	if($changeEmail&&$changePhone){
		$result =  mysqli_query($connection, "Select * From User WHERE Username = 'samrakhalid00'");
			            header('location: profile.php');


}
?>
</body>
</html>