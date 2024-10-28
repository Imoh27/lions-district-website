<?php
error_reporting(0);
include "../app/includes/alt_config.php";


if (isset($_POST['message'])) {
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $subject = strip_tags($_POST['subject']);
    $message = strip_tags($_POST['message']);

       $select = "SELECT * FROM tblcontact where contact_name = '$name' AND contact_email = '$email' AND msg_subject = '$subject'";
     
        $sth = $con->query($select);
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
         if ($results || !empty($results)) {
                echo "<script> 
                    alert('Sorry, message with same headers already sent. Thanks for contacting us')
                    history.back()
                </script>";
             } else{
                $insert = "INSERT INTO tblcontact VALUES(NULL, '$name', '$email', '$subject', ' $message', NOW())";
         
                $query = $con->query($insert);
                if ($query) {
                    echo "<script> 
                        alert('Message Sent. Thanks for contacting us')
                        history.back()
                    </script>";
                }
                
             }

     }

    ?>