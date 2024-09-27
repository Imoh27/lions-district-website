<?php 
require_once("include/config.php");
if(!empty($_POST["lsy"])) {
	$lsy= $_POST["lsy"];
	
		$sql = 	"SELECT * FROM tblserviceyr WHERE docEmail='$email'";
		$result =mysqli_query($con, $sql);
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Email already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Email available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
