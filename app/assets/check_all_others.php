<?php 
require_once("../include/config.php");
if(!empty($_POST["region"])) {
	$region= $_POST["region"];
	
		$sql = 	"SELECT * FROM tblregion WHERE region='$region'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Region already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Region available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
