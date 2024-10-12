<footer id="footer" class="footer bg-overlay">
  <div class="footer-main">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-4 col-md-6 footer-widget footer-about">
          <h3 class="widget-title text-alt">About Us</h3>
          <img
            loading="lazy"
            width="300px"
            class="footer-logo"
            src="images/footer-logo.png"
            alt="Lions District 404A2" />
          <p>
            Welcome to Lions Clubs International District 404A2 Nigeria, where individuals from all walks of life unite to make meaningful
            contributions to our society. Our members are driven by a shared purpose: to serve with dedication, empathy, and integrity.
          </p>

        </div>
        <!-- Col end -->

        <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
          <h3 class="widget-title text-alt">Navigation</h3>
          <div class="row">
            <div class="col-md-6">
              <ul class="list-arrow">
                <li><a href="about">About Us</a></li>
                <li><a href="lci-leaders">Lions Leaders</a></li>
                <li><a href="past-district-governors">Past DG's</a></li>
                <li><a href="coreprojects">Core Projects</a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-arrow">
                <li><a href="events">Events</a></li>
                <li><a href="events-gallery">Gallery</a></li>
                <li><a href="#">District Directory</a></li>
                <li><a href="#">Newsletter</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Col end -->

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
          <h3 class="widget-title text-alt">Reach Us</h3>
          <div class="working-hours">
            Lions Park, Marian Rd by Ekong Etta, Calabar
            <br />
            info@lionsclubs404a2.com
          </div>
          <div class="footer-social">
            <ul>
              <li>
                <a
                  href="https://www.facebook.com/District404A2" target="_blank"
                  aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
              </li>
              <li>
                <a
                  href="https://x.com/District404A2?t=JldSx1YxCrKWH2wkl3pR8w&s=09" target="_blank"
                  aria-label="Twitter"><i class="fab fa-twitter"></i></a>
              </li>
              <li>
                <a
                  href="https://www.instagram.com/district404a2?igsh=MW01cHRxZWx6NDN2bQ==" target="_blank"
                  aria-label="Instagram"><i class="fab fa-instagram"></i></a>
              </li>
              <li>
                <a
                  href="https://whatsapp.com/channel/0029Va6KBBnKLaHnsfNMvp0m" target="_blank"
                  aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a>
              </li>
            </ul>
          </div>
          <!-- Footer social end -->
        </div>
      </div>
      <!-- Row end -->
    </div>
    <!-- Container end -->
  </div>
  <!-- Footer main end -->

  <div class="copyright">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="copyright-info text-center">
            <span>&copy; <script>
                document.write(new Date().getFullYear());
              </script> Lions Clubs District 404A2.
            </span>
          </div>
        </div>

      </div>
      <!-- Row end -->

      <div
        id="back-to-top"
        data-spy="affix"
        data-offset-top="10"
        class="back-to-top position-fixed">
        <button class="btn btn-primary" title="Back to Top">
          <i class="fa fa-angle-double-up"></i>
        </button>
      </div>
    </div>
    <!-- Container end -->
  </div>
  <!-- Copyright end -->
</footer>
<!-- Footer end -->

<!-- Javascript Files
  ================================================== -->

<!-- initialize jQuery Library -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap jQuery -->
<script src="plugins/bootstrap/bootstrap.min.js" defer></script>
<!-- Slick Carousel -->
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/slick/slick-animation.min.js"></script>
<!-- Color box -->
<script src="plugins/colorbox/jquery.colorbox.js"></script>
<!-- shuffle -->
<script src="plugins/shuffle/shuffle.min.js" defer></script>

<!-- Google Map API Key-->
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"
  defer></script>
<!-- Google Map Plugin-->
<script src="plugins/google-map/map.js" defer></script>

<!-- Template custom -->
<script src="js/script.js"></script>

<?php
$today = date("Y-m-d");
$events_sql = "select * from tblevents e JOIN tblcategory c ON c.catID = e.catID where e.startDate >= now() ORDER BY e.startDate DESC LIMIT 1";
// echo $events_sql; exit;
$events_query = mysqli_query($con, $events_sql);
$row = mysqli_fetch_array($events_query)


?>
<div id="openModal" class="popupDialog" >
  <div>
    <a href="#close" title="Close" class="popupclose">X</a>


    <p style="color:white ">
      <div class="row bg-light p-3 bg-">
          <div class="col-lg-7">
        <h3 class="text-center">Upcoming Event</h3>
        <div class="ts-service-box">
          <div class="ts-service-image-wrapper">
            <img
              loading="lazy"
              class="img-guard img-fluid"
              src="app/event_previews/<?php echo $row['previewPhoto']; ?>"
              alt="service-image" />
          </div>
        </div>
  
        <!-- Service1 end -->
      </div>
      
      <div class="col-lg-5 m-auto">
        <div class="d-flex">
          <div class="ts-service-info text-center adjust-center">
            <h2 class="service-box-title">
              <a href="event-details?eid=<?php echo $row['eventID']; ?>"><?php echo $row['eventTitle']; ?></a>
            </h2>
            <p style="margin-top: -5px text-center">
              <a class="btn btn-lg btn-primary" href=""> Check out</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    </p>

  </div>
</div>
<!-- Me i no be regular front end person sha oh, na open eye i dey take do this full stack thing😄 -->
<script>
 
  setTimeout(openPopup, 9000);
  function openPopup() {
        window.location.hash = "openModal";
       
    }
  setTimeout(function() { openPopup.close();}, 3000);

</script>
</div>
<!-- Body inner end -->