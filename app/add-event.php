<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$eventID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$catID = strip_tags($_POST['catID']);
$eventTitle = strip_tags($_POST['eventTitle']);
$startDate = strtolower(strip_tags($_POST['startDate']));
$endDate = strtolower(strip_tags($_POST['endDate']));
$eventLocation = strtolower(strip_tags($_POST['eventLocation']));
$cordinatorName = strtolower(strip_tags($_POST['cordinatorName']));
$cordinatorPhone = strtolower(strip_tags($_POST['cordinatorPhone']));
$lionsAmount = strtolower(strip_tags($_POST['lionsAmount']));
$leosAmount = strtolower(strip_tags($_POST['leosAmount']));
$eventDesc = str_replace(array( '\'', '"', "'",
    ';','*' ), ' ', $_POST['eventDesc']);
$serviceYrID = $lsyrow['serviceYrID'];
// echo $serviceYrID; exit;
$previewPhoto =  strtolower($_FILES["previewPhoto"]["name"]);
$cordinatorPhoto =  strtolower($_FILES["cordinatorPhoto"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	// get the image extension
	$extension = substr($previewPhoto, strlen($previewPhoto) - 4, strlen($previewPhoto));
	$extension2 = substr($cordinatorPhoto, strlen($cordinatorPhoto) - 4, strlen($cordinatorPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Peview Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}if (!in_array($extension2, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Cordinator Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}
	 else {
		$newcordinatorName = str_replace(array( '\'', '"',
    ';','*' ), '-', $_POST['cordinatorName']);
		//rename the image file
		$newpreviewPhoto = $eventTitle . '_' . $previewPhoto;
		$newcordinatorPhoto = $newcordinatorName. '_' .$cordinatorPhoto;

		$event_insert_sql = "INSERT into tblevents values(null, $catID , $serviceYrID, '$eventTitle','$eventDesc', '$lionsAmount', '$leosAmount',  '$eventLocation','$cordinatorName',
		'$cordinatorPhone','$newcordinatorPhoto', '$startDate', '$endDate','$newpreviewPhoto', now(), '$loggedin')";
		// echo ($event_insert_sql);
		// exit;
		$event_result = mysqli_query($con, $event_insert_sql);
		if ($event_result) {
			move_uploaded_file($_FILES["cordinatorPhoto"]["tmp_name"], "event_previews/" . $newcordinatorPhoto);
			move_uploaded_file($_FILES["previewPhoto"]["tmp_name"], "event_previews/" . $newpreviewPhoto);
			echo "<script>alert('Event Added Successfully');</script>";
			echo "<script>window.location.href ='manage-events'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($previewPhoto)) {
	// get the image extension
	$extension = substr($previewPhoto, strlen($previewPhoto) - 4, strlen($previewPhoto));
	$extension2 = substr($cordinatorPhoto, strlen($cordinatorPhoto) - 4, strlen($cordinatorPhoto));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions) || !in_array($extension2, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	} else {
		//rename the image file
		$newpreviewPhoto = $eventTitle . '_' . $previewPhoto;
		$newcordinatorPhoto = $eventTitle . '_' . $cordinatorPhoto;

	}
}

		$sql = "UPDATE tblevents  SET catID = $catID, eventTitle = '$eventTitle', lionsAmount = '$lionsAmount', leosAmount = '$leosAmount', eventLocation = '$eventLocation', 
		cordinatorName = '$cordinatorName', cordinatorPhone = '$cordinatorPhone', startDate = '$startDate', endDate = '$endDate', 
		";
		// echo ($sql);
		// exit;
		if(!empty($eventDesc)) {
			$sql .= " eventDesc = '$eventDesc', ";
		}
		if(!empty($previewPhoto)) {
			$sql .= " previewPhoto = '$newpreviewPhoto'";
		}
		if(!empty($cordinatorPhoto)) {
			$sql .= " cordinatorPhoto = '$newcordinatorPhoto'";
		}
		$sql .= " dateUpdated = now(), updatedBy = '$loggedin' WHERE eventID = $eventID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($previewPhoto)) {
			move_uploaded_file($_FILES["previewPhoto"]["tmp_name"], "event_previews/" . $newpreviewPhoto);
			}
			if(!empty($cordinatorPhoto)) {
			move_uploaded_file($_FILES["cordinatorPhoto"]["tmp_name"], "event_previews/" . $newcordinatorPhoto);
			}
			echo "<script>alert('Event Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-events'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Create Event</title>
<script>
	function checkEventAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'eventTitle=' + $("#eventTitle").val(),
			type: "POST",
			success: function(data) {
				$("#event-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Create Event ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

// SELECT CATEGORY

	$cat_sql = mysqli_query($con, "select * from  tblcategory");
	// For Editing
	if(!empty($eventID)) {
	$events_sql=mysqli_query($con,"select * from tblevents e JOIN tblcategory c ON c.catID = e.catID where e.eventID = $eventID");
	$row=mysqli_fetch_array($events_sql);
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
									<label for="catID">
										Select Category
									</label>
									<select name="catID" id="catID" class="form-control" required="true">
										<?php if (!empty($eventID) || $eventID) { ?>
											<option value="<?php echo $row['catID']; ?>">  <?php echo $row['categoryName']; ?></option>
										<?php } else { ?>
											<option value=""></option>

										<?php }
										while ($cat_row = mysqli_fetch_array($cat_sql)) { ?>
											<option value="<?php echo $cat_row['catID']; ?>"> <?php echo $cat_row['categoryName']; ?></option>
										<?php }
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="eventTitle">
										Event Title
									</label>
									<input type="text" name="eventTitle" id="eventTitle" class="form-control" <?php if(!empty($eventID) || $eventID)
									{?>value ="<?php echo $row['eventTitle']; ?>"<?php } else{?> placeholder="Keep the title Short"<?php } ?> required="true"
									onBlur="checkEventAvailability()" maxlength="50">
									<span id="event-availability-status"></span>
								</div>

								<div class="row">
									<div class="col-6 form-group">
										<label for="startDate">
											Start Date
										</label>
										<input type="date" name="startDate" id="startDate" class="form-control"<?php if(!empty($eventID) || $eventID)
										{?>value ="<?php echo $row['startDate']; ?>"<?php }?>>
									</div>
									
									<div class="col-6 form-group">
										<label for="endDate">
											End Date
										</label>
										<input type="date" name="endDate" id="endDate" class="form-control"<?php if(!empty($eventID) || $eventID)
										{?>value ="<?php echo $row['endDate']; ?>"<?php }?>>
									</div>
								</div>

								<div class="form-group">
									<label for="eventLocation">
										Location
									</label>
									<input name="eventLocation" id="eventLocation" class="form-control"<?php if(!empty($eventID) || $eventID)
									{?>value ="<?php echo $row['eventLocation']; ?>"<?php } else{?>
									 placeholder="Enter Address" <?php } ?> required="true">
								</div>

								<div class="form-group">
									<label for="cordinatorName">
										Cordinator Name
									</label>
									<input name="cordinatorName" id="cordinatorName" class="form-control"<?php if(!empty($eventID) || $eventID)
									{?>value ="<?php echo $row['cordinatorName']; ?>"<?php } else{?>
									 placeholder="Enter Name of Cordinator" <?php } ?> >
								</div>
								<div class="row">

									<div class="col-4 form-group">
										<label for="cordinatorPhone">
											Cordinator Phone
										</label>
										<input name="cordinatorPhone" id="cordinatorPhone" class="form-control"<?php if(!empty($eventID) || $eventID)
										{?>value ="<?php echo $row['cordinatorPhone']; ?>"<?php } else{?>
										 placeholder="Enter Phone Number of Cordinator" <?php } ?> >
									</div>

									<div class="col-4 form-group">
										<label for="lionsAmount">
											Lions Amount
										</label>
										<input name="lionsAmount" id="lionsAmount" class="form-control"<?php if(!empty($eventID) || $eventID)
										{?>value ="<?php echo $row['lionsAmount']; ?>"<?php } else{?>
										 placeholder="Optional" <?php } ?> >
									</div>
									<div class="col-4 form-group">
										<label for="leosAmount">
											Leos Amount
										</label>
										<input name="leosAmount" id="leosAmount" class="form-control"<?php if(!empty($eventID) || $eventID)
										{?>value ="<?php echo $row['leosAmount']; ?>"<?php } else{?>
										 placeholder="Optional" <?php } ?> >
									</div>
								</div>


								<div class="form-group">
									<label for="eventDesc">
										Event Description
									</label>
									<textarea type="text" name="eventDesc" placeholder="Describe detailed profile" class="summernote"  <?php if(!empty($eventID) || $eventID)
									{?>value ="<?php echo $row['eventDesc']; ?>"<?php } ?>
									></textarea>
								</div>

								<div class="row mt-lg-5">
									<div class="col-7 form-group">
										<label for="previewPhoto">
											Select Preview Photo <em><b>(A flyer Design preferrably)</b></em>
										</label>
										<input type="file" name="previewPhoto" class="form-control" <?php if(empty($eventID) || !$eventID)
										{?>required="true"<?php } ?>> <?php if(!empty($eventID) || $eventID)
										{?><div class="d-inline user-profile img-fluid"><img  src="event_previews/<?php echo $row['previewPhoto'];?>" alt=""></div><?php } ?>
									</div>
	
									<div class="col-5 form-group">
										<label for="cordinatorPhoto">
											Select Cordinator Photo <em><b>(Optional)</b></em>
										</label>
										<input type="file" name="cordinatorPhoto" class="form-control"> <?php if(!empty($eventID) || $eventID)
										{?><div class="d-inline user-profile img-fluid"><img  src="event_previews/<?php echo $row['cordinatorPhoto'];?>" alt=""></div><?php } ?>
									</div>
								</div>


								<button type="submit"  <?php if(!empty($eventID) || $eventID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($eventID) || $eventID)
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