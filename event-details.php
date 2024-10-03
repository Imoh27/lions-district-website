<?php
// include("app/include/config.php");
include("assets/main-header.php");
$eventID = $_GET["eid"];
?>
<title>Our International Leaders - Lions District 404A2</title>

</head>

<body>
  <?php
  include("assets/other-pages-topbar.php");
  include("assets/other-pages-nav.php");
  $cat_select= "SELECT * FROM tblevents e JOIN tblcategory c ON c.catID = e.catID WHERE eventID = $eventID ";
  // echo $eventID; exit;
  $cat_query=mysqli_query($con,$cat_select);
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
                <h1 class="banner-title">Our Events</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                      <li class="breadcrumb-item"><a href="index">Home</a></li>
                      <li class="breadcrumb-item"><a href="events?cid=<?php echo $newrow['catID']; ?>"><?php echo $newrow['categoryName']; ?></a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo $newrow['eventTitle']; ?></li>
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

    
      <div class="col-xl-8 col-lg-8 mb-5">
        <div class="content-inner-page">

          <h2 class="column-title mrt-0"><?php echo $newrow['eventTitle']; ?></h2>
          <p><b>Category:</b>&nbsp; &nbsp;<?php echo $newrow['categoryName']; ?>&nbsp; &nbsp; | &nbsp; &nbsp;
              <b>Location:</b> <?php echo $newrow['eventLocation']; ?>&nbsp; &nbsp; | &nbsp; &nbsp;
              <b>Date:</b> <?php echo date('d-m-Y', strtotime($newrow['startDate'])); ?>
          </p>
          <div class="gap-40"></div>

          <div id="page-slider" class="page-slider">
            <div class="item">
              <img loading="lazy" class="img-fluid" src="app/event_previews/<?php echo $newrow['previewPhoto']; ?>" alt="project-slider-image" />
            </div>
          </div><!-- Page slider end -->

         
          <div class="gap-40"></div>
          
          <div class="row">
            <div class="col-md-12">
              <p><?php echo $newrow['eventDesc']; ?></p>
            </div><!-- col end -->
          </div><!-- 1st row end-->
         

          <div class="gap-40"></div>

      

        </div><!-- Content inner end -->
      </div><!-- Content Col end -->


      <div class="col-xl-3 col-lg-4">
        <div class="sidebar sidebar-left">
          <div class="widget">
            <h3 class="widget-title">Coordinator</h3>
            
          </div><!-- Widget end -->

          <div class="widget">
            <div class="quote-item quote-border">
              <div class="quote-text-border">
              <div class="team-img-wrapper ">
                  <img loading="lazy" src="app/event_previews/<?php echo $newrow['cordinatorPhoto']; ?>"
                    class="img-guard img-fluid" alt="team-img">
                </div>
              </div>

              <div class="quote-item-footer">
               
                <div class="quote-item-info">
                  <h2 class="quote-author"><?php echo $newrow['cordinatorName']; ?></h2>
                  <span class="quote-subtext" style="font-size: 16px !important"><?php echo $newrow['cordinatorPhone']; ?></span>
                </div>
              </div>
            </div><!-- Quote item end -->

          </div><!-- Widget end -->

        </div><!-- Sidebar end -->
      </div><!-- Sidebar Col end -->
<h1 class="mb-4">RELATED EVENTS</h1>
        <div class="col-lg-12">
          <div id="team-slide" class="team-slide">
          <?php
            $events_select="SELECT * FROM tblevents WHERE catID =".$newrow['catID']." AND eventID NOT IN($eventID)";
            // echo $events_select; exit;
            $events_query=mysqli_query($con,$events_select);
             while($events = mysqli_fetch_array($events_query)){
            ?>
              <div class="item">
                <div class="ts-team-wrapper">
                <div class="team-img-wrapper ">
                  <img loading="lazy" src="app/event_previews/<?php echo $events['previewPhoto']; ?>"
                    class="img-guard img-fluid" alt="team-img">
                </div>
                    <div class="ts-team-content-classic">
                    <h2 class="service-box-title"><a href="event-details?eid=<?php echo $events['eventID']; ?>"><?php echo $events['eventTitle']; ?></a></h2>
                    </div>
                </div><!--/ Team wrapper end -->
              </div><!-- Team 1 end -->
            <?php } ?>
             

          </div><!-- Team slide end -->
        </div>
   

    </div><!-- Main row end -->

  </div><!-- Conatiner end -->
</section><!-- Main container end -->
<?php

include("assets/footer.php");
?>
  </body>

  </html>