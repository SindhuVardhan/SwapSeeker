<?php
	session_start();
 $servername = "localhost";

    $username = "root";

    $password = "";

    $dbname = "swapseeker"; 
	
	$message = "Your address is saved";
	
		$id = $_SESSION['uid'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
	$id = $_SESSION['uid'];
	 $name = $_POST['name'];

     $email = $_POST['email'];
     $mobile = $_POST['mobile'];
     

     $addressone = $_POST['addressone'];
     $addresstwo = $_POST['addresstwo'];
   
     
     $country = $_POST['country'];
     $city = $_POST['city'];
     $state = $_POST['state'];


     $sql = "INSERT INTO userdetails(userid, name, email,mobile,addressone,addresstwo,country,city,state) VALUES('{$_SESSION['uid']}','$name','$email','$mobile','$addressone','$addresstwo','$country','$city','$state')";
	 

if ($conn->query($sql) === TRUE) {
  
  echo "<script type='text/javascript'>alert('$message');window.location.href='checkout.php';</script>";
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>



