<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index');
} else {
    $session = $_SESSION['login'];
    $session_user = "SELECT *  From tblusers WHERE loginID = '$session'";
    $query = mysqli_query($con, $session_user);
    $result = mysqli_fetch_assoc($query);
    $session = $result['userID'];

    if ($_GET['oid']) {
        $oid = $_GET['oid'];
        if (isset($_POST['editPosition'])) {
            $position = $_POST['position'];
            $abbr = $_POST['abbr'];
            $update = "update tbldistrictoffices set position='$position', 
            abbr = '$abbr', dateUpdated = NOW(), updatedBy = $session where dOfficesID ='$oid'";
            // echo $update; exit;
            $query = mysqli_query($con, $update);
            if ($query) {
                $msg = "Position Updated ";
            } else {
                $delmsg = "Error Encountered!, Try again ";
            }
        }
    }

    if ($_GET['dptid']) {
        $dptid = $_GET['dptid'];
        if (isset($_POST['editDPteam'])) {
            $memberName = $_POST['leoName'];
            $position = $_POST['positions'];
            $fbProfile = $_POST['fbProfile'];
            $lnProfile = $_POST['lnProfile'];
            $igProfile = $_POST['igProfile'];
            $imgfile = $_FILES["memberDp"]["name"];

            if ($imgfile) {
                // get the image extension
                $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
                // allowed extensions
                $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
                // Validation for allowed extensions .in_array() function searches an array for a specific value.
                if (!in_array($extension, $allowed_extensions)) {
                    $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
                    // echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
                } else {
                    //rename the image file
                    $imgnewfile = md5($imgfile) . '.' . $extension;
                    // echo $imgnewfile; exit;
                    // Code for move image into directory
                    move_uploaded_file($_FILES["memberDp"]["tmp_name"], "dp_team/" . $imgnewfile);
                }
            }
            $update = "UPDATE tbldpsteam SET memberName = '$memberName', dOfficesID = $position, fbProfile = '$fbProfile', 
                lnProfile = '$lnProfile', igProfile = '$igProfile', dateUpdated = NOW(), updatedBy  = $session";
            if ($imgfile) {
                $update .= ", foto = '$imgnewfile' ";
            }
            $update .= " WHERE teamID  = $dptid";
            // echo $update; exit;
            $query = $con->query($update);
            if ($query) {
                $msg = "Successfully Updated";
            } else {
                $delmsg = "Error Encountered!, Try again";
            }
        }
    }

    // HANDLE LCI LEADERS
    if ($_GET['lid']) {
        $lid = $_GET['lid'];
        if (isset($_POST['editLCIleader'])) {
            $leaderName = $_POST['leaderName'];
            $position = $_POST['positions'];
            $imgfile = $_FILES["memberDp"]["name"];

            if ($imgfile) {
                // get the image extension
                $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
                // allowed extensions
                $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
                // Validation for allowed extensions .in_array() function searches an array for a specific value.
                if (!in_array($extension, $allowed_extensions)) {
                    $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
                    // echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
                } else {
                    //rename the image file
                    $imgnewfile = md5($imgfile) . '.' . $extension;
                    // echo $imgnewfile; exit;
                    // Code for move image into directory
                    move_uploaded_file($_FILES["memberDp"]["tmp_name"], "leaders_dp/" . $imgnewfile);
                }
            }
            $update = "UPDATE tbllcileaders SET leaderName = '$leaderName', dOfficesID = $position, dateUpdated = NOW(), updatedBy  = $session";
            if ($imgfile) {
                $update .= ", foto = '$imgnewfile' ";
            }
            $update .= " WHERE leaderID  = $lid";
            // echo $update; exit;
            $query = $con->query($update);
            if ($query) {
                $msg = "Successfully Updated";
            } else {
                $delmsg = "Error Encountered!, Try again";
            }
        }
    }

    // HANDLE UPDATE ACTIVITY
    if ($_GET['edit-activity']) {
        $aid = $_GET['edit-activity'];
        if (isset($_POST['updateActivity'])) {
            $category = $_POST['category'];
            $activity_title =  strtolower($_POST['activity_title']);
            $location =  strtolower($_POST['location']);
            $start_date =  $_POST['start_date'];
            $to_date =  $_POST['to_date'];
            $activity_details =   str_replace(array(
                '\'', '"',
                ';', '*'
            ), ' ', $_POST['activity_details']);
            $imgfile =  strtolower($_FILES['activity_image']['name']);
            // echo $activity_details; exit;

            if ($imgfile) {
                // get the image extension
                $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
                // allowed extensions
                $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
                // Validation for allowed extensions .in_array() function searches an array for a specific value.
                if (!in_array($extension, $allowed_extensions)) {
                    $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
                    // echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
                } else {
                    //rename the image file
                    $imgnewfile = md5($imgfile) . '.' . $extension;
                    // echo $imgnewfile; exit;
                    // Code for move image into directory
                    move_uploaded_file($_FILES["activity_image"]["tmp_name"], "activityimages/" . $imgnewfile);
                }
            }
            $update = "UPDATE tblactivity SET activityCatID = $category, title = '$activity_title', activityDesc = '$activity_details',  activityLocation = '$location', startDate = '$start_date', 
            endDate = '$to_date', dateUpdated = NOW()";
            if ($imgfile) {
                $update .= ", activityFoto = '$imgnewfile' ";
            }
            $update .= " WHERE activityID  = $aid";
            // echo $update; exit;
            $query = $con->query($update);
            if ($query) {
                $msg = "Successfully Updated";
            } else {
                $delmsg = "Error Encountered!, Try again";
            }
        }
    }



?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include('includes/pages-head.php'); ?>
     <!-- Summernote css -->
     <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

<!-- Select2 -->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<!-- Jquery filer css -->
<link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
<link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <title>Leo District 404A2 -- Official Website | District Offices</title>




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
                                    <h4 class="page-title">Edit Centre</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">District </a>
                                        </li>
                                        <li class="active">
                                            Edit Centre
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-6">

                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong>
                                        <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($delmsg) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong>
                                        <?php echo htmlentities($delmsg); ?>
                                    </div>
                                <?php } ?>


                            </div>

                            <div class="row">
                                <!-- Edit District Offices -->
                                <?php
                                if ($_GET['oid']) {
                                    $oid = $_GET['oid'];

                                    $officedetails = "SELECT *  From tbldistrictoffices WHERE  dOfficesID  = '$oid'";
                                    // echo $officedetails; exit;
                                    $query = mysqli_query($con, $officedetails);
                                    $result = mysqli_fetch_assoc($query);
                                ?>
                                    <div class=" col-md-12 m-t-50" id="editPosition">
                                        <div class="col-md-6 col-md-offset-2">
                                            <p class="text-uppercase font-600 font-secondary text-center"><a>Edit Position</a>

                                            </p>
                                            <form class="form-horizontal" name="position" method="post">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Enter Position <p class="text-danger d-inline"> *</p></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="<?php if ($result) {
                                                                                                            echo htmlentities($result['position']);
                                                                                                        } ?>" name="position" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Short Form </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" value="<?php if ($result) {
                                                                                                            echo htmlentities($result['abbr']);
                                                                                                        } ?>" name="abbr">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">

                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="editPosition">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- End District Officers Edit -->

                                <!-- Edit DP's Team -->
                                <?php
                                if ($_GET['dptid']) {
                                    $dptid = $_GET['dptid'];

                                    $dpteam = "SELECT *  From tbldpsteam d JOIN tbldistrictoffices o ON o.dOfficesID = d.dOfficesID WHERE  teamID   = '$dptid'";
                                    // echo $dpteam; exit;
                                    $query = mysqli_query($con, $dpteam);
                                    $dptresult = mysqli_fetch_assoc($query);
                                ?>
                                    <div class=" col-md-12 m-t-50" id="editTeam">
                                        <div class="col-md-6 col-md-offset-2">
                                            <p class="text-uppercase font-600 font-secondary text-center"><a>Edit Team</a>

                                            </p>
                                            <form class="form-horizontal" method="POST" name="dpteam" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Full Name </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($dptresult['memberName']); ?>" name="leoName">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    $select = "SELECT * FROM tbldistrictoffices";
                                                    $query = mysqli_query($con, $select);
                                                    ?>
                                                    <label class="col-md-4 control-label" for="position">Select Position</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="positions" id="position" required>
                                                            <?php
                                                            if ($dptresult) { ?>
                                                                <option value="<?php echo htmlentities($dptresult['dOfficesID']); ?>" selected><?php echo htmlentities($dptresult['position']); ?>
                                                                </option>

                                                            <?php } else { ?>
                                                                <option value="" selected>Select Position </option>
                                                            <?php }
                                                            // Feching active categories
                                                            while ($row = mysqli_fetch_array($query)) {
                                                            ?>
                                                                <option value="<?php echo htmlentities($row['dOfficesID']); ?>">
                                                                    <?php echo htmlentities($row['position']); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Facebook </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($dptresult['fbProfile']); ?>" name="fbProfile">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">LinkedIn </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($dptresult['lnProfile']); ?>" name="lnProfile">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Instagram </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($dptresult['igProfile']); ?>" name="igProfile">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Feature Image </label>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" id="memberDp" name="memberDp">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">&nbsp;</label>
                                                    <div class="col-md-8 text-center">

                                                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-md" name="editDPteam">
                                                            Submit
                                                        </button>
                                                        &nbsp;
                                                        <button class="btn btn-custom waves-effect waves-light"><a href="dp-team"> <i class="fa fa-arrow-left text-white"></i> Return</a></button>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- END  Edit DP's Team -->

                                <!-- Start Edit LCI Leaders -->
                                <?php
                                if ($_GET['lid']) {
                                    $lid = $_GET['lid'];

                                    $LCIleader = "SELECT *  From tbllcileaders l JOIN tbldistrictoffices o ON o.dOfficesID = l.dOfficesID WHERE  leaderID   = '$lid'";
                                    // echo $LCIleader; exit;
                                    $query = mysqli_query($con, $LCIleader);
                                    $dptresult = mysqli_fetch_assoc($query);
                                ?>
                                    <div class=" col-md-12 m-t-50" id="editTeam">
                                        <div class="col-md-6 col-md-offset-2">
                                            <p class="text-uppercase font-600 font-secondary text-center"><a>Edit Lions Leader</a>

                                            </p>
                                            <form class="form-horizontal" method="POST" name="LCIleader" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Full Name </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($dptresult['leaderName']); ?>" name="leaderName">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    $select = "SELECT * FROM tbldistrictoffices";
                                                    $query = mysqli_query($con, $select);
                                                    ?>
                                                    <label class="col-md-4 control-label" for="position">Select Position</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="positions" id="position" required>
                                                            <?php
                                                            if ($dptresult) { ?>
                                                                <option value="<?php echo htmlentities($dptresult['dOfficesID']); ?>" selected><?php echo htmlentities($dptresult['position']); ?>
                                                                </option>

                                                            <?php } else { ?>
                                                                <option value="" selected>Select Position </option>
                                                            <?php }
                                                            // Feching active categories
                                                            while ($row = mysqli_fetch_array($query)) {
                                                            ?>
                                                                <option value="<?php echo htmlentities($row['dOfficesID']); ?>">
                                                                    <?php echo htmlentities($row['position']); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Feature Image </label>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" id="memberDp" name="memberDp">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">&nbsp;</label>
                                                    <div class="col-md-8 text-center">

                                                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-md" name="editLCIleader">
                                                            Submit
                                                        </button>
                                                        &nbsp;
                                                        <button class="btn btn-custom waves-effect waves-light"><a href="lci-leaders"> <i class="fa fa-arrow-left text-white"></i> Return</a></button>

                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- End Edit LCI Leaders -->


                                <!-- Start Edit Activity -->
                                <?php
                                if ($_GET['edit-activity']) {
                                    $aid = $_GET['edit-activity'];
                                                   

                                    $activity = "SELECT *  From tblactivity a JOIN tblcategory c ON a.activityCatID  = c.postCatID WHERE activityID = $aid";
                                    // echo $activity; exit;
                                    $query = mysqli_query($con, $activity);
                                    $activityresult = mysqli_fetch_assoc($query);
                                ?>
                                    <div class=" col-md-12 m-t-50" id="update-activity">
                                        <div class="col-md-6 col-md-offset-2">
                                            <p class="text-uppercase font-600 font-secondary text-center"><a>Update Activity</a>

                                            </p>
                                            <form class="form-horizontal" method="POST" name="update-activity" enctype="multipart/form-data">

                                            <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Activity Type</label>
                                            
                                            <select class="form-control" name="category" id="category">
                                                <?php
                                                            if ($activityresult) { $aCatID = $activityresult['activityCatID']; ?>
                                                                <option value="<?php echo htmlentities($aCatID); ?>" selected><?php echo htmlentities($activityresult['postCategory']); ?>
                                                                </option>

                                                            <?php } else { ?>

                                                <option value="">Select Category </option>
                                                <?php }
                                                // Feching active categories
                                                $ret = "SELECT postCatID, postCategory from  tblcategory where isActive=1 AND postCatID NOT IN($aCatID)";
                                                $sth = mysqli_query($con, $ret);
                                                while ($result = mysqli_fetch_array($sth)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($result['postCatID']); ?>"><?php echo htmlentities($result['postCategory']); ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group m-b-20">
                                            <label for="activity_title">Activity Title</label>
                                            <input type="text" class="form-control" id="activity_title" name="activity_title" <?php  if ($activityresult){?> value="<?php echo htmlentities(strtoupper($activityresult['title'])); }?>" required maxlength="80">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Location</label>
                                            <input type="text" class="form-control" id="location" name="location" <?php  if ($activityresult){?> value="<?php echo htmlentities(strtoupper($activityresult['activityLocation'])); }?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="start_date">From</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" <?php  if ($activityresult){?> value="<?php echo htmlentities($activityresult['startDate']); }?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group m-b-20">
                                            <label for="to_date">To</label>
                                            <input type="date" class="form-control" id="to_date" name="to_date" <?php  if ($activityresult){?> value="<?php echo htmlentities($activityresult['endDate']); }?>">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title"><b>Activity Details</b></h4>
                                                <textarea class="summernote" name="activity_details" required><?php  if ($activityresult){?> <?php echo htmlentities(substr(strip_tags($activityresult['activityDesc']),0)); }?></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                                <input type="file" class="form-control" id="activity_image" name="activity_image">
                                            </div>
                                        </div>
                                    </div>


                                               
                                    
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">&nbsp;</label>
                                                    <div class="col-md-8 text-center">

                                                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-md" name="updateActivity">
                                                            Submit
                                                        </button>
                                                        &nbsp;
                                                        <button class="btn btn-custom waves-effect waves-light"><a href="manage-activity"> <i class="fa fa-arrow-left text-white"></i> Return</a></button>

                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- End Edit Activity -->

    <script>
                    var resizefunc = [];
                </script>

                            </div>
                            <!--- end row -->






                        </div> <!-- container -->

                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>

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

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>
            <script>
                document.getElementById("addToTable").onclick = function() {
                    addPositionForm()
                };

                function addPositionForm() {
                    document.getElementById('addPosition').style.display = "block"
                }

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

                function getMembers(val) {
                    $.ajax({
                        type: "POST",
                        url: "get_members.php",
                        data: 'clubID=' + val,
                        beforeSend: function() {
                            $("#members").html('Fetching, Please Wait...');
                        },
                        success: function(data) {
                            $("#members").html(data);
                        }
                    });
                }
            </script>

<!--Summernote js-->
<script src="../plugins/summernote/summernote.min.js"></script>
                <!-- Select 2 -->
                <script src="../plugins/select2/js/select2.min.js"></script>
                <!-- Jquery filer js -->
                <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

                <!-- page specific js -->
                <script src="assets/pages/jquery.blog-add.init.js"></script>

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
    </body>

    </html>
<?php } ?>