<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$officeID = $_GET['id'];

$office = strip_tags($_POST['office']);
$abbr = strip_tags($_POST['abbr']);
$loggedin = $_SESSION['login'];



if (isset($_POST['submit'])) {

		$sql = "INSERT into tbloffices values(null,'$office','$abbr', now(), '$loggedin')";
		// echo ($sql);
		// exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			
			echo "<script>alert('Office Created Successfully');</script>";
			echo "<script>window.location.href ='all-district-offices'</script>";
		}
	}

if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($lsylogo)) {
	// get the image extension
	$extension = substr($lsylogo, strlen($lsylogo) - 4, strlen($lsylogo));
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	
	} else {
		//rename the image file
		$newlsylogo = $lsy . '_' . $lsylogo;
	}
}

		$sql = "UPDATE tbloffices  SET position = '$office', abbr = '$abbr',
		dateUpdated = now(), updatedBy = '$loggedin' WHERE officeID = $officeID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Position Updated Successfully');</script>";
			echo "<script>window.location.href ='all-district-offices'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Create New Position</title>
<script>
	function checkOfficevailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_office.php",
			data: 'office=' + $("#office").val(),
			type: "POST",
			success: function(data) {
				$("#office-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Create Position';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing 
	$sql=mysqli_query($con,"select * from tbloffices where officeID = $officeID");
	$row=mysqli_fetch_array($sql);
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addoffice" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">

								<div class="form-group">
									<label for="office">
										Position Title
									</label>
									<input type="text" name="office" id="office" class="form-control" <?php if(!empty($officeID) || $officeID)
									{?>value ="<?php echo $row['position']; ?>"<?php } else{?> placeholder="Enter Titile"<?php } ?> required="true"
									 onBlur="checkOfficevailability()">
									<span id="office-availability-status"></span>
								</div>


								<div class="form-group">
									<label for="abbr">
										Short Form
									</label>
									<input name="abbr" class="form-control"<?php if(!empty($officeID) || $officeID)
									{?>value ="<?php echo $row['abbr']; ?>"<?php } else{?>
									 placeholder="Enter Short form if any" <?php } ?>>
								</div>
								<button type="submit"  <?php if(!empty($officeID) || $officeID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($officeID) || $officeID)
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