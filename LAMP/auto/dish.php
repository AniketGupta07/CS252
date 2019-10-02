<?php		
	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";
	$conn =new mysqli('localhost', 'auto', 'password' , 'users');

	$sql = $conn->prepare("SELECT * FROM menu WHERE dish LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$countryResult[] = $row["dish"];
		}
		echo json_encode($countryResult);
	}
	$conn->close();
?>

