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
<title>Admin | Project Donations</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Project Donations';
	$x_content = true;
	include('include/header.php'); 
	?>
	
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline"> Project<span class="text-bold"> Donations</span></h5>
			<a style="float: right;" href="print-report?id=<?php echo $drow['donationID'] ?>&page=donation" title="Print" onClick="return confirm('Prit this Page?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Print"><i class="fa fa-print fa fa-white"></i></a>

			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Project</th>
						<th>Name</th>
						<th>Amount</th>
						<th>Phone</th>
						<th>Payment Ref</th>
						<th>Date</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * from tbldonations d JOIN tblcoreprojects cp ON cp.coreprojectID = d.coreprojectID";
					// echo $query; exit;
					$donationssql = mysqli_query($con, $query);
					$cnt = 1;
					while ($drow = mysqli_fetch_array($donationssql) ) {
						// echo $drow['dateUpdated']; exit;
					?>
						<tr>
							<!-- <td class="center">psdisnsdndndn</td> -->
							<td class="center"><?php echo $cnt; ?>.</td>
							<td> <?php echo $drow['projectTitle']; ?></td>
							<td><?php echo $drow['fullName']; ?></td>
							<td> <?php echo $drow['amount']; ?></td>
							<td> <?php echo $drow['phone']; ?></td>
							<td> <?php echo $drow['paymentRef']; ?></td>
							<td> <?php echo date('d-m-Y', strtotime($drow['dateUpdated'])); ?></td>

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