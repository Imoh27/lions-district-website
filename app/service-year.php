<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$serviceYrID = $_GET['id'];

$lsy = $_POST['lsy'];
$lsy_theme = $_POST['lsy_theme'];
$start_date = $_POST['start_date'];
$stop_date = $_POST['stop_date'];
$lsylogo =  strtolower($_FILES["lsylogo"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

	// echo $lsylogo; exit;
// echo $_SESSION['login']; exit;
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

		$sql = "INSERT into tblserviceyr values(null,'$lsy','$newlsylogo','$start_date','$stop_date','$lsy_theme', now(), '$loggedin')";
		// echo ($sql);
		// exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			move_uploaded_file($_FILES["lsylogo"]["tmp_name"], "sylogo/" . $newlsylogo);
			echo "<script>alert('Lions Service Year Created Successfully');</script>";
			echo "<script>window.location.href ='manage-service-year.php'</script>";
		}
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

		$sql = "UPDATE tblserviceyr  SET serviceYr = '$lsy', from_date = '$start_date', stop_date = '$stop_date', service_theme = '$lsy_theme', 
		dateUpdated = now(), updatedBy = '$loggedin'";
		// echo ($sql);
		// exit;
		if(!empty($lsylogo)) {
			$sql .= " service_logo = '$newlsylogo'";
		}
		$sql .= " WHERE serviceYrID = $serviceYrID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($lsylogo)) {
			move_uploaded_file($_FILES["lsylogo"]["tmp_name"], "sylogo/" . $newlsylogo);
			}
			echo "<script>alert('Lions Service Year Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-service-year.php'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Service Year</title>
<script>
	function checkServiceYearAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_sy.php",
			data: 'lsy=' + $("#lsy").val(),
			type: "POST",
			success: function(data) {
				$("#lsy-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Add Service Year';
	$x_content = true;
	?>
	<?php include('include/header.php'); 
	$sql=mysqli_query($con,"select * from tblserviceyr where serviceYrID = $serviceYrID");
	$row=mysqli_fetch_array($sql);
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addlsy" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">

								<div class="form-group">
									<label for="lsy">
										Service Year
									</label>
									<input type="text" name="lsy" id="lsy" class="form-control" <?php if(!empty($serviceYrID) || $serviceYrID)
									{?>value ="<?php echo $row['serviceYr']; ?>"<?php } else{?> placeholder="Example 2024/2025"<?php } ?> required="true"
									onBlur="checkServiceYearAvailability()">
									<span id="lsy-availability-status"></span>
								</div>


								<div class="form-group">
									<label for="lsy_theme">
										Service Year Theme
									</label>
									<input name="lsy_theme" class="form-control"<?php if(!empty($serviceYrID) || $serviceYrID)
									{?>value ="<?php echo $row['service_theme']; ?>"<?php } else{?>
									 placeholder="Enter Service Year Theme" <?php } ?> required="true">
								</div>
								<div class="form-group">
									<label for="start_date">
										Start Date
									</label>
									<input type="date" name="start_date" class="form-control"  <?php if(!empty($serviceYrID) || $serviceYrID)
									{?>value ="<?php echo $row['from_date']; ?>"<?php } ?>
									 required="true">
								</div>
								<div class="form-group">
									<label for="stop_date">
										End Date
									</label>
									<input type="date" name="stop_date" class="form-control"<?php if(!empty($serviceYrID) || $serviceYrID)
									{?>value ="<?php echo $row['stop_date']; ?>"<?php } ?>
									 required="true">
								</div>

								<div class="form-group">
									<label for="v">
										Service Year Logo
									</label>
									<input type="file" name="lsylogo" class="form-control" <?php if(empty($serviceYrID) || !$serviceYrID)
									{?>required="true"<?php } ?>> <?php if(!empty($serviceYrID) || $serviceYrID)
									{?><div class="d-inline user-profile img-fluid"><img  src="sylogo/<?php echo $row['service_logo'];?>" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($serviceYrID) || $serviceYrID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($serviceYrID) || $serviceYrID)
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