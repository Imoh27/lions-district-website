<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblpdg where pdgID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<title>Admin | Clubs</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Clubs';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline">Manage <span class="text-bold">Clubs</span></h5>
			<a href="add-club" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Regions"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Club Name</th>
						<th>Region</th>
						<th>Club Number</th>
						<th>Charter Date</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "SELECT * from tblclubs c INNER JOIN tblregion r ON r.regionID = c.regionID");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td> <?php echo $row['clubName']; ?> Lions Club</td>
							<td>Region <?php echo $row['region']; ?></td>
							<td> <?php echo $row['indexNo']; ?></td>
							<td> <?php echo $row['charterDate']; ?></td>

							<td>
								<div class="visible-md visible-lg">
									<a href="add-club?id=<?php echo $row['clubID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-clubs?id=<?php echo $row['clubID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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