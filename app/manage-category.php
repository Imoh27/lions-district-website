<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblcategory where catID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<title>Admin | Events Category</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Events Category';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>

	<div class="row">
		<!-- REGIONS TABLE -->
		<div class="col-md-6 mr-5">
			<h5 class="over-title margin-bottom-15 d-inline">Events Category<span class="text-bold"></span></h5>
			<a href="add-category" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Regions"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Category Name</th>
						<th>Description</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "select * from tblcategory");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td> <?php echo $row['categoryName']; ?></td>
							<td> <?php echo $row['catDescription']; ?></td>

							<td>
								<div class="visible-md visible-lg">
									<a href="add-category?id=<?php echo $row['catID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-category?id=<?php echo $row['catID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
							</td>
						</tr>
					<?php
						$cnt = $cnt + 1;
					} ?>
				</tbody>
			</table>
		</div>

	
	</div>
	
	
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>

</body>