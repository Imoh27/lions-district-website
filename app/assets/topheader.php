
<!DOCTYPE html>
<html lang="en">
<head>

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
	<!-- Summernote css -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<!-- <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" /> -->



	<?php
	include_once('../include/config.php');
	$select = "SELECT * FROM tblserviceyr";
	// echo $select; exit;
	$sql=mysqli_query($con,$select);
	$row=mysqli_fetch_array($sql);
	// if($row){
	// 	echo "good"; exit;
	// }
	?>
	  <!-- Favicon
================================================== -->
<link rel="icon" type="image/png" href="sylogo/<?php echo $row['service_logo'];?>" />