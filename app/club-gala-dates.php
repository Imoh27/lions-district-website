<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblclubgaladates where dateID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);

include("assets/topheader.php");
?>
<title>Admin | Clubs Gala Date</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Manage Clubs Gala Date ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline"><span class="text-bold">Club Gala Date</span></h5>
			<a href="add-club-gala-date" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Club</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "SELECT * from tblclubgaladates d JOIN tblclubs c ON c.clubID = d.clubID");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td><?php echo $row['clubName']; ?></td>
							<td><?php echo $row['galaDate']; ?></td>
							<td>
								<div class="visible-md visible-lg">
									<a href="add-club-gala-date?id=<?php echo $row['dateID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="?id=<?php echo $row['dateID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
	<?php
	include('include/footer.php');
	include('assets/app-footer.php');
	?>

</body>