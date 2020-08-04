<?php $servername = "localhost";
$user = "samra";
$pass = "123456";
$dbname = "securehome";

// Create connection
$conn = new mysqli($servername, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
echo "success";

session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['username'];
// SQL Query To Fetch Complete Information Of User// SQL Query To Fetch Complete Information Of User
echo $user_check;
$sql="SELECT Username FROM User WHERE Username ='$user_check'";
$result = $conn->query($sql);
echo $result;
$row = $result->fetch_assoc();
$login_session =$row["Username"];
echo $login_session;
if(!isset($login_session)){
mysql_close($conn); // Closing Connection
header("Location: index.php"); // Redirecting To Home Page
}
?>