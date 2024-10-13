<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
include("assets/topheader.php");
?>
<title>Admin | Dashboard</title>
</head>
<?php 
  
$sql=mysqli_query($con,"SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow=mysqli_fetch_array($sql);
?>
<body class="nav-md">
  <?php include('include/header.php'); ?>
  <div class="tile_count">
    <div class="row">
      <div class="m-auto text-center">
      <img class="img-guard img-fluid m-auto mt-lg-5" src="sylogo/<?php echo $row['service_logo']; ?>" alt="">
      <h3><b>Lions District 404A2</b></h3>
      <h5><b>Admin Panel</b></h5>
      <p>Manage All resources and contents of the website</p>
      <ul>
        <li class="text-left">
          Lions Service Year
        </li>
        <li class="text-left">
          Offices and Officers at various level
        </li>
        <li class="text-left">
          Regions, Zones, Clubs, their Chairpersons and Presidents
        </li>
        <li class="text-left">
          Correspondence or messages from website visitors
        </li>
        <li class="text-left">
          More admins and Website wide changes
        </li>
      </ul>
      </div>
    </div>
    
  </div>


  <?php include('include/footer.php'); ?>
  <!-- jQuery -->
  <script src="vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="vendors/Flot/jquery.flot.js"></script>
  <script src="vendors/Flot/jquery.flot.pie.js"></script>
  <script src="vendors/Flot/jquery.flot.time.js"></script>
  <script src="vendors/Flot/jquery.flot.stack.js"></script>
  <script src="vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="vendors/moment/min/moment.min.js"></script>
  <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="assets/js/custom.min.js"></script>
</body>

</html>