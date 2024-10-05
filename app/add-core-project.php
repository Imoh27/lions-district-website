<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$coreprojectID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$areaID = strip_tags($_POST['areaID']);
$projectTitle = strip_tags($_POST['projectTitle']);
$coordinatorName = strtolower(strip_tags($_POST['coordinatorName']));
$coordinatorPhone = strtolower(strip_tags($_POST['coordinatorPhone']));
$projetDesc = str_replace(array( '\'', '"',
    ';','*' ), ' ', $_POST['projetDesc']);
$serviceYrID = $lsyrow['serviceYrID'];
// echo $serviceYrID; exit;
$projectPhoto =  str_replace(array("JPG"), 'jpg', $_FILES["projectPhoto"]["name"]);
$coordinatorPhoto =  str_replace(array("JPG"), 'jpg', $_FILES["coordinatorPhoto"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	// echo $projectPhoto.' & '. $coordinatorPhoto; exit;
	// get the image extension

	$extension = substr($projectPhoto, strlen($projectPhoto) - 4, strlen($projectPhoto));
	$extension2 = substr($coordinatorPhoto, strlen($coordinatorPhoto) - 4, strlen($coordinatorPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Project Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}if (!in_array($extension2, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Cordinator Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}
	 else {
		$newcoordinatorName = str_replace(array( '\'', '"', ' ',
    ';','*' ), '_', $coordinatorName);
		$newprojectTitle= str_replace(array( '\'', '"', ' ',
    ';','*' ), '_', $projectTitle);
		//rename the image file
		$newprojectPhoto = $newprojectTitle . '_' . $projectPhoto;
		$newcoordinatorPhoto = $newcoordinatorName. '_' .$coordinatorPhoto;

		$project_insert_sql = "INSERT into tblcoreprojects values(null, $areaID , $serviceYrID, '$projectTitle','$projetDesc','$coordinatorName',
		'$coordinatorPhone','$newcoordinatorPhoto', '$newprojectPhoto', now(), '$loggedin')";
		// echo ($project_insert_sql);
		// exit;
		$project_result = mysqli_query($con, $project_insert_sql);
		if ($project_result) {
			move_uploaded_file($_FILES["coordinatorPhoto"]["tmp_name"], "project_previews/" . $newcoordinatorPhoto);
			move_uploaded_file($_FILES["projectPhoto"]["tmp_name"], "project_previews/" . $newprojectPhoto);
			echo "<script>alert('Project Added Successfully');</script>";
			echo "<script>window.location.href ='manage-core-projects'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	// get the image extension
	if (!empty($projectPhoto) || 
	!empty($coordinatorPhoto)) {
	
		$extension = substr($projectPhoto, strlen($projectPhoto) - 4, strlen($projectPhoto));
		$extension2 = substr($coordinatorPhoto, strlen($coordinatorPhoto) - 4, strlen($coordinatorPhoto));
		// allowed extensions
		$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
		if (!in_array($extension, $allowed_extensions)) {
			// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
			echo "<script>alert('Invalid format for Project Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
		}else if (!in_array($extension2, $allowed_extensions)) {
			// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
			echo "<script>alert('Invalid format for Coordinator Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
		}
		 else {
			//rename the image file
			$newcoordinatorName = str_replace(array( '\'', '"', ' ',
    ';','*' ), '_', $coordinatorName);
		$newprojectTitle= str_replace(array( '\'', '"', ' ',
    ';','*' ), '_', $projectTitle);
		//rename the image file
		$newprojectPhoto = $newprojectTitle . '_' . $projectPhoto;
		$newcoordinatorPhoto = $newcoordinatorName. '_' .$coordinatorPhoto;

	
		}
	}


		$sql = "UPDATE tblcoreprojects  SET areaID = $areaID, projectTitle = '$projectTitle', projectDesc = '$projetDesc', 
		coordinatorName = '$coordinatorName', coordinatorPhone = '$coordinatorPhone', 
		dateUpdated = now(), updatedBy = '$loggedin'";
		// echo ($sql);
		// exit;
		if(!empty($projectPhoto)) {
			$sql .= " projectPhoto = '$newprojectPhoto'";
		}
		if(!empty($coordinatorPhoto)) {
			$sql .= " coordinatorPhoto = '$newcoordinatorPhoto'";
		}
		$sql .= " WHERE coreprojectID = $coreprojectID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($projectPhoto)) {
			move_uploaded_file($projectPhoto["tmp_name"], "project_previews/" . $newprojectPhoto);
			}
			if(!empty($coordinatorPhoto)) {
			move_uploaded_file($coordinatorPhoto["tmp_name"], "project_previews/" . $newcoordinatorPhoto);
			}
			echo "<script>alert('Core Project Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-core-projects'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Add Core Projet</title>
<script>
	function checkcoreProjectAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'projectTitle=' + $("#projectTitle").val(),
			type: "POST",
			success: function(data) {
				$("#project-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Create Core Project ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

// SELECT CATEGORY

	$cat_sql = mysqli_query($con, "select * from  tblcorereas");

	// For Editing
	if(!empty($coreprojectID)) {
	$leaders_sql=mysqli_query($con,"SELECT * from tblcoreprojects c JOIN tblcorereas a ON a.areaID = c.areaID
	 where c.coreprojectID = $coreprojectID");
	$row=mysqli_fetch_array($leaders_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addcoreproject" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">


								<div class="form-group">
									<label for="areaID">
										Select Fous Area
									</label>
									<select name="areaID" id="areaID" class="form-control" required="true">
										<?php if (!empty($coreprojectID) || $coreprojectID) { ?>
											<option value="<?php echo $row['areaID']; ?>">  <?php echo $row['coreArea']; ?></option>
										<?php } else { ?>
											<option value=""></option>

										<?php }
										while ($cat_row = mysqli_fetch_array($cat_sql)) { ?>
											<option value="<?php echo $cat_row['areaID']; ?>"> <?php echo $cat_row['coreArea']; ?></option>
										<?php }
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="projectTitle">
										Project Title
									</label>
									<input type="text" name="projectTitle" id="projectTitle" class="form-control" <?php if(!empty($coreprojectID) || $coreprojectID)
									{?>value ="<?php echo $row['projectTitle']; ?>"<?php } else{?> placeholder="Enter Project Title"<?php } ?> required="true"
									onBlur="checkcoreProjectAvailability()">
									<span id="project-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="coordinatorName">
										Cordinator Name
									</label>
									<input name="coordinatorName" id="coordinatorName" class="form-control"<?php if(!empty($coreprojectID) || $coreprojectID)
									{?>value ="<?php echo $row['coordinatorName']; ?>"<?php } else{?>
									 placeholder="Enter Name of Coordinator" <?php } ?> >
								</div>
								
									<div class="form-group">
										<label for="coordinatorPhone">
											Cordinator Phone
										</label>
										<input name="coordinatorPhone" id="coordinatorPhone" class="form-control"<?php if(!empty($coreprojectID) || $coreprojectID)
										{?>value ="<?php echo $row['coordinatorPhone']; ?>"<?php } else{?>
										 placeholder="Enter Phone Number of Cordinator" <?php } ?> >
									</div>

									


								<div class="form-group">
									<label for="projetDesc">
										Project Description
									</label>
									<textarea type="text" name="projetDesc" placeholder="Describe detailed profile" class="summernote"  <?php if(!empty($coreprojectID) || $coreprojectID)
									{?>value ="<?php echo $row['projetDesc']; ?>"<?php } ?>
									></textarea>
								</div>

								<div class="row mt-lg-5">
									<div class="col-7 form-group">
										<label for="projectPhoto">
											Select Preview Photo <em><b>(A flyer Design preferrably)</b></em>
										</label>
										<input type="file" name="projectPhoto" class="form-control" <?php if(empty($coreprojectID) || !$coreprojectID)
										{?>required="true"<?php } ?>> <?php if(!empty($coreprojectID) || $coreprojectID)
										{?><div class="d-inline user-profile img-fluid"><img  src="project_previews/<?php echo $row['projectPhoto'];?>" alt=""></div><?php } ?>
									</div>
	
									<div class="col-5 form-group">
										<label for="coordinatorPhoto">
											Select Coordinator Photo <em><b>(Optional)</b></em>
										</label>
										<input type="file" name="coordinatorPhoto" class="form-control"> <?php if(!empty($coreprojectID) || $coreprojectID)
										{?><div class="d-inline user-profile img-fluid"><img  src="project_previews/<?php echo $row['coordinatorPhoto'];?>" alt=""></div><?php } ?>
									</div>
								</div>


								<button type="submit"  <?php if(!empty($coreprojectID) || $coreprojectID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($coreprojectID) || $coreprojectID)
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
	<?php
	 include('include/footer.php');
	 include('assets/app-footer.php');
	?>

</body>

</html>