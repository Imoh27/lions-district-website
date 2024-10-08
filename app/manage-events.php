<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from tblevents where eventID = '".$_GET['id']."'");
	$_SESSION['msg']="data deleted !!";
}
include("assets/topheader.php");
?>
	<title>Admin | Events</title>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Events';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline">Manage <span class="text-bold">Events</span></h5> 
			<a href="add-event" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Event"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Event Category</th>
						<th>Title</th>
						<th >Location</th>
						<th>Start Date </th>
						<th>End Date </th>
						<th>Cordinator </th>
						<th>Cordinator Contact </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"SELECT * from tblevents e JOIN  tblcategory c ON c.catID = e.catID ORDER BY endDate DESC");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
						<tr>
							<td class="center"><?php echo $cnt;?>.</td>
							<td><?php echo $row['categoryName'];?></td>
							<td><?php echo $row['eventTitle'];?></td>
							<td><?php echo $row['eventLocation'];?></td>
							<td><?php echo $row['startDate'];?></td>
							<td><?php echo $row['endDate'];?></td>
							<td><?php echo $row['cordinatorName'];?></td>
							<td><?php echo $row['cordinatorPhone'];?></td>
						
						</td>
						<td >
							<div class="visible-md visible-lg">
								<a href="add-event?id=<?php echo $row['eventID'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
								<a href="?id=<?php echo $row['eventID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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