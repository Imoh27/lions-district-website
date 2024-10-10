<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

//updating Admin Remark
if(isset($_POST['update']))
{
	$qid=intval($_GET['id']);
	mysqli_query($con,"UPDATE tblcontactus set IsRead = 1, readDate = now() where id = '$qid'");
	header("location: read-query?id=$qid&action=markread");
	$_SESSION['msg']="Message Read !!";
	// if($query){
	// 	echo "<script>alert('Admin Remark updated successfully.');</script>";
	// 	echo "<script>window.location.href ='read-query.php'</script>";
	// }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin | Query Details</title>

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
	$page_title = 'Admin | Query Details';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Query Details</span></h5>
			<table class="table table-hover" id="sample-table-1">

				<tbody>
					<?php
					$qid=intval($_GET['id']);
					$sql=mysqli_query($con,"select * from tblcontactus where id='$qid'");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>

						<tr>
							<th>Full Name</th>
							<td><?php echo $row['fullname'];?></td>
						</tr>

						<tr>
							<th>Email Id</th>
							<td><?php echo $row['email'];?></td>
						</tr>
						<tr>
							<th>Conatact Numner</th>
							<td><?php echo $row['contactno'];?></td>
						</tr>
						<tr>
							<th>Message</th>
							<td><?php echo $row['message'];?></td>
						</tr>

						<tr>
							<th>Time Received</th>
							<td><?php echo $row['contactDate'];?></td>
						</tr>
						<?php if($row['Isread']==0){?>
							<form name="query" method="post">
								<tr>
									<td>&nbsp;</td>
									<td>
									<!-- <a href="read-query?id=<?php echo $row['id']?>&action=markread" onClick="return confirm('Mark this Message as read?')" class="btn btn-primary btn-sm tooltips" tooltip-placement="top" tooltip="Mark as read">Mark read <i class="fa fa-eye fa fa-white"></i></a>	 -->

										<button type="submit" class="btn btn-primary pull-left" name="update" onClick="return confirm('Mark this Message as read?')" tooltip-placement="top" tooltip="Mark as read">
											Mark Read <i class="fa fa-arrow-circle-right"></i>
										</button>

									</td>
								</tr>

							</form>
						<?php } }?>

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