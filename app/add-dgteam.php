<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$dgteamID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$fullname = strip_tags($_POST['fullname']);
$position = strtolower(strip_tags($_POST['position']));
$lci_awards = strtoupper(strip_tags($_POST['lci_awards']));
$dgteamProfile = strip_tags( str_replace(array( '\'', '"',
';','*' ), ' ', $_POST['dgteamProfile']));
$serviceYrID = $lsyrow['serviceYrID'];
$dgteamPhoto =  strtolower($_FILES["dgteamPhoto"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	// echo $serviceYrID; exit;

	// echo $dgteamPhoto; exit;
// echo $_SESSION['login']; exit;
	// get the image extension
	$extension = substr($dgteamPhoto, strlen($dgteamPhoto) - 4, strlen($dgteamPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	} else {
		//rename the image file
		$newdgteamPhoto = $fullname . '_' . $dgteamPhoto;

		$dgteam_insert_sql = "INSERT into tbldgteam values(null,'$fullname', $position, '$lci_awards','$serviceYrID','$newdgteamPhoto','$dgteamProfile', now(), '$loggedin')";
		echo ($dgteam_insert_sql);
		exit;
		$dgteam_result = mysqli_query($con, $dgteam_insert_sql);
		if ($dgteam_result) {
			move_uploaded_file($_FILES["dgteamPhoto"]["tmp_name"], "dgteam_Photos/" . $newdgteamPhoto);
			echo "<script>alert('Team Added Successfully');</script>";
			echo "<script>window.location.href ='manage-dgteam'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($dgteamPhoto)) {
	// get the image extension
	$extension = substr($dgteamPhoto, strlen($dgteamPhoto) - 4, strlen($dgteamPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	
	} else {
		//rename the image file
		$newdgteamPhoto = $fullname . '_' . $dgteamPhoto;
	}
}

		$sql = "UPDATE tbldgteam  SET fullName = '$fullname', position = '$position', lci_awards = '$lci_awards', dgteamProfile = '$dgteamProfile', 
		dateUpdated = now(), updatedBy = '$loggedin'";
		// echo ($sql);
		// exit;
		if(!empty($dgteamPhoto)) {
			$sql .= " dgteamPhoto = '$newdgteamPhoto'";
		}
		$sql .= " WHERE dgteamID = $dgteamID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($dgteamPhoto)) {
			move_uploaded_file($_FILES["dgteamPhoto"]["tmp_name"], "dgteams_Photos/" . $newdgteamPhoto);
			}
			echo "<script>alert('Team Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-dgteam'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Add District Governors TEam</title>
<script>
	function checkdgteamAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'dgteam=' + $("#fullname").val(),
			type: "POST",
			success: function(data) {
				$("#dgteam-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add District Governor Team ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($dgteamID)) {
	$dgteams_sql=mysqli_query($con,"select * from tbldgteam where dgteamID = $dgteamID");
	$row=mysqli_fetch_array($dgteams_sql);
	}

	$select_position = "SELECT * FROM tbloffices";
	$position_query = mysqli_query($con, $select_position);
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="add_dgteam" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">

								<div class="form-group">
									<label for="fullname">
										Full Name
									</label>
									<input type="text" name="fullname" id="fullname" class="form-control" <?php if(!empty($dgteamID) || $dgteamID)
									{?>value ="<?php echo $row['fullName']; ?>"<?php } else{?> placeholder="Enter Full name"<?php } ?> required="true"
									onBlur="checkdgteamAvailability()">
									<span id="dgteam-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="lci_awards">
										LCI Awards
									</label>
									<input name="lci_awards" id="lci_awards" class="form-control"<?php if(!empty($dgteamID) || $dgteamID)
									{?>value ="<?php echo $row['lci_awards']; ?>"<?php } else{?>
									 placeholder="MJF, NLCF" <?php } ?> required="true">
								</div>

								<div class="form-group">
									<label for="position">
										Position
									</label>

									<select name="position" id="position" class="form-control" 
									 required="true">
										<?php if (!empty($dgteamID) || $dgteamID) { ?>
											<option value="<?php echo $row['officeID']; ?>"> <?php echo $row['position']; ?></option>
										<?php } else { ?>
											<option value="">Select</option>

										<?php }
										while ($office_row = mysqli_fetch_array($position_query)) { ?>
											<option value="<?php echo $office_row['officeID']; ?>">  <?php echo $office_row['position']; ?></option>
										<?php }
										?>
									</select>
									
								</div>


								<div class="form-group">
									<label for="dgteamProfile">
										Detailed Profile
									</label>
									<input type="text" name="dgteamProfile" placeholder="Describe detailed profile" class="form-control"  <?php if(!empty($dgteamID) || $dgteamID)
									{?>value ="<?php echo $row['dgteamProfile']; ?>"<?php } ?>
									>
								</div>
								
								<div class="form-group">
									<label for="dgteamPhoto">
										Select Photo
									</label>
									<input type="file" name="dgteamPhoto" class="form-control" <?php if(empty($dgteamID) || !$dgteamID)
									{?>required="true"<?php } ?>> <?php if(!empty($dgteamID) || $dgteamID)
									{?><div class="d-inline user-profile img-fluid"><img  src="dgteam_Photos/<?php echo $row['dgteamPhoto'];?>" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($dgteamID) || $dgteamID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($dgteamID) || $dgteamID)
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