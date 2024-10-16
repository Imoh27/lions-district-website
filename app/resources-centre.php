<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblresources where rcID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<title>Admin | Resources Centre</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Manage Resources';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline"><span class="text-bold">Resources Centre</span></h5>
			<a href="add-resources" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Resource Title</th>
						<th>File Name</th>
						<th>File Type</th>
						<th>File Size</th>

						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "SELECT * from tblresources");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td><?php echo $row['trainingTitle']; ?></td>
							<td><a href="../resources/<?php echo $row['fileName']; ?>"><?php echo $row['fileName']; ?></a></td>
							<td class="user-profile img-fluid">
								<?php if ($row['fileType'] == 'ppt' || $row['fileType'] == 'pptx') { ?>
									<img src="../images/ppt.png">PowerPoint <?php } else if ($row['fileType'] == 'pdf') { ?>
									<img src="../images/pdf.webp">PDF <?php } ?>
							</td>
							<td><?php echo $row['fileSize']; ?></td>

							</td>
							<td>
								<div class="visible-md visible-lg">
									<a href="add-resources?id=<?php echo $row['resourceID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="?id=<?php echo $row['resourceID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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