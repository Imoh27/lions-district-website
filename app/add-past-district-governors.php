<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$leadersID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$fullname = $_POST['fullname'];
$lci_awards = strtoupper($_POST['lci_awards']);
$service_year = strtoupper($_POST['service_year']);
$service_theme = strtoupper($_POST['service_theme']);
$pdgProfile = $_POST['pdgProfile'];
// $serviceYrID = $lsyrow['serviceYrID'];
// echo $serviceYrID; exit;
$pdgPhoto =  strtolower($_FILES["pdgPhoto"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

	// echo $pdgPhoto; exit;
// echo $_SESSION['login']; exit;
	// get the image extension
	$extension = substr($pdgPhoto, strlen($pdgPhoto) - 4, strlen($pdgPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	} else {
		//rename the image file
		$newpdgPhoto = $fullname . '_' . $pdgPhoto;

		$leader_insert_sql = "INSERT into tblinternationalleaders values(null,'$fullname','$position', '$lci_awards','$serviceYrID','$newpdgPhoto','$leaderProfile', now(), '$loggedin')";
		// echo ($leader_insert_sql);
		// exit;
		$leader_result = mysqli_query($con, $leader_insert_sql);
		if ($leader_result) {
			move_uploaded_file($_FILES["pdgPhoto"]["tmp_name"], "LCI_leaders_Photos/" . $newpdgPhoto);
			echo "<script>alert('Lions Leader Added Successfully');</script>";
			echo "<script>window.location.href ='manage-international-leaders'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($pdgPhoto)) {
	// get the image extension
	$extension = substr($pdgPhoto, strlen($pdgPhoto) - 4, strlen($pdgPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	
	} else {
		//rename the image file
		$newpdgPhoto = $fullname . '_' . $pdgPhoto;
	}
}

		$sql = "UPDATE tblinternationalleaders  SET fullName = '$fullname', position = '$position', lci_awards = '$lci_awards', leaderProfile = '$leaderProfile', 
		dateUpdated = now(), updatedBy = '$loggedin'";
		// echo ($sql);
		// exit;
		if(!empty($pdgPhoto)) {
			$sql .= " pdgPhoto = '$newpdgPhoto'";
		}
		$sql .= " WHERE leadersID = $leadersID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($pdgPhoto)) {
			move_uploaded_file($_FILES["pdgPhoto"]["tmp_name"], "LCI_leaders_Photos/" . $newpdgPhoto);
			}
			echo "<script>alert('Leader Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-international-leaders'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Add International Leader</title>
<script>
	function checkpdgAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_past_district_governors.php",
			data: 'fullname=' + $("#fullname").val(),
			type: "POST",
			success: function(data) {
				$("#pdg-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Past District Governor ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($leadersID)) {
	$leaders_sql=mysqli_query($con,"select * from pdg where pdgID = $pdgID");
	$row=mysqli_fetch_array($leaders_sql);
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
									<label for="fullname">
										Full Name
									</label>
									<input type="text" name="fullname" id="fullname" class="form-control" <?php if(!empty($leadersID) || $leadersID)
									{?>value ="<?php echo $row['fullName']; ?>"<?php } else{?> placeholder="Enter Full name"<?php } ?> required="true"
									onBlur="checkpdgAvailability()">
									<span id="pdg-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="lci_awards">
										LCI Awards
									</label>
									<input name="lci_awards" id="lci_awards" class="form-control"<?php if(!empty($leadersID) || $leadersID)
									{?>value ="<?php echo $row['lci_awards']; ?>"<?php } else{?>
									 placeholder="MJF, NLCF" <?php } ?> required="true">
								</div>

								<div class="form-group">
									<label for="position">
										Position
									</label>
									<input name="position" id="position" class="form-control"<?php if(!empty($leadersID) || $leadersID)
									{?>value ="<?php echo $row['position']; ?>"<?php } else{?>
									 placeholder="Enter Postion title" <?php } ?> required="true">
								</div>


								<div class="form-group">
									<label for="leaderProfile">
										Detailed Profile
									</label>
									<input type="text" name="leaderProfile" placeholder="Describe detailed profile" class="form-control"  <?php if(!empty($leadersID) || $leadersID)
									{?>value ="<?php echo $row['leaderProfile']; ?>"<?php } ?>
									>
								</div>
								
								<div class="form-group">
									<label for="pdgPhoto">
										Select Photo
									</label>
									<input type="file" name="pdgPhoto" class="form-control" <?php if(empty($leadersID) || !$leadersID)
									{?>required="true"<?php } ?>> <?php if(!empty($leadersID) || $leadersID)
									{?><div class="d-inline user-profile img-fluid"><img  src="LCI_leaders_Photos/<?php echo $row['pdgPhoto'];?>" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($leadersID) || $leadersID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($leadersID) || $leadersID)
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