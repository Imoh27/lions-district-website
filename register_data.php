<?php

error_reporting(0);
include "includes/all-select-data.php";
include "includes/config.php";

if (isset($_POST['getcode'])) {
  
$lionsID = strip_tags($_POST['lionsID']);
$fullname = strip_tags($_POST['fullname']);
$club = strip_tags($_POST['club']);
$phone = strip_tags($_POST['fone']);
$email = strip_tags($_POST['email']);

$status = 0;



// echo $codemsg; exit;

    // $mail = new PHPMailer(true);

    // try {
    //     $mail->SMTPDebug = 0;                     
    //     $mail->isSMTP();                                         
    //     $mail->Host       = 'lionsdistrict404a2.org';   
    //     $mail->SMTPAuth   = true;                                   
    //     $mail->Username   = 'vote@lionsdistrict404a2.org';  
    //     $mail->Password   = 'LD404A2.org';                      
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
    //     $mail->Port       = 465;       

    //     $mail->setFrom('vote@lionsdistrict404a2.org', 'Lions District 404A2');
    //     $mail->addAddress($email);     

    //     $mail->isHTML(true);                                 
    //     $mail->Subject = 'Dear '.$fullname;
    //     $mail->Body    = '<html>
    //     <body>
    //     <table style="border-collapse:collapse;max-width:300px; ">
    //     <tbody>
    //         <tr>
    //             <td>Dear '.$fullname.',<br>
    //                 <br>
    //                 Your registration is succesful, your voting code is <br>
    //                  <p style="font-weight: bold; font:22px">'.$voterscode.' </p>

    //                  Kindly note... Voters code is invalid after one(1) vote

    //                 <hr style="border:0;border-bottom:1px solid #e9e9e9">

    //                 <p> Follow the link to proceed to vote <a href="https://vote.lionsdistrict404a2.org/voting/index.php" style="color: #fff; text-decoration:none; background-color: #0842a0; padding: 10px;">Explore our various Activities</a></p> <br>

    //                 Kind Regards,<br>
    //                 <strong>Lions District 404A2</strong>
    //             </td>
    //         </tr>
    //     </tbody>
    // </table>
    //     </body>
    //     </html>';
    //     echo 'Message has been sent';
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }


    // //Create an instance; passing `true` enables exceptions
    // $copymail = new PHPMailer(true);

    // try {
    //     //Server settings
    //     $copymail->SMTPDebug = 0;                  
    //     $copymail->isSMTP();    
    //     $copymail->Host       = 'lionsdistrict404a2.org';   
    //     $copymail->SMTPAuth   = true;     
    //     $copymail->Username   = 'vote@lionsdistrict404a2.org';                     //SMTP username
    //     $copymail->Password   = 'LD404A2.org';      
    //     $copymail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        
    //     $copymail->Port       = 465;    
    //     $copymail->setFrom('vote@lionsdistrict404a2.org', 'Lions District 404A2');
    //     $copymail->addAddress('benakiconcepts@gmail.com'); 
    //     $copymail->isHTML(true);                                  //Set ecopymail format to HTML
    //     $copymail->Subject = 'New Member '.$fullname.' registered ';
    //     $copymail->Body    = '<html>
    //     <body>
    //     <table style="border-collapse:collapse;max-width:300px; ">
    //     <tbody>
    //         <tr>
    //             <td>
    //             Leo '.$fullname.' of '.$club.' just registered  <br>
    //             </td>
    //         </tr>
    //     </tbody>
    // </table>
    //     </body>
    //     </html>';
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$copymail->ErrorInfo}";
    // }

   
        $select = "SELECT * FROM voters_register where lions_id  = $lionsID";
        $sth = $con->query($select);
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $error = "Sorry, Member Already Exist ";
        } else {

            $insert = "INSERT INTO voters_register VALUES(NULL, $lionsID,'$fullname','$club','$phone','$email','','','', $status,NOW())";
            // echo $lionsID; exit;     
            $query = $con->query($insert);

            // if ($query) {
            //  session_start();  
            //  $_SESSION['user_request'] = $lionsID;
            //  $_SESSION['user_email'] = $email;
            // header("location: get-code.php?user_request=".$_SESSION['user_request']);
            // } else {
            //     echo "<script>
            // alert('Error Encountered, Please try again!')
            // history.back()
            // </script>";
            // }
           
        
        
    }

}