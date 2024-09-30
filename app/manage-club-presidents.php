<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from tblregionchairperson where rcID = '".$_GET['id']."'");
	$_SESSION['msg']="data deleted !!";
}
include("assets/topheader.php");
?>
	<title>Admin | Club Presidents</title>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Club Presidents';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline"><span class="text-bold">Club Presidents</span></h5> 
			<a href="add-president" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Full Name</th>
						<th>Honors</th>
						<th >Club</th>
						<th >Phone</th>
						<th>Photo </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"SELECT * from tblclubpresidents cp
					JOIN tblclubs c On cp.clubID = c.clubID "
				);
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
						<tr>
							<td class="center"><?php echo $cnt;?>.</td>
							<td><?php echo $row['fullName'];?></td>
							<td><?php echo $row['lions_awards'];?></td>
							<td><?php echo $row['clubName'];?></td>
							<td><?php echo $row['phoneNo'];?></td>
							<td class="user-profile img-fluid"><img src="cp_photos/<?php echo $row['cpPhoto'];?>" alt=""></td>
						
						</td>
						<td >
							<div class="visible-md visible-lg">
								<a href="add-president?id=<?php echo $row['cpID'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
								<a href="manage-club-president?id=<?php echo $row['cpID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
<?php 
include('include/footer.php');
include('assets/app-footer.php');
?>

</body>