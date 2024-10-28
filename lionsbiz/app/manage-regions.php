<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (empty($_SESSION['admin'])) {
    header('location:index');
} else {
    if ($_GET['action'] == 'del') {
        $id = $_GET['rid'];
        $delete = "DELETE FROM tblregion where regionID='$id'";
        $query = $con->query($delete);
        $msg = "Region deleted ";
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
                                <h4 class="page-title">Manage Region</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Admin</a>
                                    </li>
                                    <li>
                                        <a href="#">Regions </a>
                                    </li>
                                    <li class="active">
                                        Manage Region
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
                            <div class="col-md-12">
                                <div class="demo-box m-t-20">

                                    <div class="col-md-6 col-sm-12" style="margin-bottom: 50px">
                                        <p class=" text-uppercase font-600 font-secondary text-overflow"><a>All
                                                Regions</a>
                                            <a href="add-region" style="float: right" title="Add Region">
                                                <button id="addToTable"
                                                    class=" btn btn-success waves-effect waves-light">Add
                                                    <i class="mdi mdi-plus-circle-outline"></i></button>
                                            </a>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary"
                                                id="table_filter">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Region Name</th>
                                                        <th style="text-align:center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $select_query = "SELECT * from  tblregion";
                                                        // echo $select_query; exit;
                                                        $sth = $con->query($select_query);
                                                        $result = $sth->FetchAll(PDO::FETCH_ASSOC);
                                                        
                                                        $cnt = 1;

                                                        if (empty($result)) { ?>
                                                    <tr>

                                                        <td colspan="7" align="center">
                                                            <h3 style="color:red">No entry yet</h3>
                                                        </td>
                                                    <tr>
                                                        <?php } else {
                                                         foreach ($result as $regions ) {
                                                           
                                                                ?>

                                                    <tr>
                                                        <th scope="row">
                                                            <?php echo htmlentities($cnt); ?>
                                                        </th>
                                                        <td>
                                                            Region <?php echo htmlentities($regions['region']); ?>
                                                        </td>
                                                        <td style="text-align:center">
                                                            <a
                                                                href="add-region?rid=<?php echo htmlentities($regions['regionID']); ?>"><i
                                                                    class="fa fa-pencil"
                                                                    style="color: #29b6f6;"></i>&nbsp; </a>
                                                            &nbsp;<a
                                                                href="manage-regions.php?rid=<?php echo htmlentities($regions['regionID']); ?>&&action=del"
                                                                onclick="return confirm('Do you really want to delete ?')">
                                                                <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                                $cnt++;
                                                            }
                                                        } ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>


                                </div>

                            </div>


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

</body>

</html>
<?php } ?>