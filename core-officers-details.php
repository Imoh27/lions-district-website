<?php
error_reporting(0);

include("assets/main-header.php");
$coreofficersID = $_GET['coid'];

?>
<title>Core District Officers - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/topbar.php");
  include("assets/navbar.php");
  $sql = mysqli_query($con, "SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
  $lsyrow = mysqli_fetch_array($sql);
  $serviceYrID = $lsyrow['serviceYrID'];
  ?>
</header>
<?php
        $dgteamsql = "SELECT * FROM  tblcoreofficers d JOIN tbloffices o ON o.officeID = d.officeID WHERE serviceYrID = $serviceYrID AND coreofficersID = $coreofficersID";
        $dgteamquery = mysqli_query($con, $dgteamsql);
        $row = mysqli_fetch_assoc($dgteamquery)
?>
<section id="main-container" class="main-container">
  <div class="container">

    <div class="row">
      <div class="col-lg-4">
        <div id="page-slider">
          <div class="item justify-content-center mt-lg-2">
            <img loading="lazy" class="img-guard img-fluid" src="app/coreofficers_Photos/<?php echo $row['coreofficersPhoto']; ?>" alt="team-image" />
          </div>

        </div><!-- Page slider end -->
      </div><!-- Slider col end -->

      <div class="col-lg-8 mt-5 mt-lg-3">

        <h2 class="d-inline column-title mrt-0 text-default"><?php echo $row['fullName']; ?> <h4 class="d-inline text-default"><?php echo $row['lci_awards']; ?></h4></h2>
        <h4 class="mt-2 mb-2"><?php echo $row['position']; ?></h4>
        <div class="new-overflow" style="height: 300px !important;">
          <p class="text-justify"><?php echo $row['coreofficersProfile']; ?></p>
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