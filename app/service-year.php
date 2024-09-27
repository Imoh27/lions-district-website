<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
	$docspecialization=$_POST['Doctorspecialization'];
	$docname=$_POST['docname'];
	$docaddress=$_POST['clinicaddress'];
	$docfees=$_POST['docfees'];
	$doccontactno=$_POST['doccontact'];
	$docemail=$_POST['docemail'];
	$password=md5($_POST['npass']);
	$sql=mysqli_query($con,"insert into doctors(specilization,doctorName,address,docFees,contactno,docEmail,password) values('$docspecialization','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password')");
	if($sql)
	{
		echo "<script>alert('Doctor info added Successfully');</script>";
		echo "<script>window.location.href ='manage-doctors.php'</script>";

	}
}
include("assets/topheader.php");
?>
<title>Admin | Dashboard</title>
	<script>
		function checkemailAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "assets/check_sy.php",
				data:'emailid='+$("#docemail").val(),
				type: "POST",
				success:function(data){
					$("#email-availability-status").html(data);
					$("#loaderIcon").hide();
				},
				error:function (){}
			});
		}
	</script>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Add Service Year';
	$x_content = true;
	?>
	<?php include('include/header.php');?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-8 col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="adddoc" method="post" onSubmit="return valid();">
							
								<div class="form-group">
									<label for="doctorname">
										Service Year
									</label>
									<input type="text" name="lsy" class="form-control"  placeholder="Example 2024/2025" required="true">
								</div>


								<div class="form-group">
									<label for="address">
										Doctor Clinic Address
									</label>
									<textarea name="clinicaddress" class="form-control"  placeholder="Enter Doctor Clinic Address" required="true"></textarea>
								</div>
								<div class="form-group">
									<label for="fess">
										Doctor Consultancy Fees
									</label>
									<input type="text" name="docfees" class="form-control"  placeholder="Enter Doctor Consultancy Fees" required="true">
								</div>

								<div class="form-group">
									<label for="fess">
										Doctor Contact no
									</label>
									<input type="text" name="doccontact" class="form-control"  placeholder="Enter Doctor Contact no" required="true">
								</div>

								<div class="form-group">
									<label for="fess">
										Doctor Email
									</label>
									<input type="email" id="docemail" name="docemail" class="form-control"  placeholder="Enter Doctor Email id" required="true" onBlur="checkemailAvailability()">
									<span id="email-availability-status"></span>
								</div>




								<div class="form-group">
									<label for="exampleInputPassword1">
										Password
									</label>
									<input type="password" name="npass" class="form-control"  placeholder="New Password" required="required">
								</div>

								<div class="form-group">
									<label for="exampleInputPassword2">
										Confirm Password
									</label>
									<input type="password" name="cfpass" class="form-control"  placeholder="Confirm Password" required="required">
								</div>



								<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
									Submit
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
