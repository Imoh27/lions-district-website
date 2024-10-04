<?php
// include("app/include/config.php");
include("assets/main-header.php");
if (!empty($_GET["vid"])) {
  $vid = $_GET["vid"];
  // echo "".$vid.""; exit;
}
?>
<title>Activities Gallery - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  // $cat_select= "SELECT * FROM tblcategory WHERE catID = $catID ";
  // $cat_query=mysqli_query($con,$cat_select);
  // echo $cat_select; exit;
  // $newrow = mysqli_fetch_array($cat_query);

  $query = "SELECT * from tblgallery g JOIN tblevents e ON e.eventID = g.eventID INNER JOIN tblcategory c ON c.catID = e.catID";
  if (!empty($vid)) {
    $query .= " WHERE g.eventID = $vid";
  }
  $query .= " ORDER BY g.galleryID DESC";
  // echo $query; exit;
  $sql = mysqli_query($con, $query);
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
              <h1 class="banner-title">Activities Gallery</h1>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item"><a href="index">Home</a></li>
                  <?php
                  if (!empty($vid)) {
                    $eventrow = mysqli_fetch_array($sql); ?>
                    <li class="breadcrumb-item" aria-current="page"><a href="events-gallery">Activities Gallery</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $eventrow['eventTitle']; ?></li>
                  <?php } else { ?> <li class="breadcrumb-item active" aria-current="page">Activities Gallery</li> <?php } ?>
                </ol>
              </nav>
            </div>
          </div><!-- Col end -->
        </div><!-- Row end -->
      </div><!-- Container end -->
    </div><!-- Banner text end -->
  </div><!-- Banner area end -->

  <section id="main-container" class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-12 new-overflow">


          <div class="row shuffle-wrapper">
            <!-- <div class="col-1 shuffle-sizer"></div> -->
            <?php
            $cnt = 1;
            while ($row = mysqli_fetch_array($sql)) { ?>
              <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;government&quot;,&quot;healthcare&quot;]">
                <div class="project-img-container">
                  <a class="gallery-popup" href="app/events_gallery/<?php echo $row['eventPhoto']; ?>">
                    <img class="img-guard img-fluid" src="app/events_gallery/<?php echo $row['eventPhoto']; ?>" alt="">
                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                  </a>
                  <div class="project-item-info">
                    <div class="project-item-info-content">
                      <h3 class="project-item-title">
                        <a href="?vid=<?php echo $row['eventID']; ?>&viewAll=<?php echo $row['eventTitle']; ?>"><?php echo $row['eventTitle']; ?></a>
                      </h3>
                      <p class="project-cat"><?php echo $row['categoryName']; ?></p>
                    </div>
                  </div>
                </div>
              </div><!-- shuffle item 1 end -->
            <?php } ?>

          </div><!-- shuffle end -->
        </div>

        <!-- <div class="col-12">
          <div class="general-btn text-center">
            <a class="btn btn-primary" href="projects.html">View All Projects</a>
          </div>
        </div> -->

      </div><!-- Content row end -->

    </div><!-- Conatiner end -->
  </section><!-- Main container end -->
  <?php

  include("assets/footer.php");
  ?>
</body>

</html>