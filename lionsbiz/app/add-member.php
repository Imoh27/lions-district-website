<?php
session_start();
include('includes/alt_config.php');
error_reporting(0);
if ($_SESSION['login'] == "" || strlen($_SESSION['login']) == 0) {
    header('location:index');
} else {

    if (isset($_POST['add_member'])) {
        global $con;

        $region = $_POST['region'];
        $clubs = $_POST['clubs'];
        $memberNo = $_POST['memberNo'];
        $firstname = strtolower($_POST['firstname']);
        $middlename = strtolower($_POST['middlename']);
        $lastname = strtolower($_POST['lastname']);
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
                '$email', '$gender', '$phone', '$altPhone', '$residence', '$maritalStatus',  '$occupation', '$city', '$stateResidence', '$stateOrigin', '$lga', ' $memberSince', '$dob',
                      '$imgnewfile', NOW(), '$added_by', $isActive)";
                // echo $insert; exit;
                $query = $con->query($insert);

                //  echo $query; exit;
                if ($query) {
                    $msg = "Member successfully added ";
                } else {
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
        $firstname = strtolower($_POST['firstname']);
        $middlename = strtolower($_POST['middlename']);
        $lastname = strtolower($_POST['lastname']);
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
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="icon" type="image/x-icon" href="images/dplogo23-24.jpg">
    <!-- App title -->
    <title>Leo District 404A2 -- Official Website | Add Leo</title>

    <!-- Summernote css -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery filer css -->
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>
    <script>
    function getClubs(val) {
        $.ajax({
            type: "POST",
            url: "get_clubs.php",
            data: 'regionID=' + val,
            beforeSend: function() {
                $("#clubs").html('Fetching, Please Wait...');
            },
            success: function(data) {
                $("#clubs").html(data);
            }
        });
    }

    function getLga(val) {
        $.ajax({
            type: "POST",
            url: "get_lga.php",
            data: 'stateID=' + val,
            beforeSend: function() {
                $("#lga").html('Fetching, Please Wait...');
            },
            success: function(data) {
                $("#lga").html(data);
            }
        });
    }
    </script>
</head>

<?php
    $leoID = intval($_GET['lid']);
    // echo $leoID; exit;
    global $con;

    $select = "SELECT * from  tblmembers m JOIN tblclubs c ON c.clubID = m.clubID
    INNER JOIN tblregion r ON r.regionID = c.regionID JOIN tbllga l ON l.lgaID = m.lgaOfOrigin 
    INNER JOIN  tblstates s ON s.stateID  = l.stateID where m.memberID = $leoID";
    $sth = $con->query($select);
    $fetchresult = $sth->fetch(PDO::FETCH_ASSOC);
 

    ?>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <?php include('includes/topheader.php'); ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include('includes/leftsidebar.php'); ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Member </h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Member</a>
                                    </li>
                                    <li>
                                        <a href="#">Add Member </a>
                                    </li>
                                    <li class="active">
                                        Add Member
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <!---Success Message--->
                            <?php if ($msg) { ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong>
                                <?php echo htmlentities($msg); ?>
                            </div>
                            <?php } ?>

                            <!---Error Message--->
                            <?php if ($error) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong>
                                <?php echo htmlentities($error); ?>
                            </div>
                            <?php } ?>


                        </div>
                    </div>


                    <div class="row">
                        <form action="" method="POST" name="add_member" enctype="multipart/form-data">
                            <div class="col-md-12 col-sm-12 col-md-offset-1 ">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-4">
                                        <div class="form-group m-b-20">
                                            <?php
                                            $select = "SELECT * FROM tblregion";
                                            //  echo $select; exit;
                                            $sth = $con->query($select);
                                            $results = $sth->FetchAll(PDO::FETCH_ASSOC);
                                            // echo  $id = $results['id']; exit;
                                            ?>
                                            <label for="member_type">Select Region</label>
                                            <select class="form-control" name="region" id="region"
                                                onChange="getClubs(this.value);" required>
                                                <?php
                                                if (!empty($fetchresult) || $leoID) {?>

                                                <option value="<?php echo htmlentities($fetchresult['regionID'])?>"
                                                    selected>Region <?php echo htmlentities($fetchresult['region'])?> </option>

                                                <?php } else{?>
                                                <option value="" selected>Select Region </option>
                                                <?php
                                                }

                                                foreach ($results as $regions) {
                                                    ?>
                                                <option value="<?php echo htmlentities($regions['regionID']); ?>">
                                                   Region <?php echo htmlentities($regions['region']); ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group m-b-20">

                                            <label for="club">Select Clubs</label>

                                            <?php
                                             if (!empty($fetchresult) || $leoID) {?>
                                            <select class="form-control" name="clubs" id="clubs" required>

                                                <option value="<?php echo htmlentities($fetchresult['clubID'])?>"
                                                    selected><?php echo htmlentities($fetchresult['clubName'])?>
                                                </option>
                                            </select>

                                            <?php } else{?>
                                            <select class="form-control" name="clubs" id="clubs" required>

                                            </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="form-group m-b-20">

                                            <label for="club">Membership No:</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo htmlentities($fetchresult['membershipNo'])?>"
                                                name="memberNo"
                                                placeholder="<?php  if (empty($fetchresult) || !$leoID) {?>Can't be Modified<?php } ?>"
                                                <?php  if (!empty($fetchresult) || $leoID) {?> readonly <?php } ?>
                                                required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-sm-12  col-md-offset-1">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Firstname: <B>*</B></h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['firstName'])?>" name="firstname"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Middlename: </h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['middleName'])?>" name="middlename">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Lastname: </h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['lastName'])?>" name="lastname"
                                        required>
                                </div>
                            </div>



                            <div class="col-md-4 col-sm-6  col-md-offset-1">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Email: <B>*</B> </h4>
                                    <input type="email" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['memberEmail'])?>" name="email"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-4">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Phone No: <B>* </B></h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['phone1'])?>" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Alt Phone:</h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['phone2'])?>" name="altPhone">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-md-offset-1">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Residence Address: <B>*</B></h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['address'])?>" name="residence"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-4 ">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title">Member Since: <b>*</b></h4>

                                    <select name="memberSince" class="form-control">
                                        <?PHP

                                            for ($counter = 0; $counter <= 50; $counter++) {
                                                $year = (1980 + $counter);
                                                echo '<option value="' . $year . '"';
                                                echo ($year == date("Y", time())) ? " selected" : "";

                                                echo '>' . $year . '</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3  col-sm-4">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>Gender: </b></h4>
                                    <select name="gender" id="" class="form-control">
                                        <?php
                                             if (!empty($fetchresult) || $leoID) {?>
                                        <option value="<?php echo htmlentities($fetchresult['gender'])?> "selected>
                                            <?php echo htmlentities($fetchresult['gender'])?></option>
                                        <?php } else {?>
                                        <option value="Select Gender">Select Gender</option><?php }?>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <!-- <option value="Other">Other</option> -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-md-offset-1">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>State of Origin: *</b></h4>
                                    <?php
                                        $select = "SELECT * FROM tblstates";
                                        //  echo $select; exit;
                                        $sth = $con->query($select);
                                        $results = $sth->FetchAll(PDO::FETCH_ASSOC);
                                        // echo  $id = $results['id']; exit;
                                        ?>
                                    <select class="form-control" name="stateOrigin" id="stateOrigin"
                                        onChange="getLga(this.value);" required>
                                        <?php 
                                             if (!empty($fetchresult) || $leoID) {?>
                                        <option
                                            value="<?php echo htmlentities($fetchresult['stateOfOrigin'])?> "selected>
                                            <?php echo htmlentities($fetchresult['stateName'])?></option>
                                        <?php } else {?>
                                        <option value="" selected>Select State </option>
                                        <?php }
                                            // Feching active categories
                                        

                                            foreach ($results as $states) {
                                                ?>
                                        <option value="<?php echo htmlentities($states['stateID']); ?>">
                                            <?php echo htmlentities($states['stateName']); ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 ">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>Lga: *</b></h4>
                                    <?php 
                                             if (!empty($fetchresult) || $leoID) {?>
                                    <select class="form-control" name="lga" id="lga" required>
                                        <option value="<?php echo htmlentities($fetchresult['lgaOfOrigin'])?>" selected>
                                            <?php echo htmlentities($fetchresult['lgaName'])?></option>
                                    </select>
                                    <?php } else {?>
                                    <select class="form-control" name="lga" id="lga" required>

                                    </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>State of Residence: *</b></h4>
                                    <?php
                                        $select = "SELECT * FROM tblstates";
                                        //  echo $select; exit;
                                        $sth = $con->query($select);
                                        $results = $sth->FetchAll(PDO::FETCH_ASSOC);
                                        // echo  $id = $results['id']; exit;
                                        ?>
                                    <select class="form-control" name="stateResidence" id="stateResidence" required>
                                        <?php 
                                             if (!empty($fetchresult) || $leoID) {?>
                                        <option value="<?php echo htmlentities($fetchresult['stateOfOrigin'])?> "
                                            selected><?php echo htmlentities($fetchresult['stateName'])?></option>
                                        <?php } else {?>
                                        <option value="" selected>Select State </option>
                                        <?php }
                                            foreach ($results as $states) {
                                                ?>
                                        <option value="<?php echo htmlentities($states['stateID']); ?>">
                                            <?php echo htmlentities($states['stateName']); ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-md-offset-1 ">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>City * </b></h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['city'])?>" name="city" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 ">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>Date of Birth * </b></h4>
                                    <input type="date" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['dob'])?>" name="dob"
                                        <?php  if (!empty($fetchresult) || $leoID) {?> readonly <?php } ?>>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-4 ">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>Occupation * </b></h4>
                                    <input type="text" class="form-control"
                                        value="<?php echo htmlentities($fetchresult['occupation'])?>" name="occupation"
                                        required>
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6 col-md-offset-1">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>Marital Status: </b></h4>
                                    <select name="maritalStatus" id="" class="form-control">
                                        <?php
                                             if (!empty($fetchresult) || $leoID) {?>
                                        <option value="<?php echo htmlentities($fetchresult['maritalStatus'])?> "
                                            selected><?php echo htmlentities($fetchresult['maritalStatus'])?></option>
                                        <?php } else {?>
                                        <option value="" selected>Select Status </option>
                                        <?php } ?>

                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-md-offset-1">
                                <div class="card-box">
                                    <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                    <input type="file" class="form-control" id="memberDp" name="memberDp" <?php  if (empty($fetchresult) || !$leoID) {?> required <?php } ?>>
                                </div>
                            </div>

                            <div class="col-sm-10 col-md-offset-1">
                                <button type="submit"
                                    name="<?php
                                             if (!empty($fetchresult) || $leoID) { echo 'editMember'; }else{?>add_member<?php } ?>"
                                    class="btn btn-success waves-effect waves-light"><?php
                                             if (!empty($fetchresult) || $leoID) { echo 'Edit'; }else{?> Add
                                    <?php } ?></button>
                                <a type="button" class="btn btn-danger waves-effect waves-light"
                                    href="manage-members">Return</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end p-20 -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->



    </div> <!-- container -->

    </div> <!-- content -->

    <?php include('includes/footer.php'); ?>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->



    <script>
    var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>
    <!-- Select 2 -->
    <script src="../plugins/select2/js/select2.min.js"></script>
    <!-- Jquery filer js -->
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

    <!-- page specific js -->
    <script src="assets/pages/jquery.blog-add.init.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({
            height: 240, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    });
    </script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>




</body>

</html>
<?php } ?>