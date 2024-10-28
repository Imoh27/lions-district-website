<?php
session_start();
include('includes/alt_config.php');
error_reporting(0);
if (empty($_SESSION['admin'])) {
    header('location:index.php');
} else {
    $catID = $_GET['cid'];
 
    $category = $_POST['category'];
    if (isset($_POST['submit'])) {
        
        $lastEntry = "SELECT * From tblcategory Where categoryName = '$category'";
        $sth = $con->query($lastEntry);
        $result = $sth->Fetch(PDO::FETCH_ASSOC);
        
        if (!empty($result) || $result) {
            $error = "Error . Entry already exists.";
            } else {
                $insert = "INSERT into tblcategory values(NULL, '$category',NULL, NOW())";
                // echo $insert; exit;
            $query = $con->query($insert);
            if ($query) {
                $msg = "Category created ";
            } else {
                $error = "Something went wrong . Please try again.";
            }
        }
    }
    
    if (isset($_POST['update'])) {
        $update = "UPDATE tblcategory SET categoryName = '$category', updated_on = NOW() WHERE categoryID  = $catID";
        // echo $update; exit;
        $query = $con->query($update);
        if ($query) {
            $msg = "Category updated ";
        } else {
            $error = "Something went wrong . Please try again.";
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
                                    <h4 class="page-title">Add Category</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Category </a>
                                        </li>
                                        <li class="active">
                                            Add Category
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Add Category </b></h4>
                                    <hr />



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
                                if ($catID) {
                                    
                                $selectCats = "SELECT * From tblcategory Where categoryID  = $catID";
                                // echo $selectCats; exit;
                                $sth = $con->query($selectCats);
                                $results = $sth->Fetch(PDO::FETCH_ASSOC);
                                }
                                ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="form-horizontal" name="category" method="post">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Category</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" value="<?php if (!empty($results)) { echo $results['categoryName']; } ?>" name="category"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">&nbsp;</label>
                                                <div class="col-md-10">

                                                    <button type="submit"
                                                        class="btn btn-custom waves-effect waves-light btn-md"
                                                        name="<?php if (!empty($results) || $catID) {echo 'update'; }else{?>  <?php echo 'submit'; } ?>">
                                                        <?php if (!empty($results) || $catID) {?> Update <?php } else{?>Submit<?php } ?>
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>