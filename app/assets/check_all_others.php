<?php 

// CHECK REGION AVAILABILITY

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


// CHECK REGION CHAIR AVAILABILITY
if(!empty($_POST["rcname"])) {
	$rcname= $_POST["rcname"];
	
		$sql = 	"SELECT * FROM tblregionchairperson WHERE fullName='$rcname'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Region Chairperson already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Region Chairperson available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


// CHECK CLUBS AVAILABILITY
if(!empty($_POST["club"])) {
	$club= $_POST["club"];
	
		$sql = 	"SELECT * FROM tblclubs WHERE clubName	='$club'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Club already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Club available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
