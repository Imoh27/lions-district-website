<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblregion where regionID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<title>Admin | Regions</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Regions';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>

	<div class="row">
		<!-- REGIONS TABLE -->
		<div class="col-md-5 mr-5">
			<h5 class="over-title margin-bottom-15 d-inline">Regions<span class="text-bold"></span></h5>
			<a href="add-region" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Regions"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Region Name</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "select * from tblregion");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td>Region <?php echo $row['region']; ?></td>

							<td>
								<div class="visible-md visible-lg">
									<a href="add-region?id=<?php echo $row['regionID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-regions?id=<?php echo $row['regionID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
							</td>
						</tr>
					<?php
						$cnt = $cnt + 1;
					} ?>
				</tbody>
			</table>
		</div>

		<!-- ZONES TABLES -->
		<div class="col-md-5 ml-5">
			<h5 class="over-title margin-bottom-15 d-inline">Zones<span class="text-bold"></span></h5>
			<a href="add-zone" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Zone"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Zone Name</th>
						<th>Region</th>
						<th>Action</th>
	
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "SELECT * from tblzone z JOIN tblregion r ON r.regionID = z.regionID");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td>Zone <?php echo $row['zoneName']; ?></td>
							<td>Region <?php echo $row['region']; ?></td>
	
							<td>
								<div class="visible-md visible-lg">
									<a href="add-zone?id=<?php echo $row['zoneID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-regions-and-zones?id=<?php echo $row['zoneID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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