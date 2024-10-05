<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$areaID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);
$serviceYrID = $lsyrow['serviceYrID'];


$coreArea = strip_tags($_POST['coreArea']);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

		$area_insert_sql = "INSERT into tblcorereas values(null,'$coreArea', '$serviceYrID', now(), '$loggedin')";
		// echo ($leader_insert_sql);
		// exit;
		$area_result = mysqli_query($con, $area_insert_sql);
		if ($area_result) {
			echo "<script>alert('Core Area Added Successfully');</script>";
			echo "<script>window.location.href ='manage-core-projects'</script>";
		}
	}
if (isset($_POST['update'])) {
	

		$sql = "UPDATE tblcorereas  SET coreArea = '$coreArea', serviceYrID = $serviceYrID,
		dateUpdated = now(), updatedBy = '$loggedin' WHERE areaID = $areaID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Core Area Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-core-projects'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Core Focus Area</title>
<script>
	function checkcoreAreaAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'coreArea=' + $("#coreArea").val(),
			type: "POST",
			success: function(data) {
				$("#coreArea-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Core Focus Area ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($areaID)) {
	$area_sql=mysqli_query($con,"select * from tblcorereas where areaID = $areaID");
	$row=mysqli_fetch_array($area_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="dddfocusarea" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); ">

								<div class="form-group">
									<label for="coreArea">
										Core Area
									</label>
									<input type="text" name="coreArea" id="coreArea" class="form-control" <?php if(!empty($areaID) || $areaID)
									{?>value ="<?php echo $row['coreArea']; ?>"<?php } else{?> placeholder="Enter Project Core Area"<?php } ?> required="true"
									onBlur="checkcoreAreaAvailability()">
									<span id="coreArea-availability-status"></span>
								</div>

								<button type="submit"  <?php if(!empty($areaID) || $areaID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($areaID) || $areaID)
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