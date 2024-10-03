<?php
include("app/include/config.php");
include("assets/main-header.php");
?>
<title>Past District Governors - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  ?>

  <!--/ Navigation end -->
  </header>
  <!--/ Header end -->
  <div id="banner-area" class="banner-area" style="background-image:url(images/banner/banner1.jpg)">
    <div class="banner-text">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="banner-heading">
              <h1 class="banner-title">Past District Governors</h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item"><a href="index">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Past District Governors</li>
                </ol>
              </nav>
            </div>
          </div><!-- Col end -->
        </div><!-- Row end -->
      </div><!-- Container end -->
    </div><!-- Banner text end -->
  </div><!-- Banner area end -->


  <section id="main-container" class="main-container pb-4">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-12">
          <h3 class="section-sub-title">Past District Governors
      </div>
      <!--/ Title row end -->
      <?php
      // $firstsql = "SELECT * FROM tblinternationalleaders ORDER BY pdgID  LIMIT 2";
      $pdgsql = "SELECT * FROM tblpdg";
      $pdg = mysqli_query($con, $pdgsql);


      ?>
      <div class="row justify-content-center">
        <?php
        while ($row = mysqli_fetch_array($pdg)) {
        ?>
       
          <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
          <div class="item">
              <div class="ts-team-wrapper">
                <div class="team-img-wrapper ">
                  <img loading="lazy" src="app/pdgs_photos/<?php echo $row['pdgPhoto']; ?>"
                    class="img-guard img-fluid" alt="team-img">
                </div>
                <div class="ts-team-content-classic">
                  <h3 class="ts-name"><?php echo $row['fullName'] . ' ' . $row['lci_awards']; ?></h3>
                  <p class="ts-designation"><?php echo $row['service_theme']; ?></p>
                  <p class="ts-designation"><?php echo $row['service_year']; ?></p>
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