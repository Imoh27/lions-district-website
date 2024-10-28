<?php

include("assets/main-header.php");
?>
<title>Club Presidents - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/topbar.php");
  include("assets/navbar.php");
  ?>

  <!--/ Navigation end -->
  </header>
  <!--/ Header end -->

  <section id="main-container" class="main-container pb-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="section-sub-title">Region Chairpersons
        </div>
        <!--/ Title row end -->
        <?php
        // $firstsql = "SELECT * FROM tblinternationalleaders ORDER BY cpID  LIMIT 2";
        $rcsql = "SELECT * FROM tblregionchairperson rc JOIN tblregion r On r.regionID = rc.regionID";
        $rc = mysqli_query($con, $rcsql);


        ?>
        <div class="row">
          <?php
          while ($row = mysqli_fetch_array($rc)) {
          ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
              <div class="item">
                <div class="ts-team-wrapper">
                  <div class="team-img-wrapper ">
                    <img loading="lazy" src="app/rc_photos/<?php echo $row['rcPhoto']; ?>"
                      class="img-guard img-fluid" alt="<?php echo $row['fullName']; ?>">
                  </div>
                  <div class="ts-team-content-classic p-3  justify-contents-center text-center" style="background-color: #112e57 !important;">
                    <h3 class="ts-name text-white"><?php echo $row['fullName'] . ' ' . $row['lions_awards']; ?></h3>
                    <p class="ts-designation text-white text-center">Region <?php echo $row['region']; ?> <br><?php echo $row['phoneNo']; ?></p>
                    <!-- <p class="ts-designation"><?php echo $row['phoneNo']; ?></p> -->
                  </div>
                </div>
              </div>
              <!--/ Team wrapper 3 end -->
            </div><!-- Col end -->
          <?php } ?>
        </div>
        <!--/ Team wrapper 1 end -->
      </div><!-- Col end -->

      <div class="gap-40"></div>
      <div class="gap-40"></div>
      <div class="row">
        <div class="col-lg-12">
          <h3 class="section-sub-title">Zone Chairpersons
        </div>
        <!--/ Title row end -->
        <?php
        // $firstsql = "SELECT * FROM tblinternationalleaders ORDER BY cpID  LIMIT 2";
        $zcsql = "SELECT * FROM tblzonechairperson zc JOIN tblzone z On z.zoneID = zc.zoneID 
        INNER JOIN tblregion r on r.regionID = z.regionID";
        $zc = mysqli_query($con, $zcsql);


        ?>
        <div class="row">
          <?php
          while ($zcrow = mysqli_fetch_array($zc)) {
          ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
              <div class="item">
                <div class="ts-team-wrapper">
                  <div class="team-img-wrapper ">
                    <img loading="lazy" src="app/zc_photos/<?php echo $zcrow['zcPhoto']; ?>"
                      class="img-guard img-fluid" alt="team-img">
                  </div>
                  <div class="ts-team-content-classic p-3 justify-contents-center text-center" style="background-color: #112e57 !important;">
                    <h3 class="ts-name text-white"><?php echo $zcrow['fullName'] . ' ' . $zcrow['lions_awards']; ?></h3>
                    <p class="ts-designation text-white text-center">Zone <?php echo $zcrow['zoneName'].' (Region '.$zcrow['region'].')'; ?> <br><?php echo $zcrow['phoneNo']; ?></p>
                    <!-- <p class="ts-designation"><?php echo $zcrow['phoneNo']; ?></p> -->
                  </div>
                </div>
              </div>
              <!--/ Team wrapper 3 end -->
            </div><!-- Col end -->
          <?php } ?>
        </div>
        <!--/ Team wrapper 1 end -->
      </div><!-- Col end -->

    </div><!-- Content row 1 end -->

    </div><!-- Container end -->
  </section><!-- Main container end -->

  <?php

  include("assets/footer.php");
  ?>
</body>

</html>