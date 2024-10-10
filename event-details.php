<?php
// 
include("assets/main-header.php");
$eventID = $_GET["eid"];
// $registerAmount = 0;
?>
<title>Our Activities - Lions District 404A2</title>
<?php
include("assets/topbar.php");
include("assets/navbar.php");


include_once("app/include/config.php");
$cat_select = "SELECT * FROM tblevents e JOIN tblcategory c ON c.catID = e.catID WHERE e.eventID = $eventID ";
// echo $eventID; exit;
$cat_query = mysqli_query($con, $cat_select);
$newrow = mysqli_fetch_array($cat_query);
// echo $newrow['lionsAmount']; exit;

if (isset($_POST["register"])) {
  $registerCategory = strip_tags($_POST["registerCategory"]);
  $lionsID = strip_tags($_POST["lionsID"]);
  $clubName = strip_tags($_POST["clubName"]);
  $fullname = strip_tags($_POST["fullname"]);
  $email = strip_tags($_POST["email"]);
  $phone = strip_tags($_POST["phone"]);
  $payStatus = 0;

  if ($registerCategory == 'Lion' || $registerCategory == 'Guest') {
    $registerAmount  = $newrow['lionsAmount'];
  }
  if ($registerCategory == 'Leo') {
    $registerAmount  = $newrow['leosAmount'];
  }
  $pay_detail = "INSERT INTO tbleventregister Values(null, $eventID, '$registerCategory', '$lionsID', '$clubName', '$fullname',
   '$email', '$phone', '$registerAmount', $payStatus, now())";
  // echo $pay_detail; exit;
  $pay_query = mysqli_query($con, $pay_detail);
  if ($pay_query) {
    echo "<script>alert('Payment Successfully');</script>";
    echo "<script>window.location.href =''</script>";
  }
}
?>


</head>

<body>
  <?php
  

  ?>

  <!--/ Navigation end -->
  </header>
  <style>
    /* .lionsAmount{
    display: none !important
  } */
    .leosAmount {
      display: none
    }
  </style>
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
              <h3 class="widget-title">Event Chairperson</h3>

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
            <!-- REGISTRATION STARTS -->
            <?php if ($newrow['lionsAmount'] != 0 || $newrow['leosAmount'] != 0 || !empty($newrow['lionsAmount']) || !empty($newrow['leosAmount'])) { ?>
              <div class="widget">
                <h3 class="widget-title text-center p-2" style="background-color: #ffb600 !important;">Register Here </h3>
                <p style="margin-top: -20px !important; text-transform:capitalize">
                  <b><?php echo $newrow['eventTitle']; ?></b>
                </p>
                <h3 class="text-center lionsAmount" id="lionsAmount"><del style="text-decoration-style: double">N</del><?php echo $newrow['lionsAmount']; ?></h3>
                <h3 class="text-center leosAmount" id="leosAmount"><del style="text-decoration-style: double">N</del><?php echo $newrow['leosAmount']; ?></h3>
              </div><!-- Widget end -->

              <form id="contact-form" class="register-overflow" name="register" action="" method="post" role="form">
                <div class="error-container"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><b>I am a</b></label>
                      <select class="form-control form-control-registerCategory" name="registerCategory" id="registerCategory" onclick="showfields();">

                        <option value="Lion">Lion</option>
                        <option value="Leo">Leo</option>
                        <option value="Guest">Guest</option>
                      </select>
                    </div>
                    <div class="form-group" id="idnum">
                      <label>Lions ID</label>
                      <input class="form-control form-control-lionsID" name="lionsID" id="lionsID" placeholder="" required>
                    </div>
                    <div class="form-group" id="club">
                      <label>Club Name</label>
                      <input class="form-control form-control-club" name="clubName" id="clubName" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label>Full Name</label>
                      <input class="form-control form-control-name" name="fullname" id="fullname" placeholder="" type="text" required>
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
                <button name="register" class="btn btn-alt solid blank" type="submit">Register</button>

                <!-- <div class="text-center"><br>
                     <button name="donate" class="btn btn-alt solid blank" type="submit">Donate Now</button>
                   </div> -->
              </form>
            <?php } ?>

          </div><!-- Sidebar end -->
        </div><!-- Sidebar Col end -->
        <h1 class="mb-4">RELATED EVENTS</h1>
        <div class="col-lg-12">
          <div id="team-slide" class="team-slide">
            <?php
            $events_select = "SELECT * FROM tblevents WHERE catID =" . $newrow['catID'] . " AND eventID NOT IN($eventID)";
            // echo $events_select; exit;
            $events_query = mysqli_query($con, $events_select);
            while ($events = mysqli_fetch_array($events_query)) {
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
  <script>
    document.getElementById("registerCategory").onclick = function() {
      showfields()
    };

    function showfields() {
      const registerCategory = document.getElementById('registerCategory').value;
      //  console.log(registerCategory);
      if (registerCategory === 'Lion' || registerCategory === 'Leo') {
        document.getElementById('idnum').style.display = "block"
        document.getElementById('club').style.display = "block"
      }
      if (registerCategory === 'Guest') {
        document.getElementById('idnum').style.display = "none";
        document.getElementById('club').style.display = "none";
        document.getElementById('lionsAmount').style.display = "block";
        document.getElementById('leosAmount').style.display = "none";
      }
      if (registerCategory === 'Lion') {
        document.getElementById('lionsAmount').style.display = "block";
        document.getElementById('leosAmount').style.display = "none";
      }
      if (registerCategory === 'Leo') {
        document.getElementById('leosAmount').style.display = "block";
        document.getElementById('lionsAmount').style.display = "none";
      }

    }
  </script>
</body>

</html>