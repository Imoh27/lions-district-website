<?php
// include("app/include/config.php");
include("assets/main-header.php");
$areaID = $_GET["aid"];
?>
<title>District COre Project - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  $project_select = "SELECT * FROM  tblcoreprojects c JOIN tblcorereas a ON c.areaID = a.areaID WHERE c.areaID = $areaID ";
  // echo $project_select; exit;
  $project_query = mysqli_query($con, $project_select);
  $newrow = mysqli_fetch_array($project_query);
  ?>

  <!--/ Navigation end -->
  </header>
  <!--/ Header end -->

  <?php

  if (!empty($newrow)) { ?>


    <section id="main-container" class="main-container">
      <div class="container">
        <div class="row">


          <div class="col-xl-8 col-lg-8 mb-5">
            <div class="content-inner-page">

              <h1 class="column-title mrt-0 mb-0 text-uppercase"><?php echo $newrow['projectTitle']; ?></h1>
              <h4 style="margin-top:-10px"><b>Focus Area:</b>&nbsp; &nbsp;<?php echo $newrow['coreArea']; ?></h4>
              <div class="gap-40"></div>

              <div id="page-slider" class="page-slider">
                <div class="item">
                  <img loading="lazy" class="img-fluid" src="app/project_previews/<?php echo $newrow['projectPhoto']; ?>" alt="project-image" />
                </div>
              </div><!-- Page slider end -->


              <div class="gap-40"></div>

              <div class="row">
                <div class="col-md-12">
                  <p><?php echo $newrow['projectDesc']; ?></p>
                </div><!-- col end -->
              </div><!-- 1st row end-->


              <div class="gap-40"></div>



            </div><!-- Content inner end -->
          </div><!-- Content Col end -->


          <div class="col-xl-3 col-lg-4">
            <div class="sidebar sidebar-left">
              <div class="widget">
                <h3 class="widget-title text-center">Chairperson <p style="margin-top: 5px !important;">District Core Project </p>
                </h3>

              </div><!-- Widget end -->

              <div class="widget">
                <div class="quote-item quote-border">
                  <div class="quote-text-border">
                    <div class="team-img-wrapper ">
                      <img loading="lazy" src="app/project_previews/<?php echo $newrow['coordinatorPhoto']; ?>"
                        class="img-guard img-fluid" alt="Coordinator">
                    </div>
                  </div>

                  <div class="quote-item-footer">

                    <div class="quote-item-info">
                      <h2 class="quote-author"><?php echo $newrow['coordinatorName']; ?></h2>
                      <span class="quote-subtext" style="font-size: 16px !important"><b><?php echo $newrow['coordinatorPhone']; ?></b></span>
                    </div>
                  </div>
                </div><!-- Quote item end -->



              </div><!-- Widget end -->

              <!-- DONATION STARTS -->
              <div class="widget">
                <h3 class="widget-title text-center p-2" style="background-color: #ffb600 !important;">donate to the cause </h3>
                <p class="text-justify" style="margin-top: -20px !important; text-transform:capitalize">Your Generosity Fuels Our Mission of Service, Be part of this success story. </p>
              </div><!-- Widget end -->

              <form id="contact-form" action="#" method="post" role="form">
                <div class="error-container"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Enter Amount</label>
                      <input class="form-control form-control-amount" name="amount" id="amount" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label>Name</label>
                      <input class="form-control form-control-name" name="name" id="name" placeholder="" type="text" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control form-control-email" name="email" id="email" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input class="form-control form-control-phone" name="phone" id="phone" placeholder="" required>
                    </div>
                  </div>

                </div>
                <br>
                <button name="donate" class="btn btn-alt solid blank" type="submit">Donate Now</button>

                <!-- <div class="text-center"><br>
                  <button name="donate" class="btn btn-alt solid blank" type="submit">Donate Now</button>
                </div> -->
              </form>
            </div><!-- Sidebar end -->
          </div><!-- Sidebar Col end -->


        </div><!-- Main row end -->

      </div><!-- Conatiner end -->
    </section><!-- Main container end -->

  <?php } ?>
  <?php

  include("assets/footer.php");
  ?>
</body>

</html>