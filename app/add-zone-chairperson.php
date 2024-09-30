<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$zcID = $_GET['id'];

$sql = mysqli_query($con, "SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow = mysqli_fetch_array($sql);


$fullname = strip_tags($_POST['fullname']);
$phoneNo = strtolower(strip_tags($_POST['phoneNo']));
$region = strtolower(strip_tags($_POST['zone']));
$lci_awards = strtoupper(strip_tags($_POST['lci_awards']));
$serviceYrID = $lsyrow['serviceYrID'];
// echo $serviceYrID; exit;
$zcPhoto =  strtolower($_FILES["rcPhoto"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

	// echo $zcPhoto; exit;
	// echo $_SESSION['login']; exit;
	// get the image extension
	$extension = substr($zcPhoto, strlen($zcPhoto) - 4, strlen($zcPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	} else {
		//rename the image file
		$newrcPhoto = $fullname . '_' . $zcPhoto;

		$zc_insert_sql = "INSERT into tblzonechairperson values(null, $region,'$fullname', '$lci_awards', '$phoneNo', $serviceYrID,'$newrcPhoto', now(), '$loggedin')";
		// echo ($zc_insert_sql);
		// exit;
		$zc_result = mysqli_query($con, $zc_insert_sql);
		if ($zc_result) {
			move_uploaded_file($_FILES["rcPhoto"]["tmp_name"], "rc_Photos/" . $newrcPhoto);
			echo "<script>alert('Zone Chairperson Added Successfully');</script>";
			echo "<script>window.location.href ='manage-region-and-chairpersons'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if (!empty($zcPhoto)) {
		// get the image extension
		$extension = substr($zcPhoto, strlen($zcPhoto) - 4, strlen($zcPhoto));
		// allowed extensions
		$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
		if (!in_array($extension, $allowed_extensions)) {
			$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
			// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

		} else {
			//rename the image file
			$newrcPhoto = $fullname . '_' . $zcPhoto;
		}
	}

	$sql = "UPDATE tblzonechairperson  SET regionID = $region, fullName = '$fullname', phoneNo = '$phoneNo', lions_awards = '$lci_awards', 
		dateUpdated = now(), updatedBy = '$loggedin'";
	// echo ($sql);
	// exit;
	if (!empty($zcPhoto)) {
		$sql .= " rcPhoto = '$newrcPhoto'";
	}
	$sql .= " WHERE zcID = $zcID";
	// echo $sql; exit;
	$result = mysqli_query($con, $sql);
	if ($result) {
		if (!empty($zcPhoto)) {
			move_uploaded_file($_FILES["rcPhoto"]["tmp_name"], "rc_Photos/" . $newrcPhoto);
		}
		echo "<script>alert('Zone Chairperson Updated Successfully');</script>";
		echo "<script>window.location.href ='manage-region-and-chairpersons'</script>";
	}
}

include("assets/topheader.php");
?>
<title>Admin | Zone Chairperson</title>
<script>
	function checkRcAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'rcname=' + $("#fullname").val(),
			type: "POST",
			success: function(data) {
				$("#rc-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Zone Chairperson (' . $lsyrow['serviceYr'] . ')';
	$x_content = true;
	?>
	<?php include('include/header.php');

	// SELECT REGIONS
	$region_sql = mysqli_query($con, "select * from tblregion");


	// For Editing
	if (!empty($zcID)) {
		$zc_sql = mysqli_query($con, "SELECT * from tblzonechairperson zc
	JIONINNER JOIN  tblregion r ON r.regionID=rc.regionID where rc.zcID = $zcID");
		$row = mysqli_fetch_array($zc_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addrcs" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">

								<div class="form-group">
									<label for="region">
										Select Region
									</label>
									<select name="region" id="region" class="form-control" required="true">
										<?php if (!empty($zcID) || $zcID) { ?>
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
									<label for="fullname">
										Full Name
									</label>
									<input type="text" name="fullname" id="fullname" class="form-control" <?php if (!empty($zcID) || $zcID) { ?>value="<?php echo $row['fullName']; ?>" <?php } else { ?> placeholder="Enter Full name" <?php } ?> required="true"
										onBlur="checkRcAvailability()">
									<span id="rc-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="lci_awards">
										Honors?Awards
									</label>
									<input name="lci_awards" id="lci_awards" class="form-control" <?php if (!empty($zcID) || $zcID) { ?>value="<?php echo $row['lions_awards']; ?>" <?php } else { ?>
										placeholder="MJF, NLCF" <?php } ?>>
								</div>

								<div class="form-group">
									<label for="phoneNo">
										Phone No
									</label>
									<input name="phoneNo" id="phoneNo" class="form-control" <?php if (!empty($zcID) || $zcID) { ?>value="<?php echo $row['phoneNo']; ?>" <?php } else { ?>
										placeholder="+2348133314846" <?php } ?>>
								</div>

								<div class="form-group">
									<label for="rcPhoto">
										Select Photo
									</label>
									<input type="file" name="rcPhoto" class="form-control" <?php if (empty($zcID) || !$zcID) { ?>required="true" <?php } ?>> <?php if (!empty($zcID) || $zcID) { ?><div class="d-inline user-profile img-fluid"><img src="rc_Photos/<?php echo $row['rcPhoto']; ?>" alt=""></div><?php } ?>
								</div>


								<button type="submit" <?php if (!empty($zcID) || $zcID) { ?> name="update" id="update" <?php } else { ?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
									<?php if (!empty($zcID) || $zcID) { ?>Update <?php } else { ?> Submit <?php } ?>
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