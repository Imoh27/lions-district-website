<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from tblpdg where pdgID = '".$_GET['id']."'");
	$_SESSION['msg']="data deleted !!";
}
include("assets/topheader.php");
?>
	<title>Admin | Past District Governors</title>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Past District Governors';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline">Manage <span class="text-bold">Past District Governors</span></h5> 
			<a href="add-past-district-governors" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Past DG"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>app/manage-past-district-governors.php
					<tr>
						<th class="center">#</th>
						<th>Full Name</th>
						<th>Honors</th>
						<th >Service Year</th>
						<th >Service Theme</th>
						<th>Photo </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"select * from tblpdg");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
						<tr>
							<td class="center"><?php echo $cnt;?>.</td>
							<td><?php echo $row['fullName'];?></td>
							<td><?php echo $row['lci_awards'];?></td>
							<td><?php echo $row['service_year'];?></td>
							<td><?php echo $row['service_theme'];?></td>
							<td class="user-profile img-fluid"><img src="pdgs_photos/<?php echo $row['pdgPhoto'];?>" alt=""></td>
						
						</td>
						<td >
							<div class="visible-md visible-lg">
								<a href="add-past-district-governors?id=<?php echo $row['pdgID'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
								<a href="manage-past-district-governors?id=<?php echo $row['pdgID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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