<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblregionchairperson where rcID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<title>Admin | Region/Zone Chairpersons</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Region/Zone Chairpersons';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">

	<!-- REGION CHAIRPERSONS -->
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline"><span class="text-bold">Region Chairpersons</span></h5>
			<a href="add-region-chairperson" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Full Name</th>
						<th>Region</th>
						<th>Photo </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query(
						$con,
						"select * from tblregionchairperson
					rc INNER JOIN  tblregion r ON r.regionID=rc.regionID"
					);
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td><?php echo $row['fullName'].' '.$row['lions_awards']; ?></td>
							<td>Region <?php echo $row['region']; ?></td>
							<td class="user-profile img-fluid"><img src="rc_photos/<?php echo $row['rcPhoto']; ?>" alt=""></td>

							</td>
							<td>
								<div class="visible-md visible-lg">
									<a href="add-region-chairperson?id=<?php echo $row['rcID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-region-chairperson?id=<?php echo $row['rcID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
								</div>
							</td>
						</tr>
					<?php
						$cnt = $cnt + 1;
					} ?>
				</tbody>
			</table>
		</div>

		<!-- ZONE CHAIRPERSONS -->
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline"><span class="text-bold">Zone Chairpersons</span></h5>
			<a href="add-zone-chairperson" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Full Name</th>
						<th>Zone</th>
						<th>Region</th>
						<th>Photo </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query(
						$con,
						"SELECT * from tblzonechairperson 
					zc JOIN tblzone z ON z.zoneID = zc.zoneID INNER JOIN  tblregion r ON r.regionID=zc.regionID"
					);
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td><?php echo $row['fullName'] . ' '.$row['lions_awards']; ?></td>
							<td>Region <?php echo $row['zoneName']; ?></td>
							<td>Region <?php echo $row['region']; ?></td>
							<td class="user-profile img-fluid"><img src="rc_photos/<?php echo $row['rcPhoto']; ?>" alt=""></td>

							</td>
							<td>
								<div class="visible-md visible-lg">
									<a href="add-region-chairperson?id=<?php echo $row['rcID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-region-chairperson?id=<?php echo $row['rcID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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