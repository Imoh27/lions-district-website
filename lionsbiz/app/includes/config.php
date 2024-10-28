<?php
// define('DB_SERVER','localhost');
// define('DB_USER','root');
// define('DB_PASS' ,'');
// define('DB_NAME','cplc');

try {
	$con = new PDO('mysql:host=localhost;dbname=lionsdistrict404_lions_business', 'lionsdistrict404_lions_business', 'lions_business');
	
	}catch(PDOException $e){
		echo "Invalid Credentials ".$e->getMessage();	
	}

// $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
// if (mysqli_connect_errno())
// {
//  echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }
