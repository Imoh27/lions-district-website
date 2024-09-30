<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$catID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$categoryName = strip_tags($_POST['category']);
$catDescription = strip_tags($_POST['catDescription']);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

		$category_insert_sql = "INSERT into tblcategory values(null,'$categoryName', '$catDescription', now(), '$loggedin')";
		// echo ($leader_insert_sql);
		// exit;
		$category_result = mysqli_query($con, $category_insert_sql);
		if ($category_result) {
			echo "<script>alert('Category Added Successfully');</script>";
			echo "<script>window.location.href ='manage-category'</script>";
		}
	}
if (isset($_POST['update'])) {
	

		$sql = "UPDATE tblcategory  SET categoryName = '$categoryName', catDescription = '$catDescription',
		dateUpdated = now(), updatedBy = '$loggedin' WHERE catID = $catID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Category Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-category'</script>";
		}
	}

include("assets/topheader.php");
?>
<title>Admin | category</title>
<script>
	function checkcategoryAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'category=' + $("#category").val(),
			type: "POST",
			success: function(data) {
				$("#category-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Update Category ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($catID)) {
	$category_sql=mysqli_query($con,"select * from tblcategory where catID = $catID");
	$row=mysqli_fetch_array($category_sql);
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
									<label for="category">
										category
									</label>
									<input type="text" name="category" id="category" class="form-control" <?php if(!empty($catID) || $catID)
									{?>value ="<?php echo $row['categoryName']; ?>"<?php } else{?> placeholder="Enter Event Category"<?php } ?> required="true"
									onBlur="checkcategoryAvailability()">
									<span id="category-availability-status"></span>
								</div>

								<div class="form-group">
									<label for="category">
										Description
									</label>
									<input type="text" name="catDescription" id="catDescription" class="form-control" <?php if(!empty($catID) || $catID)
									{?>value ="<?php echo $row['catDescription']; ?>"<?php } else{?> placeholder="Enter Category catDescription"<?php } ?> 
									>
								</div>

							

								<button type="submit"  <?php if(!empty($catID) || $catID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($catID) || $catID)
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