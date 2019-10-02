<?php
$servername = "localhost";
$database = "users";
$username = "root";
$password = "applemango";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";
$chef = array("E", "F", "G", "H");

foreach ($chef as $val) {
	for ($i=1; $i <20 ; $i++) { 
		$p = rand(100,500);
		$sql = "INSERT INTO menu (dish, price, category,availability,chef) VALUES ('".$val."".$i."', '".$p."', '".$val."','1','".$val."')";
		if (mysqli_query($conn, $sql)) {
		      echo "New record created successfully";
		} else {
		      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}	
	}
}

mysqli_close($conn);

?>