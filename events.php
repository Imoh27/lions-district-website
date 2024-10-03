<?php
// include("app/include/config.php");
include("assets/main-header.php");
$catID = $_GET["cid"];
?>
<title>Our International Leaders - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  $cat_select= "SELECT * FROM tblcategory WHERE catID = $catID ";
  $cat_query=mysqli_query($con,$cat_select);
  // echo $cat_select; exit;
  $newrow = mysqli_fetch_array($cat_query);
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
                <h1 class="banner-title">Our Activities</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                      <li class="breadcrumb-item"><a href="index">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo $newrow['categoryName']; ?></li>
                    </ol>
                </nav>
              </div>
          </div><!-- Col end -->
        </div><!-- Row end -->
    </div><!-- Container end -->
  </div><!-- Banner text end -->
</div><!-- Banner area end --> 

<section id="main-container" class="main-container pb-2">
  <div class="container">
    <div class="row">
      <?php
      $events_select="SELECT * FROM tblevents e WHERE catID = $catID";
      $events_query=mysqli_query($con,$events_select);
    while(  $events = mysqli_fetch_array($events_query)){
      ?>
    
      <div class="col-lg-4 col-md-4 col-sm-6 mb-5">
          <div class="item">
              <div class="ts-team-wrapper">
                <div class="team-img-wrapper ">
                  <img loading="lazy" src="app/event_previews/<?php echo $events['previewPhoto']; ?>"
                    class="img-guard img-fluid" alt="team-img">
                </div>
                <div class="ts-team-content-classic">
                  <h2 class="service-box-title"><a href="event-details?eid=<?php echo $events['eventID']; ?>"><?php echo $events['eventTitle']; ?></a></h2>
               
                </div>
              </div>
              </div>
              <!--/ Team wrapper 3 end -->
            </div><!-- Col end -->
<?php } ?>

    </div><!-- Main row end -->
  </div><!-- Conatiner end -->
</section><!-- Main container end -->
<?php

include("assets/footer.php");
?>
  </body>

  </html>