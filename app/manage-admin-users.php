<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_GET['del'])) {
	mysqli_query($con, "delete from admin where id = $adminID");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");

?>
<title>Admin | Manage Users</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Users';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline">Manage <span class="text-bold">Users</span></h5>
			<a href="admin-user" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Admin User"><i class="fa fa-plus"></i></a>

			<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
				<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Username</th>

						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "select * from admin");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td><?php echo $row['username']; ?></td>

							<td>
								<div class="visible-md visible-lg hidden-sm hidden-xs">
								<a href="admin-user?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
								<a href="?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
	<!-- start: FOOTER -->
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>
</body>

</html>