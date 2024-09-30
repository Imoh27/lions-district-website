<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$zoneID = $_GET['id'];
$region_sql=mysqli_query($con,"select * from tblregion");

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$region = strip_tags($_POST['region']);
$zone = strip_tags($_POST['zone']);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

		$zone_insert_sql = "INSERT into tblzone values(null,$region,'$zone', now(), '$loggedin')";
		// echo ($leader_insert_sql);
		// exit;
		$zone_result = mysqli_query($con, $zone_insert_sql);
		if ($zone_result) {
			echo "<script>alert('Zone Added Successfully');</script>";
			echo "<script>window.location.href ='manage-regions-and-zones'</script>";
		}
	}
if (isset($_POST['update'])) {
	

		$sql = "UPDATE tblzone  SET regionId = $region, zoneName = '$zone', 
		dateUpdated = now(), updatedBy = '$loggedin' WHERE zoneID = $zoneID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Zone Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-regions-and-zones'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Zone</title>
<script>
	function checkzoneAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'zone=' + $("#zone").val(),
			type: "POST",
			success: function(data) {
				$("#zone-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Update Zone ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($zoneID)) {
	$zone_sql=mysqli_query($con,"SELECT * from tblzone z JOIN tblregion r ON r.regionID = z.regionID where zoneID = $zoneID");
	$row=mysqli_fetch_array($zone_sql);
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
										Select Region
									</label>
									<select name="region" id="region" class="form-control" required="true">
										<?php if (!empty($zoneID) || $zoneID) { ?>
											<option value="<?php echo $row['regionID']; ?>"> Region <?php echo $row['region']; ?></option>
										<?php } else { ?>
											<option value=""></option>

										<?php }
										while ($region_row = mysqli_fetch_array($region_sql)) { ?>
											<option value="<?php echo $region_row['regionID']; ?>"> Region <?php echo $region_row['region']; ?></option>
										<?php }
										?>
									</select>

								</div>
								<div class="form-group">
									<label for="zone">
										zone
									</label>
									<input type="text" name="zone" id="zone" class="form-control" <?php if(!empty($zoneID) || $zoneID)
									{?>value ="<?php echo $row['zoneName']; ?>"<?php } else{?> placeholder="Enter Figure"<?php } ?> required="true"
									onBlur="checkzoneAvailability()">
									<span id="zone-availability-status"></span>
								</div>

							

								<button type="submit"  <?php if(!empty($zoneID) || $zoneID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($zoneID) || $zoneID)
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