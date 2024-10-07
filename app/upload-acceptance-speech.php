<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$speechID = $_GET['id'];

$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);


$docName = strip_tags($_POST['docName']);
$serviceYrID = $lsyrow['serviceYrID'];
$speechDoc =  strtolower($_FILES["speechDoc"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	// echo $dgteamProfile; exit;
	$extension = substr($speechDoc, strlen($speechDoc) - 4, strlen($speechDoc));
	// allowed extensions
	$allowed_extensions = array(".pdf");
	if (!in_array($extension, $allowed_extensions)) {
		echo "<script>alert('Invalid format. Only PDF format allowed');</script>";
	} else {
		//rename the image file
		$newspeechDoc = $docName . '_' . $speechDoc;

		$doc_insert_sql = "INSERT into tblacceptancespeech values(null,$serviceYrID,'$docName','$newspeechDoc',now(), '$loggedin')";
		// echo ($doc_insert_sql);
		// exit;
		$doc_result = mysqli_query($con, $doc_insert_sql);
		if ($doc_result) {
			move_uploaded_file($_FILES["speechDoc"]["tmp_name"], "speechDoc_Photos/" . $newspeechDoc);
			echo "<script>alert('Acceptace Speech Added Successfully');</script>";
			echo "<script>window.location.href ='manage-acceptance-speech'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($speechDoc)) {
	// get the image extension
	$extension = substr($speechDoc, strlen($speechDoc) - 4, strlen($speechDoc));
	// allowed extensions
	$allowed_extensions = array(".pdf");
	if (!in_array($extension, $allowed_extensions)) {
		echo "<script>alert('Invalid format. Only PDF format allowed');</script>";
	} else {
		//rename the image file
		$newspeechDoc = $docName . '_' . $speechDoc;
	}
}

		$sql = "UPDATE tblacceptancespeech SET docName = '$docName', 
		dateUpdated = now(), updatedBy = '$loggedin'";
		// echo ($sql);
		// exit;
		if(!empty($speechDoc)) {
			$sql .= " speechDoc = '$newspeechDoc'";
		}
		$sql .= " WHERE speechID = $speechID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($speechDoc)) {
			move_uploaded_file($_FILES["speechDoc"]["tmp_name"], "speechDoc_Photos/" . $newspeechDoc);
			}
			echo "<script>alert('Acceptance SPeech Updated Successfully');</script>";
			echo "<script>window.location.href ='manage-acceptance-speech'</script>";
		}
	}

include("assets/topheader.php");
?>

    
<title>Admin | Upload Acceptance Speech</title>
<script>
	function checkspeechAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'docName=' + $("#docName").val(),
			type: "POST",
			success: function(data) {
				$("#speech-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Upload Acceptance Speech ('. $lsyrow['serviceYr'].')';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($speechID)) {
	$dgteams_sql=mysqli_query($con,"SELECT * from tblacceptancespeech
	 where speechID = $speechID");
	$row=mysqli_fetch_array($dgteams_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="add_dgteam" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">

								<div class="form-group">
									<label for="docName">
										Document Name
									</label>
									<input type="text" name="docName" id="docName" class="form-control" <?php if(!empty($speechID) || $speechID)
									{?>value ="<?php echo $row['docName']; ?>"<?php } else{?> placeholder="Enter Full name"<?php } ?> required="true"
									onBlur="checkspeechAvailability()">
									<span id="speech-availability-status"></span>
								</div>

								
								<div class="form-group">
									<label for="speechDoc">
										Select Acceptance Speech <em>(PDF Only)</em>
									</label>
									<input type="file" name="speechDoc" class="form-control" accept=".pdf" <?php if(empty($speechID) || !$speechID)
									{?>required="true"<?php } ?>> <?php if(!empty($speechID) || $speechID)
									{?><div class="d-inline user-profile img-fluid"><img  src="../images/icon-image/pdficon.jpg" alt=""><?php echo $row['doc']; ?></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($speechID) || $speechID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($speechID) || $speechID)
								{?>Update <?php } else {?> Submit <?php } ?>
								</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="panel panel-white">


			</div>
		</div>
	</div>
	<!-- start: FOOTER -->
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>
       
</body>

</html>