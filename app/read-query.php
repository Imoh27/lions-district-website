<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from doctors where id = '".$_GET['id']."'");
	$_SESSION['msg']="data deleted !!";
}

	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin | Manage Read Queries</title>
	<!-- Bootstrap -->
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-progressbar -->
	<link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
	<!-- JQVMap -->
	<link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
	<!-- bootstrap-daterangepicker -->
	<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="assets/css/custom.min.css" rel="stylesheet">
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Read Queries';
	$x_content = true;
	// if
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12 new-overflow">
			<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Read Queries</span></h5>
			<table class="table table-hover " id="sample-table-1" >
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Subject. </th>
						<th>Message </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"select * from tblcontactus where IsRead =1");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
							<tr>
							<td width="50" class="center"><?php echo $cnt;?>.</td>
							<td width="150"><?php echo $row['fullname'];?></td>
							<td width="100"><?php echo $row['email'];?></td>
							<td width="120"><?php echo $row['messageSubject'];?></td>
							<td><?php echo $row['message'];?></td>
							<td width="150">
								<div>
									<a href="query-details?id=<?php echo $row['id'];?>" class="btn btn-transparent btn-sm" title="Reply"><i class="fa fa-reply"></i></a>
									<a href="query-details?id=<?php echo $row['id'];?>" class="btn btn-transparent btn-sm" title="View Details"><i class="fa fa-file"></i></a>
									<a href="?id=<?php echo $row['id'];?>&del=delete" onClick="return confirm('You are about to delete this message?')"  class="btn btn-transparent btn-sm" title="Delete"><i class="fa fa-times"></i></a>
								</div>
							</td>
						</tr>
						<?php
						$cnt=$cnt+1;
					}?>
				</tbody>
			</table>
		</div>
	</div>

	
	<?php include('include/footer.php');?>
	<!-- jQuery -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="vendors/nprogress/nprogress.js"></script>
	<!-- Chart.js -->
	<script src="vendors/Chart.js/dist/Chart.min.js"></script>
	<!-- gauge.js -->
	<script src="vendors/gauge.js/dist/gauge.min.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="vendors/iCheck/icheck.min.js"></script>
	<!-- Skycons -->
	<script src="vendors/skycons/skycons.js"></script>
	<!-- Flot -->
	<script src="vendors/Flot/jquery.flot.js"></script>
	<script src="vendors/Flot/jquery.flot.pie.js"></script>
	<script src="vendors/Flot/jquery.flot.time.js"></script>
	<script src="vendors/Flot/jquery.flot.stack.js"></script>
	<script src="vendors/Flot/jquery.flot.resize.js"></script>
	<!-- Flot plugins -->
	<script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
	<script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
	<script src="vendors/flot.curvedlines/curvedLines.js"></script>
	<!-- DateJS -->
	<script src="vendors/DateJS/build/date.js"></script>
	<!-- JQVMap -->
	<script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
	<script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
	<script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="vendors/moment/min/moment.min.js"></script>
	<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="assets/js/custom.min.js"></script>
</body>