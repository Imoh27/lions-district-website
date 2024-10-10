<?php

include("assets/main-header.php");
?>
<title>District Governors Team - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/topbar.php");
  include("assets/navbar.php");
  $sql = mysqli_query($con, "SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
  $lsyrow = mysqli_fetch_array($sql);
  $serviceYrID = $lsyrow['serviceYrID'];
  ?>

  <!--/ Navigation end -->
  </header>
  <!--/ Header end -->
  <section id="main-container" class="main-container pb-4">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-12">
          <h3 class="section-sub-title">District Governor's Team
        </div>
        <!--/ Title row end -->
        <?php
        // $firstsql = "SELECT * FROM tblinternationalleaders ORDER BY pdgID  LIMIT 2";
        $dgteamsql = "SELECT * FROM tbldgteam d JOIN tbloffices o ON o.officeID = d.officeID WHERE serviceYrID = $serviceYrID";
        $dgteam = mysqli_query($con, $dgteamsql);


        ?>
        <div class="row justify-content-center">
          <?php
          while ($row = mysqli_fetch_array($dgteam)) {
          ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
              <a href="details-district-governor-team?tid=<?php echo $row['dgteamID']; ?>">
                <div class="item">
                  <div class="ts-team-wrapper">
                    <div class="team-img-wrapper ">
                      <img loading="lazy" src="app/dgteam_Photos/<?php echo $row['dgteamPhoto']; ?>"
                        class="img-guard img-fluid" alt="team-img">
                    </div>
                    <div class="ts-team-content-classic">
                      <h3 class="ts-name d-inline mr-2"><?php echo $row['fullName'] ?></h3><b><?php echo $row['lci_awards']; ?></b>
                      <p class="ts-designation"><?php echo $row['position']; ?></p>
                      <!-- <p class="ts-designation"><?php echo $row['service_year']; ?></p> -->
                    </div>
                  </div>
                </div>
              </a>
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