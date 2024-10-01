<?php
include("app/include/config.php");
include("assets/main-header.php");
?>
<title>Our International Leaders - Lions District 404A2</title>

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
              <h1 class="banner-title">Our International Leaders</h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item"><a href="index">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Our International Leaders</li>
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
          <h3 class="section-sub-title">Our International Leaders</h3>
        </div>
      </div>
      <!--/ Title row end -->
      <?php
      // $firstsql = "SELECT * FROM tblinternationalleaders ORDER BY leadersID LIMIT 2";
      $firstsql = "SELECT * FROM tblinternationalleaders ";
      $query = mysqli_query($con, $firstsql);


      ?>
      <div class="row justify-content-center">
        <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <div class="col-lg-3 col-sm-6 mb-5">
            <div class="item">
              <div class="ts-team-wrapper">
                <a href="leaders-details?check=<?php echo $row['leadersID']?>&detail = <?php echo $row['fullName']; ?>">
                  <div class="team-img-wrapper">
                    <img loading="lazy" src="app/LCI_leaders_Photos/<?php echo $row['leaderPhoto']; ?>" width="400" height="450" style="width: 400px; height: 450px;" alt="team-img" class="img-fluid">
                  </div>
               
                  <div class="ts-team-content">
                    <p class="ts-designation"><?php echo $row['position']; ?></p>
                    <h3 class="ts-name"><?php echo $row['fullName'] . ' ' . $row['lci_awards']; ?></h3>
                    <!-- <p class="ts-description">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p> -->
                    <!-- <div class="team-social-icons">
                            <a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="#"><i class="fab fa-google-plus"></i></a>
                            <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                        </div> -->
                    <!--/ social-icons-->
                  </div>
              </a>
              </div><!--/ Team wrapper end -->
            </div><!-- Team 1 end -->

          </div>
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