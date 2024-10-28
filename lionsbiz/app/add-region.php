<?php
session_start();
include_once('includes/alt_config.php');
error_reporting(0);
if ($_SESSION['admin'] == "") {
    header('location:index');
} else {
    global $con;
    $regionID = intval($_GET['rid']);
    if (isset($_POST['add_region'])) {
        $region = $_POST['region'];
        
        // echo $regionID; exit;
        if (empty($regionID)) {
        $select_region = "SELECT *  From tblregion WHERE region = '$region'";
        // echo $added_by;     exit;
        $sth = $con->query($select_region);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $error = "Duplicate Data Entry, Already Exist! ";
        } else {
            $insert = "INSERT INTO tblregion VALUES(NULL, '$region', NOW())";
            // echo $insert; exit;
            $query = $con->query($insert);
            if ($query == TRUE) {
                    $msg = "Region Successfully Added ";
                
            } else {
                $error = "Something went wrong . Please try again.";
            }
        }
    }else {
        $update = "UPDATE tblregion set region  = $region WHERE regionID = $regionID";
            //  echo $update; exit;
            $query = $con->query($update);
            if ($query) {
                $msg = "Region successfully Updated ";
            } else {
                $error = "Something went wrong . Please try again.";
            }
    }
    }


    ?>


    <?php include('includes/pages-head.php'); ?>
    <title>District 404A2 - Business Networking Forum</title>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Region</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Region </a>
                                        </li>
                                        <li class="active">
                                            Add Region
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="card-box">

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
                            <?php 
                             $select_region = "SELECT *  From tblregion WHERE regionID = '$regionID'";
                            //  echo $select_region;     exit;
                             $sth = $con->query($select_region);
                             $result = $sth->fetch(PDO::FETCH_OBJ);
                            ?>
                        <div class="row">
                            <div class="col-md-6">
                                <form class="form-horizontal" name="ad_region" method="post">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Region</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?php if (!empty($result)) echo htmlentities($result->region) ;?>" name="region" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                        <button type="submit" name="add_region"
                                        class=" text-center btn btn-success waves-effect waves-light"></i>&nbsp;<?php if (!empty($result)) {echo "Update ";}else{?> Add  <?php }?>
                                    </button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>


                        </div>


                        <!-- <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <form class="form-horizontal" name="add-bods" method="post">

                                    <div class="form-group">
                                                <label class="col-md-3 control-label">Enter Service Year</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="" name="lsy"
                                                        placeholder="example 2022/2023" required>
                                                </div>
                                            </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">&nbsp;</label>
                                            <div class="col-md-10">

                                                <button type="submit" name="add_bod" class="btn btn-success waves-effect waves-light"><i class="fa fa-plus " style="color: #fff;" title="Edit this Member details"></i>&nbsp; Add Board Member</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div> -->
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>
        </div>

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
        <script src="assets/js/modernizr.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function () {

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
        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>


    </body>

    </html>
<?php } ?>