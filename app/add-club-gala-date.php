<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$dateID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$clubID = strip_tags($_POST['clubID']);
$galaDate = strip_tags($_POST['galaDate']);
$serviceYrID = $lsyrow['serviceYrID'];
// echo $serviceYrID; exit;
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	
		$date_select = "SELECT galaDate from tblclubgaladates WHERE galaDate = '$galaDate'";
		$query=mysqli_query($con, $date_select);
		$fetch=mysqli_fetch_array($query);
		
		if(!empty($fetch)) {
			echo "<script>alert('Date already Available, Try another');</script>"; 
		} else {
			$date_insert_sql = "INSERT into tblclubgaladates values(null, $clubID , $serviceYrID, '$galaDate', now(), '$loggedin')";
			// echo ($date_insert_sql);
			// exit;
			$gala_result = mysqli_query($con, $date_insert_sql);
			if ($gala_result) {
				
				echo "<script>alert('Gala Date Added Successfully');</script>";
				echo "<script>window.location.href ='club-gala-dates'</script>";
			}
		}
	}
if (isset($_POST['update'])) {
	
		$sql = "UPDATE tblclubgaladates SET clubID = $clubID, galaDate = '$galaDate', dateUpdated = now(), updatedBy = '$loggedin' WHERE dateID = $dateID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
		
			echo "<script>alert('Gala Date Updated Successfully');</script>";
			echo "<script>window.location.href ='club-gala-dates'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Add Club Gala Date</title>
<script>
	function checkDateAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'galaDate=' + $("#galaDate").val(),
			type: "POST",
			success: function(data) {
				$("#date-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Club Gala Date ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

// SELECT CATEGORY

	$club_sql = mysqli_query($con, "select * from  tblclubs");
	
	// For Editing
	if(!empty($dateID)) {
	$galas_sql=mysqli_query($con,"select * from tblclubgaladates g JOIN tblclubs c ON c.clubID = g.clubID where g.dateID = $dateID");
	$row=mysqli_fetch_array($galas_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addinternationalleaders" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">
								<div class="form-group">
									<label for="clubID">
										Select Club
									</label>
									<select name="clubID" id="clubID" class="form-control" required="true">
										<?php if (!empty($dateID) || $dateID) { ?>
											<option value="<?php echo $row['clubID']; ?>">  <?php echo $row['clubName']; ?></option>
										<?php } else { ?>
											<option value=""></option>

										<?php }
										while ($cat_row = mysqli_fetch_array($club_sql)) { ?>
											<option value="<?php echo $cat_row['clubID']; ?>"> <?php echo $cat_row['clubName']; ?></option>
										<?php }
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="galaDate">
										Gala Date
									</label>
									<input type="date" name="galaDate" id="galaDate" class="form-control"<?php if(!empty($dateID) || $dateID)
									{?>value ="<?php echo $row['galaDate']; ?>"<?php }?> onBlur="checkdateAvailability()">
									<span id="date-availability-status"></span>
								</div>
								

								<button type="submit"  <?php if(!empty($dateID) || $dateID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($dateID) || $dateID)
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