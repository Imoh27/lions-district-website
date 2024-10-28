<?php
include('alt_config.php');
error_reporting(0);
$page = $_GET('page');
// echo $page; exit;
    if (isset($_POST['add_member'])) {
        global $con;

        $region = $_POST['region'];
        $clubs = $_POST['clubs'];
        $memberNo = $_POST['memberNo'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $altPhone = $_POST['altPhone'];
        $residence = $_POST['residence'];
        $memberSince = $_POST['memberSince'];
        $gender = $_POST['gender'];
        $stateOrigin = $_POST['stateOrigin'];
        $lga = $_POST['lga'];
        $stateResidence = $_POST['stateResidence'];
        $city = $_POST['city'];
        $dob = $_POST['dob'];
        $occupation = $_POST['occupation'];
        $maritalStatus = $_POST['maritalStatus'];
        $imgfile = strtolower($_FILES["memberDp"]["name"]);
        $added_by = empty($_SESSION['login']) ? 'NULL': $_SESSION['login'];
        $isActive = 1;
        
        $session_user = "SELECT *  From tblusers WHERE loginID = '$added_by'";
        $sth = $con->query($session_user);
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $added_by = empty($result) || !$result ? 'NULL': $result->userID;
        echo $page; exit;

        // get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        $curr_date = date('Y-m-d');
        $calc_date = date('Y', strtotime($curr_date)) - date('Y', strtotime($dob));
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
            // echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            //rename the image file
            $imgnewfile = md5($imgfile) . $extension;
            // Code for move image into directory
            // move_uploaded_file($_FILES["member_dp"]["tmp_name"],"membersimages/".$imgnewfile);

            $select = "SELECT * FROM tblmembers where membershipNo  = $memberNo";
            // echo $select; exit;
            $sth = $con->query($select);
            $results = $sth->fetchAll(PDO::FETCH_ASSOC);
            // echo  $calc_date; exit;
            if (!empty($results)) {
                $error = "Sorry, Member Already Exist ";
            }
            else {
                move_uploaded_file($_FILES["memberDp"]["tmp_name"], "membersimages/" . $imgnewfile);
                $insert = "INSERT INTO tblmembers VALUES(NULL, $clubs, $region,  '$memberNo','$firstname', '$lastname', '$middlename',
                '$email', '$gender', '$phone', '$altPhone', '$residence', '$maritalStatus', '$occupation', '$city', $stateResidence, $stateOrigin, $lga, ' $memberSince', '$dob',
                      '$imgnewfile', NOW(), $added_by, $isActive)";
                // echo $insert; exit;
                $query = $con->query($insert);

                //  echo $query; exit;
                if ($query) {
                    header('location: /');
                    $msg = "Member successfully added ";
                } else {
                    header('location: /');
                    $error = "Something went wrong . Please try again.";
                }
            }
        }
    }


    
    // END ADD MEMBERS 

    // START EDIT MEMBERS
    if ($_GET['lid']) {
        $lid = $_GET['lid'];
    if (isset($_POST['editMember'])) {
        global $con;
        
        $region = $_POST['region'];
        $clubs = $_POST['clubs'];
        $memberNo = $_POST['memberNo'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $altPhone = $_POST['altPhone'];
        $residence = $_POST['residence'];
        $memberSince = $_POST['memberSince'];
        $gender = $_POST['gender'];
        $stateOrigin = $_POST['stateOrigin'];
        $lga = $_POST['lga'];
        $stateResidence = $_POST['stateResidence'];
        $city = $_POST['city'];
        $dob = $_POST['dob'];
        $occupation = $_POST['occupation'];
        $maritalStatus = $_POST['maritalStatus'];
        $imgfile = strtolower($_FILES["memberDp"]["name"]);
        $added_by = $_SESSION['login'];
        $isActive = 1;

        $session_user = "SELECT *  From tblusers WHERE loginID = '$added_by'";
        $sth = $con->query($session_user);
        $result = $sth->fetch(PDO::FETCH_OBJ);
        $added_by = $result->userID;

        if ($imgfile) {
        // get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        $curr_date = date('Y-m-d');
        $calc_date = date('Y', strtotime($curr_date)) - date('Y', strtotime($dob));
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
            // echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            //rename the image file
            $imgnewfile = md5($imgfile) . $extension;
            // Code for move image into directory
            // move_uploaded_file($_FILES["member_dp"]["tmp_name"],"membersimages/".$imgnewfile);
        }} 
                move_uploaded_file($_FILES["memberDp"]["tmp_name"], "membersimages/" . $imgnewfile);
                $update = "UPDATE tblmembers SET clubID = $clubs, regionID = $region, firstName = '$firstname', lastName = '$lastname', middleName = '$middlename',
                memberEmail = '$email', gender = '$gender', phone1 = '$phone', phone2 = '$altPhone', address = '$residence', maritalStatus =  '$maritalStatus', occupation =  '$occupation',
                 city = '$city', state  = '$stateResidence', stateOfOrigin  = '$stateOrigin', lgaOfOrigin  =  '$lga', memberSince = ' $memberSince',
                dateUpdated = NOW(), updatedBy  = '$added_by'";
                 if ($imgfile) {
                    $update .= ", memberPhoto = '$imgnewfile' ";
                }
                $update .= " WHERE memberID  = $lid";
                // echo $update; exit;
                $query = $con->query($update);

                //  echo $query; exit;
                if ($query) {
                    $msg = "Member successfully added ";
                } else {
                    $error = "Something went wrong . Please try again.";
                }
            }
        }
    