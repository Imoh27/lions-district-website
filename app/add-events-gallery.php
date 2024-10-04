<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$galleryID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$eventID = strip_tags($_POST['eventID']);
$serviceYrID = $lsyrow['serviceYrID'];
$galleryPhotos =  str_replace(array("JPG"), 'jpg', $_FILES["galleryPhotos"]["name"]);
$galleryPhotos =  str_replace(array( '\'', '"',
    ';','*' ), ' ', $galleryPhotos);
// var_dump($galleryPhotos); exit;
$galleryPhotossize =  $_FILES["galleryPhotos"]["size"];

$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	$fetch_title = mysqli_query($con, "SELECT eventTitle from  tblevents WHERE eventID = $eventID");
	$event_title = mysqli_fetch_array($fetch_title);
	$eventTitle = $event_title["eventTitle"];
	// echo $eventTitle; exit;
	// loop Through the file
	$countFiles = count($galleryPhotos);
	// echo $countFiles; exit;
	for ($i = 0; $i < $countFiles; $i++) {
		$arraygalleryPhotos = $galleryPhotos[$i];
		// var_dump($arraygalleryPhotos); exit;
	// get the image extension
	$extension = substr($arraygalleryPhotos, strlen($arraygalleryPhotos) - 4, strlen($arraygalleryPhotos));

	// $extension = substr($galleryPhotos, strlen($galleryPhotos) - 4, strlen($galleryPhotos));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif", "JPG");
	if($galleryPhotossize[$i] > 5000000){
		echo "<script>alert('OOP!. Maximum Array Size of 5mb Exceeded');</script>"; 
	}
	else if (!in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}else {
		$newEventTitile = str_replace(array( '\'', ' ',
    ';','*' ), '_', $eventTitle);
		$newgalleryPhotos = $newEventTitile . '_' . $arraygalleryPhotos;
	// exit;
		$gallery_insert_sql = "INSERT into tblgallery values(null, $eventID , '$newgalleryPhotos', now(), '$loggedin')";
		// echo ($gallery_insert_sql);
		// exit;
		$gallery_result = mysqli_query($con, $gallery_insert_sql);
		if ($gallery_result) {
			move_uploaded_file($_FILES["galleryPhotos"]["tmp_name"][$i], "events_gallery/" . $newgalleryPhotos);
			echo "<script>alert('Gallery Added Successfully');</script>";
			echo "<script>window.location.href ='manage-events-gallery'</script>";
		}
	}
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

// SELECT EVENT

	$event_sql = mysqli_query($con, "select * from  tblevents");
	
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addgallery" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">


								<div class="form-group">
									<label for="eventID">
										Select Event
									</label>
									<select name="eventID" id="eventID" class="form-control" required="true">
										<?php if (!empty($galleryID) || $galleryID) { ?>
											<option value="<?php echo $row['eventID']; ?>">  <?php echo $row['eventTitle']; ?></option>
										<?php } else { ?>
											<option value=""></option>

										<?php }
										while ($event_row = mysqli_fetch_array($event_sql)) { ?>
											<option value="<?php echo $event_row['eventID']; ?>"> <?php echo $event_row['eventTitle']; ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="form-group">
										<label for="galleryPhotos">
											Select Photos <em><b>(Not More than 5mb total)</b></em>
										</label>
										<input type="file" name="galleryPhotos[]" id="galleryPhotos" class="form-control" required="true" multiple>
									</div>


								<button type="submit"  name="submit" id="submit"  class="btn btn-o btn-primary">
								 Submit 
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