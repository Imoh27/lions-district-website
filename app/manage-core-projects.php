<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblcoreprojects where coreprojectID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<title>Admin | Core Projects</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Core Projects';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>

	<div class="row">
		<!-- FOCUS AREAS -->
		<div class="col-md-4 mr-5">
			<h5 class="over-title margin-bottom-15 d-inline">Core Project Areas<span class="text-bold"></span></h5>
			<a href="add-focus-area" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Projet Are"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Project Areas</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "select * from tblcorereas");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td> <?php echo $row['coreArea']; ?></td>

							<td>
								<div class="visible-md visible-lg">
									<a href="add-focus-area?id=<?php echo $row['areaID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-core-projects?id=<?php echo $row['areaID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
							</td>
						</tr>
					<?php
						$cnt = $cnt + 1;
					} ?>
				</tbody>
			</table>
		</div>

		<!-- CORE PROJECTS -->
		<div class="col-md-7">
			<h5 class="over-title margin-bottom-15 d-inline">Core Projects<span class="text-bold"></span></h5>
			<a href="add-core-project" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Core Project"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Project Title</th>
						<th>Description</th>
						<th>Focus Area</th>
						<th>Coordinator</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "SELECT * from tblcoreprojects p JOIN tblcorereas a ON a.areaID = p.areaID");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td> <?php echo $row['projectTitle']; ?></td>
							<td> <?php echo substr($row['projectDesc'], 0, 177)?><b>...</b></td>
							<td> <?php echo $row['coreArea']; ?></td>
							<td> <?php echo ucwords($row['coordinatorName']); ?></td>

							<td>
								<div class="visible-md visible-lg">
									<a href="add-core-project?id=<?php echo $row['coreprojectID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="?id=<?php echo $row['coreprojectID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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