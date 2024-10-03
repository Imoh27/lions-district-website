<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from tbldgteam where dgteamID = '".$_GET['id']."'");
	$_SESSION['msg']="data deleted !!";
}
include("assets/topheader.php");
?>
	<title>Admin | District Governor's Team</title>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | District Governors Team';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline">Manage <span class="text-bold">DG Team</span></h5> 
			<a href="add-dgteam" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Full Name</th>
						<th>Honors</th>
						<th >Position</th>
						<th>Photo </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"SELECT * from tbldgteam d JOIN tbloffices o ON o.officeID = d.officeID");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
						<tr>
							<td class="center"><?php echo $cnt;?>.</td>
							<td><?php echo $row['fullName'];?></td>
							<td><?php echo $row['lci_awards'];?></td>
							<td><?php echo $row['position'];?></td>
							<td class="user-profile img-fluid"><img src="dgteam_Photos/<?php echo $row['dgteamPhoto'];?>" alt=""></td>
						
						</td>
						<td >
							<div class="visible-md visible-lg">
								<a href="add-dgteam.php?id=<?php echo $row['dgteamID'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
								<a href="manage-dgteam.php?id=<?php echo $row['dgteamID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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