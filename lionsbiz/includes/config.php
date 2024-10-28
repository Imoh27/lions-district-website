<?php

try {
	$con = new PDO('mysql:host=localhost;dbname=lionsdistrict404_lions_business', 'lionsdistrict404_lions_business', 'lions_business');
	
	}catch(PDOException $e){
		echo "Invalid Credentials ".$e->getMessage();	
	}
