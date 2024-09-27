<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {

	$lsy = $_POST['lsy'];
	$lsy_theme = $_POST['lsy_theme'];
	$start_date = $_POST['start_date'];
	$stop_date = $_POST['stop_date'];
	$lsylogo = $_POST['lsylogo'];
// echo $_SESSION['login']; exit;
$loggedin = $_SESSION['login'];
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

		$sql = "INSERT into tblserviceyr values(null,'$lsy','$newlsylogo','$start_date','$stop_date','$lsy_theme', now(), 'loggedin')";
		// echo ($sql);
		// exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			move_uploaded_file($_FILES["lsylogo"]["tmp_name"], "sylogo/" . $newlsylogo);
			echo "<script>alert('Lions Service Yer Created Successfully');</script>";
			echo "<script>window.location.href ='manage-service-year.php'</script>";
		}
	}
}
include("assets/topheader.php");
?>
<title>Admin | Dashboard</title>
<script>
	function checkemailAvailability() {
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
	<?php include('include/header.php'); ?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addlsy" method="post" onSubmit="return valid();">

								<div class="form-group">
									<label for="lsy">
										Service Year
									</label>
									<input type="text" name="lsy" class="form-control" placeholder="Example 2024/2025" required="true">
									<span id="lsy-availability-status"></span>
								</div>


								<div class="form-group">
									<label for="lsy_theme">
										Service Year Theme
									</label>
									<textarea name="lsy_theme" class="form-control" placeholder="Enter Service Year Theme" required="true"></textarea>
								</div>
								<div class="form-group">
									<label for="start_date">
										Start Date
									</label>
									<input type="date" name="start_date" class="form-control" required="true">
								</div>
								<div class="form-group">
									<label for="stop_date">
										End Date
									</label>
									<input type="date" name="stop_date" class="form-control" required="true">
								</div>

								<div class="form-group">
									<label for="v">
										Service Year Logo
									</label>
									<input type="file" name="lsylogo" class="form-control" required="true">
								</div>


								<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
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