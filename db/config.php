
<?php
    $servername = "localhost";
	$username = "chaliana_chalian";
	$password = "paloh1993@2020";
	$dbname = "chaliana_medical";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
?>