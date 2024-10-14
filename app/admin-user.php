<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(!empty($_GET['id'])){
	$adminID = $_GET['id'];
}
$username = $_POST['username'];
$userPWD = md5($_POST['userPWD']);
$admintype = 'user';
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
		$sql = "INSERT into admin values(null,'$username','$userPWD','$admintype', now(), '$loggedin')";
		// echo ($sql);
		// exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('New User Created Successfully');</script>";
			echo "<script>window.location.href ='manage-admin-users'</script>";
		}
	}

if (isset($_POST['update'])) {
	

		$sql = "UPDATE admin  SET username = '$username', password = '$userPWD', 
		dateUpdated = now(), updatedBy = '$loggedin' WHERE id = $adminID";
		// echo ($sql);
		// exit;
		
		
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			
			echo "<script>alert('New USer Updated Successfully');</script>";
			echo "<script>document.addusername.focus();;</script>";
			echo "<script>window.location.href ='manage-admin-users'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | Update Admin Users</title>
<script>
	function checkUsernameAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'username=' + $("#username").val(),
			type: "POST",
			success: function(data) {
				$("#username-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Update Admin Users';
	$x_content = true;
	?>
	<?php include('include/header.php'); 
	// echo $adminID; exit;
	// FOR EDITING
	$sql=mysqli_query($con,"select * from admin where id = $adminID");
	$row=mysqli_fetch_array($sql);
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addusername" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">

								<div class="form-group">
									<label for="username">
										Username
									</label>
									<input type="text" name="username" id="username" class="form-control" <?php if(!empty($adminID) || $adminID)
									{?>value ="<?php echo $row['username']; ?>"<?php } ?> required="true"
									onBlur="checkusernameAvailability()">
									<span id="username-availability-status"></span>
								</div>


								<div class="form-group">
									<label for="userPWD">
										Password
									</label>
									<input type="password" name="userPWD" class="form-control"<?php if(!empty($adminID) || $adminID)
									{?>value ="<?php echo $row['password']; ?>"<?php } ?>
									 required="true">
								</div>

								<button type="submit"  <?php if(!empty($adminID) || $adminID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($adminID) || $adminID)
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