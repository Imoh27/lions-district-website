<?php
include("app/include/config.php");
include("assets/main-header.php");
?>
<title>Club Presidents - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  ?>

  <!--/ Navigation end -->
  </header>
  <!--/ Header end -->

  <section id="main-container" class="main-container pb-4">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-12">
          <h3 class="section-sub-title">Club Presidents
      </div>
      <!--/ Title row end -->
      <?php
      // $firstsql = "SELECT * FROM tblinternationalleaders ORDER BY cpID  LIMIT 2";
      $cpsql = "SELECT * FROM tblclubpresidents p JOIN tblclubs c On c.clubID = p.clubID";
      $cp = mysqli_query($con, $cpsql);


      ?>
      <div class="row justify-content-center">
        <?php
        while ($row = mysqli_fetch_array($cp)) {
        ?>
       
          <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
          <div class="item">
              <div class="ts-team-wrapper">
                <div class="team-img-wrapper ">
                  <img loading="lazy" src="app/cp_photos/<?php echo $row['cpPhoto']; ?>"
                    class="img-guard img-fluid" alt="team-img">
                </div>
                <div class="ts-team-content-classic p-3 " style="background-color: #112e57 !important;">
                  <h3 class="ts-name text-white"><?php echo $row['fullName'] . ' ' . $row['lions_awards']; ?></h3>
                  <p class="ts-designation text-white text-center" ><?php echo $row['clubName']; ?> <br><?php echo $row['phoneNo']; ?></p>
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

    </div><!-- Content row 1 end -->

    </div><!-- Container end -->
  </section><!-- Main container end -->
  
  <?php

include("assets/footer.php");
?>
</body>

</html>