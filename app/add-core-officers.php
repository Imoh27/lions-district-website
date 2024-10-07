<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$coreofficersID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$fullname = strip_tags($_POST['fullname']);
$position = strtolower(strip_tags($_POST['position']));
$lci_awards = strip_tags($_POST['lci_awards']);
$coreofficersProfile =  str_replace(array( '\'', '"',
';','*' ), ' ', $_POST['coreofficersProfile']);
$serviceYrID = $lsyrow['serviceYrID'];
$coreofficersPhoto =  strtolower($_FILES["coreofficersPhoto"]["name"]);
$coreofficersPhotosize =  strtolower($_FILES["coreofficersPhoto"]["size"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	// echo $coreofficersProfile; exit;

	// echo $coreofficersPhoto; exit;
// echo $_SESSION['login']; exit;
	// get the image extension
	$extension = substr($coreofficersPhoto, strlen($coreofficersPhoto) - 4, strlen($coreofficersPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if($coreofficersPhotosize > 1000000){
		echo "<script>alert('OOPs!. Maximum File Size of 1mb Exceeded');</script>"; 
	}else if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	} else {
		//rename the image file
		$newcoreofficersPhoto = $fullname . '_' . $coreofficersPhoto;

		$coreofficers_insert_sql = "INSERT into tblcoreofficers values(null,'$fullname', $position, '$lci_awards','$serviceYrID','$newcoreofficersPhoto','$coreofficersProfile', now(), '$loggedin')";
		// echo ($coreofficers_insert_sql);
		// exit;
		$coreofficers_result = mysqli_query($con, $coreofficers_insert_sql);
		if ($coreofficers_result) {
			move_uploaded_file($_FILES["coreofficersPhoto"]["tmp_name"], "coreofficers_Photos/" . $newcoreofficersPhoto);
			echo "<script>alert('Core Officer Added Successfully');</script>";
			echo "<script>window.location.href ='manage-core-officers'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($coreofficersPhoto)) {
	// get the image extension
	$extension = substr($coreofficersPhoto, strlen($coreofficersPhoto) - 4, strlen($coreofficersPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	
	} else {
		//rename the image file
		$newcoreofficersPhoto = $fullname . '_' . $coreofficersPhoto;
	}
}

		$sql = "UPDATE tblcoreofficers  SET fullName = '$fullname', officeID =$position, lci_awards = '$lci_awards', coreofficersProfile = '$coreofficersProfile', 
		dateUpdated = now(), updatedBy = '$loggedin'";
		// echo ($sql);
		// exit;
		if(!empty($coreofficersPhoto)) {
			$sql .= " coreofficersPhoto = '$newcoreofficersPhoto'";
		}
		$sql .= " WHERE coreofficersID = $coreofficersID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($coreofficersPhoto)) {
			move_uploaded_file($_FILES["coreofficersPhoto"]["tmp_name"], "coreofficerss_Photos/" . $newcoreofficersPhoto);
			}
			echo "<script>alert('Core Officer Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-core-officers'</script>";
		}
	}

include("assets/topheader.php");
?>

    
<title>Admin | Add Core Officer</title>
<script>
	function checkcoreofficersAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'coreofficers=' + $("#fullname").val(),
			type: "POST",
			success: function(data) {
				$("#coreofficers-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Core Officer ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($coreofficersID)) {
	$coreofficerss_sql=mysqli_query($con,"SELECT * from tblcoreofficers d
	JOIN tbloffices o ON o.officeID = d.officeID where coreofficersID = $coreofficersID");
	$row=mysqli_fetch_array($coreofficerss_sql);
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

							<form role="form" name="add_coreofficers" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">

								<div class="form-group">
									<label for="fullname">
										Full Name
									</label>
									<input type="text" name="fullname" id="fullname" class="form-control" <?php if(!empty($coreofficersID) || $coreofficersID)
									{?>value ="<?php echo $row['fullName']; ?>"<?php } else{?> placeholder="Enter Full name"<?php } ?> required="true"
									onBlur="checkcoreofficersAvailability()">
									<span id="coreofficers-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="lci_awards">
										LCI Awards
									</label>
									<input name="lci_awards" id="lci_awards" class="form-control"<?php if(!empty($coreofficersID) || $coreofficersID)
									{?>value ="<?php echo $row['lci_awards']; ?>"<?php } else{?>
									 placeholder="MJF, NLCF" <?php } ?> required="true">
								</div>

								<div class="form-group">
									<label for="position">
										Position
									</label>

									<select name="position" id="position" class="form-control" 
									 required="true">
										<?php if (!empty($coreofficersID) || $coreofficersID) { ?>
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
									<label for="coreofficersProfile">
										Detailed Profile
									</label>
									<textarea type="text" name="coreofficersProfile" placeholder="Describe detailed profile" class="summernote"  <?php if(!empty($coreofficersID) || $coreofficersID)
									{?>value ="<?php echo $row['coreofficersProfile']; ?>"<?php } ?>
									></textarea>
								</div>
								
								<div class="form-group">
									<label for="coreofficersPhoto">
										Select Photo
									</label>
									<input type="file" name="coreofficersPhoto" class="form-control" <?php if(empty($coreofficersID) || !$coreofficersID)
									{?>required="true"<?php } ?>> <?php if(!empty($coreofficersID) || $coreofficersID)
									{?><div class="d-inline user-profile img-fluid"><img  src="coreofficers_Photos/<?php echo $row['coreofficersPhoto'];?>" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($coreofficersID) || $coreofficersID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($coreofficersID) || $coreofficersID)
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