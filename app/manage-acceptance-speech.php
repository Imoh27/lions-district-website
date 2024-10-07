<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
	mysqli_query($con, "delete from tblacceptancespeech where speechID = '" . $_GET['id'] . "'");
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<title>Admin | Acceptance Speech</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Acceptance Speech';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15 d-inline">Manage <span class="text-bold">Acceptance Speech</span></h5>
			<a href="upload-acceptance-speech" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Document Name</th>
						<th>Acceptance Speech</th>
						<th>Service Year</th>

						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = mysqli_query($con, "SELECT * from tblacceptancespeech a JOIN  tblserviceyr s ON s.serviceYrID = a.serviceYrID");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>
						<tr>
							<td class="center"><?php echo $cnt; ?>.</td>
							<td><?php echo $row['docName']; ?></td>
							<td class="user-profile img-fluid"><img src="../images/icon-image/pdficon.jpg" alt=""><a href="speechDoc_Photos/<?php echo $row['doc']; ?>"><?php echo $row['doc']; ?></a> </td>
							<td><?php echo $row['serviceYr']; ?></td>

							<td>
								<div class="visible-md visible-lg">
									<a href="upload-acceptance-speech.php?id=<?php echo $row['speechID']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
									<a href="manage-acceptance-speech.php?id=<?php echo $row['speechID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>

</body>