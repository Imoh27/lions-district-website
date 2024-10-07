<?php
include("app/include/config.php");
include("assets/main-header.php");
?>
<title>Core District Officers - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
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
          <h3 class="section-sub-title">Core District Officers
        </div>
        <!--/ Title row end -->
        <?php
        // $firstsql = "SELECT * FROM tblinternationalleaders ORDER BY pdgID  LIMIT 2";
        $dgteamsql = "SELECT * FROM tblcoreofficers d JOIN tbloffices o ON o.officeID = d.officeID WHERE serviceYrID = $serviceYrID";
        $dgteam = mysqli_query($con, $dgteamsql);


        ?>
        <div class="row justify-content-center">
          <?php
          while ($row = mysqli_fetch_array($dgteam)) {
          ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
              <a href="core-officers-details?coid=<?php echo $row['coreofficersID']; ?>">
                <div class="item">
                  <div class="ts-team-wrapper">
                    <div class="team-img-wrapper ">
                      <img loading="lazy" src="app/coreofficers_Photos/<?php echo $row['coreofficersPhoto']; ?>"
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