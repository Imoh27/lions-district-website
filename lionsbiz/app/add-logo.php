<?php
session_start();
error_reporting(0);
include('includes/alt_config.php');
global $con;
if (!$_SESSION['admin']) {
    header('location:index');
} else { 
    if (isset($_POST['submit'])) {
        $biz = $_POST['biz'];
        $imgfile = $_FILES["logo"]["name"];
        $imgsize = $_FILES["logo"]["size"];

            // get the image extension
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if($imgsize[$i] > 1000000){
                echo "<script>alert('OOP!. Maximum File Size of 1mb Exceeded')
                 history.back()
                </script>"; 
            }
           else if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed')
                 history.back()
                 </script>"; 
                
            } 
            else {
                //rename the image file
                $imgnewfile = 'bnf_'.$imgfile;
                $select = "SELECT * FROM tblbizlogo WHERE logoName = '$imgfile' AND bizID = $biz";
                $sth = $con->query($select);
                $result = $sth->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    $error = "Sorry, Logo already exists";
                }else{
                $insert = "INSERT into tblbizlogo values(NULL, $biz, '$imgnewfile', NOW())";
                // echo $insert; exit;
                $query = $con->query($insert);
                if ($query) {
                    // Code for move image into directory
                    move_uploaded_file($_FILES["logo"]["tmp_name"], "logos/" . $imgnewfile);
                    $msg = "Logo successfully added ";
                } else {
                    $error = "Something went wrong . Please try again.";
                }
            }
            }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <?php include('includes/pages-head.php'); ?>
    <title>District 404A2 - Business Networking Forum</title>
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
                                    <h4 class="page-title">Add Logo </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a >Admin</a>
                                        </li>
                                        <li class="active">
                                            Add Logo
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
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <!---Error Message--->
                                <?php if ($error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post" enctype="multipart/form-data">
                                            <div class="form-group m-b-20">
                                                <label for="biz">Select Business</label>
                                                <select class="form-control" name="biz" id="biz">
                                                    <!-- <option value="" selected>Select Business </option> -->
                                                    <?php
                                                    // Feching active categories
                                                    $ret = "SELECT * from  tblbusineses";
                                                    // echo $ret; exit;
                                                    $sth = $con->query($ret);
                                                    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($results  as $biz) {?>
                                                        <option value="<?php echo htmlentities($biz['bizID']); ?>"><?php echo htmlentities($biz['bizName']); ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Select Logo</b></h4>
                                                        <input type="file" class="form-control" id="logo" name="logo" required>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Upload Logo</button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                        </form>
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


        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>




    </body>

    </html>
<?php } ?>