<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$cpID = $_GET['id'];

$sql = mysqli_query($con, "SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow = mysqli_fetch_array($sql);


$fullname = strip_tags($_POST['fullname']);
$phoneNo = strtolower(strip_tags($_POST['phoneNo']));
$club = strtolower(strip_tags($_POST['club']));
$lci_awards = strtoupper(strip_tags($_POST['lci_awards']));
$serviceYrID = $lsyrow['serviceYrID'];
// echo $serviceYrID; exit;
$cpPhoto =  strtolower($_FILES["cpPhoto"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

	// echo $cpPhoto; exit;
	// echo $_SESSION['login']; exit;
	// get the image extension
	$extension = substr($cpPhoto, strlen($cpPhoto) - 4, strlen($cpPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	} else {
		//rename the image file
		$newcpPhoto = $fullname . '_' . $cpPhoto;

		$cp_insert_sql = "INSERT into tblclubpresidents values(null, $club,'$fullname', '$lci_awards', '$phoneNo', $serviceYrID,'$newcpPhoto', now(), '$loggedin')";
		// echo ($cp_insert_sql);
		// exit;
		$cp_result = mysqli_query($con, $cp_insert_sql);
		if ($cp_result) {
			move_uploaded_file($_FILES["cpPhoto"]["tmp_name"], "cp_photos/" . $newcpPhoto);
			echo "<script>alert('President Added Successfully');</script>";
			echo "<script>window.location.href ='manage-club-presidents'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if (!empty($cpPhoto)) {
		// get the image extension
		$extension = substr($cpPhoto, strlen($cpPhoto) - 4, strlen($cpPhoto));
		// allowed extensions
		$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
		if (!in_array($extension, $allowed_extensions)) {
			$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
			// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";

		} else {
			//rename the image file
			$newcpPhoto = $fullname . '_' . $cpPhoto;
		}
	}

	$sql = "UPDATE tblclubpresidents  SET clubID = $club, fullName = '$fullname', phoneNo = '$phoneNo', lions_awards = '$lci_awards', 
		serviceYrID = $serviceYrID,  dateUpdated = now(), updatedBy = '$loggedin'";
	// echo ($sql);
	// exit;
	if (!empty($cpPhoto)) {
		$sql .= " cpPhoto = '$newcpPhoto'";
	}
	$sql .= " WHERE cpID = $cpID";
	// echo $sql; exit;
	$result = mysqli_query($con, $sql);
	if ($result) {
		if (!empty($cpPhoto)) {
			move_uploaded_file($_FILES["cpPhoto"]["tmp_name"], "cp_photos/" . $newcpPhoto);
		}
		echo "<script>alert('President Updated Successfully');</script>";
		echo "<script>window.location.href ='manage-club-presidents'</script>";
	}
}

include("assets/topheader.php");
?>
<title>Admin | Club  President</title>
<script>
	function checkcpAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'cpname=' + $("#fullname").val(),
			type: "POST",
			success: function(data) {
				$("#cp-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

	function fetchZones() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/get_fields.php",
			data: 'region=' + $("#region").val(),
			type: "POST",
			success: function(data) {
				$("#zone").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}

	function fetchClubs() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/get_fields.php",
			data: 'zone=' + $("#zone").val(),
			type: "POST",
			success: function(data) {
				$("#club").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}



</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Club President (' . $lsyrow['serviceYr'] . ')';
	$x_content = true;
	?>
	<?php include('include/header.php');

	// SELECT REGIONS
	$region_sql = mysqli_query($con, "select * from tblregion");


	// For Editing
	if (!empty($cpID)) {
		$query = "SELECT * from tblclubpresidents cp
	JOIN  tblclubs c ON c.clubID=cp.clubID  INNER JOIN tblzone z ON z.zoneID = c.zoneID
	INNER JOIN tblregion r ON r.regionID = z.regionID where cp.cpID = $cpID";
	// echo $query; exit;
		$cp_sql = mysqli_query($con, $query);
		$row = mysqli_fetch_array($cp_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addcp" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">

								<div class="form-group">
									<label for="region">
										Select Region
									</label>
									<select name="region" id="region" class="form-control" 
									onChange="fetchZones()" required="true">
										<?php if (!empty($cpID) || $cpID) { ?>
											<option value="<?php echo $row['regionID']; ?>"> Region <?php echo $row['region']; ?></option>
										<?php } else { ?>
											<option value="">Select</option>

										<?php }
										while ($region_row = mysqli_fetch_array($region_sql)) { ?>
											<option value="<?php echo $region_row['regionID']; ?>"> Region <?php echo $region_row['region']; ?></option>
										<?php }
										?>
									</select>

								</div>
								<div class="form-group">
									<label for="zone">
										Select Zones
									</label>
									<select name="zone" id="zone" class="form-control"
									onChange="fetchClubs()"   required="true">
										<?php if(!empty($cpID) || $cpID)
										{?>
										<option value="<?php echo ($row['zoneID']); ?>">Zone <?php echo ($row['zoneName']); ?></option>
											<?php } ?>
									</select>

								</div>

								<div class="form-group">
									<label for="club">
										Select Club
									</label>
									<select name="club" id="club" class="form-control"
									  required="true">
										<?php if(!empty($cpID) || $cpID)
										{?>
										<option value="<?php echo ($row['clubID']); ?>"><?php echo ($row['clubName']); ?></option>
											<?php } ?>
									</select>

								</div>

								<div class="form-group">
									<label for="fullname">
										Full Name
									</label>
									<input type="text" name="fullname" id="fullname" class="form-control" <?php if (!empty($cpID) || $cpID) { ?>value="<?php echo $row['fullName']; ?>" <?php } else { ?> placeholder="Enter Full name" <?php } ?> required="true"
										onBlur="checkcpAvailability()">
									<span id="cp-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="lci_awards">
										Honors?Awards
									</label>
									<input name="lci_awards" id="lci_awards" class="form-control" <?php if (!empty($cpID) || $cpID) { ?>value="<?php echo $row['lions_awards']; ?>" <?php } else { ?>
										placeholder="MJF, NLCF" <?php } ?>>
								</div>

								<div class="form-group">
									<label for="phoneNo">
										Phone No
									</label>
									<input name="phoneNo" id="phoneNo" class="form-control" <?php if (!empty($cpID) || $cpID) { ?>value="<?php echo $row['phoneNo']; ?>" <?php } else { ?>
										placeholder="+2348133314846" <?php } ?>>
								</div>

								<div class="form-group">
									<label for="cpPhoto">
										Select Photo
									</label>
									
									<input type="file" name="cpPhoto" class="d-inline form-control" <?php if (empty($cpID) || !$cpID) { ?>required="true" <?php } ?>> <?php if (!empty($cpID) || $cpID) { ?><div class="d-inline user-profile img-fluid"><img src="cp_Photos/<?php echo $row['cpPhoto']; ?>" alt=""></div><?php } ?>
								</div>


								<button type="submit" <?php if (!empty($cpID) || $cpID) { ?> name="update" id="update" <?php } else { ?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
									<?php if (!empty($cpID) || $cpID) { ?>Update <?php } else { ?> Submit <?php } ?>
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