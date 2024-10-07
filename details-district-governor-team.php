<?php
error_reporting(0);
include("app/include/config.php");
include("assets/main-header.php");
$leaderID = $_GET['check'];

?>
<title>Leader Details - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  ?>
</header>
<?php
        $leadersql = "SELECT * FROM tblinternationalleaders  WHERE leadersID = $leaderID";
        $leaderquery = mysqli_query($con, $leadersql);
        $row = mysqli_fetch_assoc($leaderquery)
?>
<section id="main-container" class="main-container">
  <div class="container">

    <div class="row">
      <div class="col-lg-4">
        <div id="page-slider">
          <div class="item justify-content-center mt-lg-2">
            <img loading="lazy" class="img-fluid" src="app/LCI_leaders_Photos/<?php echo $row['leaderPhoto']; ?>" alt="project-image" />
          </div>

        </div><!-- Page slider end -->
      </div><!-- Slider col end -->

      <div class="col-lg-8 mt-5 mt-lg-3">

        <h2 class="d-inline column-title mrt-0 text-default"><?php echo $row['fullName']; ?> <h4 class="d-inline text-default"><?php echo $row['lci_awards']; ?></h4></h2>
        <h4 class="mt-2 mb-4"><?php echo $row['position']; ?></h4>
        <p class="text-justify"><?php echo $row['leaderProfile']; ?></p>
       
          <li>
            <p class="project-info-label">Client</p>
            <p class="project-info-content">Pransbay Powers Authority</p>
          </li>
          <li>
            <p class="project-info-label">Architect</p>
            <p class="project-info-content">Dlarke Pelli Incorp</p>
          </li>
          <li>
            <p class="project-info-label">Location</p>
            <p class="project-info-content">McLean, VA</p>
          </li>
          <li>
            <p class="project-info-label">Size</p>
            <p class="project-info-content">65,000 SF</p>
          </li>
          <li>
            <p class="project-info-label">Year Completed</p>
            <p class="project-info-content">2015</p>
          </li>
          <li>
            <p class="project-info-label">Categories</p>
            <p class="project-info-content">Commercial, Interiors</p>
          </li>
          <li>
            <p class="project-link">
              <a class="btn btn-primary" target="_blank" href="#">View Project</a>
            </p>
          </li>
        </ul> -->

      </div><!-- Content col end -->

    </div><!-- Row end -->

  </div><!-- Conatiner end -->
</section><!-- Main container end -->
<?php

include("assets/footer.php");
?>
  </body>

  </html>