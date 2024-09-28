<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$regionID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$region = $_POST['region'];
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

		$region_insert_sql = "INSERT into tblregion values(null,'$region', now(), '$loggedin')";
		// echo ($leader_insert_sql);
		// exit;
		$region_result = mysqli_query($con, $region_insert_sql);
		if ($region_result) {
			echo "<script>alert('Region Added Successfully');</script>";
			echo "<script>window.location.href ='manage-regions'</script>";
		}
	}
if (isset($_POST['update'])) {
	

		$sql = "UPDATE tblregion  SET region = '$region', 
		dateUpdated = now(), updatedBy = '$loggedin' WHERE regionID = $regionID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Region Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-regions'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Region</title>
<script>
	function checkregionAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'region=' + $("#region").val(),
			type: "POST",
			success: function(data) {
				$("#region-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Updae Region ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($regionID)) {
	$region_sql=mysqli_query($con,"select * from tblregion where region = $regionID");
	$row=mysqli_fetch_array($region_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addinternationalleaders" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">

								<div class="form-group">
									<label for="region">
										Region
									</label>
									<input type="text" name="region" id="region" class="form-control" <?php if(!empty($regionID) || $regionID)
									{?>value ="<?php echo $row['region']; ?>"<?php } else{?> placeholder="Enter Figure"<?php } ?> required="true"
									onBlur="checkregionAvailability()">
									<span id="region-availability-status"></span>
								</div>

							

								<button type="submit"  <?php if(!empty($regionID) || $regionID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($regionID) || $regionID)
								{?>Update <?php } else {?> Submit <?php } ?>
								</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="panel panel-white">


			</div>
		</div>
	</div>
	<!-- start: FOOTER -->
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>

</body>

</html>