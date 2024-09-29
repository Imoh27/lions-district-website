<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$clubID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$region = strip_tags($_POST['region']);
$club = strip_tags($_POST['club']);
$indexNo = strip_tags($_POST['indexo']);
$charterDate = strip_tags($_POST['charterDate']);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

		$club_insert_sql = "INSERT into tblclubs values(null, $region, '$club', '$indexo', '$charterDate', now(), '$loggedin')";
		// echo ($club_insert_sql);
		// exit;
		$club_result = mysqli_query($con, $club_insert_sql);
		if ($club_result) {
			echo "<script>alert('Club Added Successfully');</script>";
			echo "<script>window.location.href ='manage-clubs'</script>";
		}
	}
if (isset($_POST['update'])) {
	

		$sql = "UPDATE tblclubs  SET regionID = $region, clubName = '$club', indexNo = '$indexNo', charterDate = '$charterDate',
		dateUpdated = now(), updatedBy = '$loggedin' WHERE clubID = $clubID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Club Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-clubs'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Club</title>
<script>
	function checkclubAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'club=' + $("#club").val(),
			type: "POST",
			success: function(data) {
				$("#club-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Update club ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

		// SELECT REGIONS
		$region_sql = mysqli_query($con, "select * from tblregion");
	// For Editing
	if(!empty($clubID)) {
	$club_sql=mysqli_query($con,"select * from tblclubs c
	INNER JOIN  tblregion r ON r.regionID=c.regionID where c.clubID = $clubID");
	// echo $club_sql; exit;
	$row=mysqli_fetch_array($club_sql);
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
										<?php if (!empty($clubID) || $clubID) { ?>
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
									<label for="club">
										Club
									</label>
									<input type="text" name="club" id="club" class="form-control" <?php if(!empty($clubID) || $clubID)
									{?>value ="<?php echo $row['clubName']; ?>"<?php } else{?> placeholder="Enter club"<?php } ?> required="true"
									onBlur="checkclubAvailability()">
									<span id="club-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="indexo">
										Club Number
									</label>
									<input type="text" name="indexo" id="indexo" class="form-control" <?php if(!empty($clubID) || $clubID)
									{?>value ="<?php echo $row['indexNo']; ?>"<?php } else{?> placeholder="Enter Club Number"<?php } ?> 
									>
								</div>

								<div class="form-group">
									<label for="charterDate">
										Charter Date
									</label>
									<input type="date" name="charterDate" id="charterDate" class="form-control" <?php if(!empty($clubID) || $clubID)
									{?>value ="<?php echo $row['charterDate']; ?>"<?php } ?>
								>
								</div>

								<button type="submit"  <?php if(!empty($clubID) || $clubID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($clubID) || $clubID)
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