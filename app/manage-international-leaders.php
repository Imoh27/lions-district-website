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
include("assets/topheader.php");
?>
	<title>Admin | International Leaders</title>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage International Leaders';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline">Manage <span class="text-bold">International Leaders</span></h5> 
			<a href="international-leaders.php" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Name</th>
						<th >Position</th>
						<th>Service Logo </th>
						<th>Start Date </th>
						<th>End Date </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"select * from tblserviceyr");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
						<tr>
							<td class="center"><?php echo $cnt;?>.</td>
							<td><?php echo $row['serviceYr'];?></td>
							<td><?php echo $row['service_theme'];?></td>
							<td class="user-profile img-fluid"><img  src="sylogo/<?php echo $row['service_logo'];?>" alt=""></td>
							<td><?php echo $row['from_date'];?></td>
							<td><?php echo $row['stop_date'];?>
						</td>
						<td >
							<div class="visible-md visible-lg">
								<a href="service-year.php?id=<?php echo $row['serviceYrID'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
								<a href="manage-doctors.php?id=<?php echo $row['serviceYrID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
<?php include('include/footer.php');
	include('assets/app-footer.php');
?>

</body>