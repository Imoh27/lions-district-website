<?php
error_reporting(0);
include("app/include/config.php");
include("assets/main-header.php");
$dgteamID = $_GET['tid'];

?>
<title>District Governor's Team - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  $sql = mysqli_query($con, "SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
  $lsyrow = mysqli_fetch_array($sql);
  $serviceYrID = $lsyrow['serviceYrID'];
  ?>
</header>
<?php
        $dgteamsql = "SELECT * FROM  tbldgteam d JOIN tbloffices o ON o.officeID = d.officeID WHERE serviceYrID = $serviceYrID AND dgteamID = $dgteamID";
        $dgteamquery = mysqli_query($con, $dgteamsql);
        $row = mysqli_fetch_assoc($dgteamquery)
?>
<section id="main-container" class="main-container">
  <div class="container">

    <div class="row">
      <div class="col-lg-4">
        <div id="page-slider">
          <div class="item justify-content-center mt-lg-2">
            <img loading="lazy" class="img-guard img-fluid" src="app/dgteam_Photos/<?php echo $row['dgteamPhoto']; ?>" alt="team-image" />
          </div>

        </div><!-- Page slider end -->
      </div><!-- Slider col end -->

      <div class="col-lg-8 mt-5 mt-lg-3">

        <h2 class="d-inline column-title mrt-0 text-default"><?php echo $row['fullName']; ?> <h4 class="d-inline text-default"><?php echo $row['lci_awards']; ?></h4></h2>
        <h4 class="mt-2 mb-2"><?php echo $row['position']; ?></h4>
        <div class="new-overflow" style="height: 300px !important;">
          <p class="text-justify"><?php echo $row['dgteamProfile']; ?></p>
        </div>
        
      </div><!-- Content col end -->

    </div><!-- Row end -->

  </div><!-- Conatiner end -->
</section><!-- Main container end -->
<?php

include("assets/footer.php");
?>
  </body>

  </html>