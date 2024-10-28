<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
check_login();

//updating Admin Remark
if (isset($_POST['update'])) {
	$qid = intval($_GET['id']);
	mysqli_query($con, "UPDATE tblcontactus set IsRead = 1, readDate = now() where id = '$qid'");
	header("location: read-query?id=$qid&action=markread");
	$_SESSION['msg'] = "Message Read !!";
	// if($query){
	// 	echo "<script>alert('Admin Remark updated successfully.');</script>";
	// 	echo "<script>window.location.href ='read-query.php'</script>";
	// }
}
include("assets/topheader.php");
?>

<title>Admin | Query Details</title>
</head>

	
<body class="nav-md">
	<?php
	$page_title = 'Admin | Query Details';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Query Details</span></h5>
			<table class="table table-hover" id="sample-table-1">

				<tbody>
					<?php
					$qid = intval($_GET['id']);
					$sql = mysqli_query($con, "select * from tblcontactus where id='$qid'");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>

						<tr>
							<th>Full Name</th>
							<td><?php echo $row['fullname']; ?></td>
						</tr>

						<tr>
							<th>Email Id</th>
							<td><?php echo $row['email']; ?></td>
						</tr>
						<tr>
							<th>Subject</th>
							<td><?php echo $row['messageSubject']; ?></td>
						</tr>
						<tr>
							<th>Message</th>
							<td><?php echo $row['message']; ?></td>
						</tr>

						<tr>
							<th>Time Received</th>
							<td><?php echo $row['contactDate']; ?></td>
						</tr>
						<?php if ($row['Isread'] == 0) { ?>
							<form name="query" method="post">
								<tr>
									<td>&nbsp;</td>
									<td>
										<!-- <a href="read-query?id=<?php echo $row['id'] ?>&action=markread" onClick="return confirm('Mark this Message as read?')" class="btn btn-primary btn-sm tooltips" tooltip-placement="top" tooltip="Mark as read">Mark read <i class="fa fa-eye fa fa-white"></i></a>	 -->

										<a data-toggle="modal"
											data-target="#exampleModalCenter" class="btn btn-primary pull-left text-white" name="reply" tooltip-placement="top" tooltip="Reply">
											<i class="fa fa-reply"></i> Reply
										</a>

									</td>
								</tr>

							</form>
					<?php }
					} ?>

				</tbody>
			</table>
		</div>
	</div>
	<?php include('include/footer.php'); 
	include('assets/app-footer.php');

	if(isset($_POST['reply_message'])){

		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		require 'vendor/autoload.php';
// echo $message; exit;


$mail = new PHPMailer(true);
    
    try {
        $mail->SMTPDebug = 0;                     
        $mail->isSMTP();                                         
        $mail->Host       = 'mail.lionsdistrict404a2.com';   
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'info@lionsdistrict404a2.com';  
        $mail->Password   = 'lionsD404a2@';                      
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
        $mail->Port       = 465;       
        
        $mail->setFrom('info@lionsdistrict404a2.com', 'Lions District 404A2');
        $mail->addAddress($email);     
        
        $mail->isHTML(true);                                 
        $mail->Subject = $subject;
        $mail->Body    = '<html>
        <body>
        <table style="border-collapse:collapse;max-width:300px; ">
        <tbody>
            <tr>
                <td><b>Thank You for Contacting Us</b><br>
                    <br>
                    <p>'.$message.'</p> <br>

                     <hr style="border:0;border-bottom:1px solid #e9e9e9">
    
                    <p><a href="https://lionsdistrict404a2.com/events" style="color: #000; text-decoration:none; background-color: #ffb600; padding: 10px;">Explore our Various Activities</a></p> <br>
                   
                    Kind Regards,<br>
                    <strong>Lions District 404A2</strong>
                </td>
            </tr>
        </tbody>
    </table>
        </body>
        </html>';
		echo "<script>alert('Message Sent');</script>";
        echo 'Message has been sent';
		$_SESSION['msg']="Message Sent !!";
		$mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
	}
	
	$sql = mysqli_query($con, "select * from tblcontactus where id='$qid'");
	$nrow = mysqli_fetch_array($sql);
	?>
	<!-- REPLY MESSAGE -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-primary" id="exampleModalLongTitle">Reply to <?php echo $nrow['messageSubject']; ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>


				<form name="reply_message" id="reply_message" method="post" enctype="multipart/form-data">
					<div class="modal-body">

						<div class="col-md-12">
							<div class="form-group m-b-20">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" id="email" value="<?php echo $nrow['email']; ?>" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group m-b-20">
								<label for="subject">Subject</label>
								<input type="text" class="form-control" name="subject" id="subject" value="Re: <?php echo $nrow['messageSubject']; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
									<label for="message">
										Message
									</label>
									<textarea type="text" name="message" placeholder="Describe detailed profile" class="summernote"
									></textarea>
								</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="reply_message" class="btn btn-primary">Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	</body>

</html>