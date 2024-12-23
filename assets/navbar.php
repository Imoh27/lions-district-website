<!-- Header start -->
<?php
include("app/include/config.php");
$cat_select =  "SELECT * FROM tblcategory";
$cat_query = mysqli_query($con, $cat_select);

$area_select =  "SELECT * FROM tblcorereas";
?>
<header id="header" class="header-two">
  <div class="site-navigation">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="logo">
              <a class="d-block" href="index">
                <img loading="lazy" src="images/logo.png" alt="Lions District 404A2" />
                <!-- <h4 class="sitename text-uppercase">Lions District 404A2</h4> -->
              </a>
            </div>
            <!-- logo end -->

            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target=".navbar-collapse"
              aria-controls="navbar-collapse"
              aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbar-collapse" class="collapse navbar-collapse">
              <ul class="nav navbar-nav ml-auto align-items-center">
                <li class="nav-item nav-itemactive">
                  <a href="index">Home</a>
                </li>

                <li class="nav-item dropdown">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown">About <i class="fa fa-angle-down"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <!-- <li><a href="typography">Typography</a></li>
                          <li><a href="404">404</a></li> -->
                    <li>
                      <a href="about">District 404A2 </a>
                    </li>
                    <li class="dropdown-submenu">
                      <a
                        class="dropdown-toggle"
                        data-toggle="dropdown">Our Leaders</a>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="lci-leaders">International Leaders </a>
                        </li>
                        <li>
                          <a href="past-district-governors">Past District Governors</a>
                        </li>
                        <li><a href="district-governor-team">DG Team</a></li>
                        <li><a href="core-district-officers">Core Officers</a></li>
                        <li><a href="region-and-zones">Region/Zones</a></li>
                        <li><a href="club-presidents">club Presidents</a></li>
                      </ul>
                    </li>
                    <li class="nav-item nav-item">
                      <a href="resource-centre">Resource Center</a>
                      <a href="club-gala-dates">Club Gala Dates</a>
                      <!-- <a href="#">District Directory</a> -->
                    </li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown">Focus Areas <i class="fa fa-angle-down"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <!-- <li><a href="typography">Typography</a></li>
                          <li><a href="404">404</a></li> -->

                    <li class="dropdown-submenu">
                      <a
                        href="#"
                        class="dropdown-toggle"
                        data-toggle="dropdown">Global Causes</a>
                      <ul class="dropdown-menu">
                        <li class="menu-logo">
                          <a href="https://www.lionsclubs.org/en/give-our-focus-areas/diabetes"
                            target="_blank"
                            rel="noopener noreferrer">
                            <img
                              src="images/global-causes-icons/diabetes-icon.png"
                              style="margin-right: 0 !important" />
                            Diabetes</a>
                        </li>
                        <li class="menu-logo">
                          <a href="https://www.lionsclubs.org/en/give-our-focus-areas/vision"
                            target="_blank"
                            rel="noopener noreferrer">
                            <img
                              src="images/global-causes-icons/sight-icon.png"
                              style="margin-right: 0 !important" />
                            Vision</a>
                        </li>
                        <li class="menu-logo">
                          <a
                            href="https://www.lionsclubs.org/en/give-our-focus-areas/hunger"
                            target="_blank"
                            rel="noopener noreferrer">

                            <img
                              src="images/global-causes-icons/HungerRelief.webp"
                              alt="Hunger Relief Icon"
                              style="margin-right: 0 !important" />
                            Hunger
                          </a>
                        </li>

                        <li class="menu-logo">
                          <a href="https://www.lionsclubs.org/en/give-our-focus-areas/environment"
                            target="_blank"
                            rel="noopener noreferrer">
                            <img
                              src="images/global-causes-icons/environment.png"
                              style="margin-right: 0 !important" />
                            Environmment</a>
                        </li>
                        <li class="menu-logo">
                          <a href="https://www.lionsclubs.org/en/give-our-focus-areas/disaster-relief"
                            target="_blank"
                            rel="noopener noreferrer">
                            <img
                              src="images/global-causes-icons/disaster-icon.png"
                              style="margin-right: 0 !important" />
                            Disaster Relief</a>
                        </li>
                        <li class="menu-logo">
                          <a href="https://www.lionsclubs.org/en/start-our-global-causes/childhood-cancer"
                            target="_blank"
                            rel="noopener noreferrer">
                            <img
                              src="images/global-causes-icons/childhood-cancer.png"
                              style="margin-right: 0 !important" />
                            Paediatric Cancer</a>
                        </li>
                        <li class="menu-logo">
                          <a href="https://www.lionsclubs.org/en/give-our-focus-areas/humanitarian"
                            target="_blank"
                            rel="noopener noreferrer">
                            <img
                              src="images/global-causes-icons/humanitarian-icon.png"
                              style="margin-right: 0 !important" />
                            Humanitarian</a>
                        </li>
                        <li class="menu-logo">
                          <a href="https://www.lionsclubs.org/en/give-our-focus-areas/youth"
                            target="_blank"
                            rel="noopener noreferrer">
                            <img
                              src="images/global-causes-icons/youth-icon.png"
                              style="margin-right: 0 !important" />
                            Youth</a>
                        </li>
                      </ul>
                    </li>
                    <!-- <li class="nav-item nav-itemactive">
                      <a href="#">Core Projects</a>
                    </li> -->
                    <li class="dropdown-submenu">
                      <a
                        href="#"
                        class="dropdown-toggle"
                        data-toggle="dropdown">Core Projects</a>
                      <ul class="dropdown-menu">
                        <?php
                        $area_query = mysqli_query($con, $area_select);
                        while ($row = mysqli_fetch_array($area_query)) { ?>
                          <li><a href="coreprojects?aid=<?php echo $row['areaID']; ?>"><?php echo $row['coreArea']; ?></a></li>
                        <?php } ?>
                      </ul>
                    </li>
                  </ul>
                </li>
                <!-- <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Core Projects <i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="projects">Projects All</a></li>
                            <li><a href="projects-single">Projects Single</a></li>
                          </ul>
                      </li> -->

                <li class="nav-item dropdown">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown">Events <i class="fa fa-angle-down"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-submenu">
                      <a
                        href="#"
                        class="dropdown-toggle"
                        data-toggle="dropdown">Events</a>
                      <ul class="dropdown-menu">
                        <?php
                        while ($row = mysqli_fetch_array($cat_query)) { ?>
                          <li><a href="events?cid=<?php echo $row['catID']; ?>"><?php echo $row['categoryName']; ?></a></li>
                        <?php } ?>
                      </ul>
                    </li>
                    <li><a href="events-gallery">Events Gallery</a></li>
                  </ul>
                </li>

                <!-- <li class="nav-item dropdown">
                        <a
                          href="#"
                          class="nav-link dropdown-toggle"
                          data-toggle="dropdown"
                          >updates Center <i class="fa fa-angle-down"></i
                        ></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Blog</a></li>
                          <li>
                            <a href="news-right-sidebar">Newsletter</a>
                          </li>
                        </ul>
                      </li> -->

                <!-- <li class="nav-item">
                  <a class="nav-link" href="resource-centre">Resource Center</a>
                </li> -->

                <li class="nav-item">
                  <a class="nav-link" href="https://leodistrict404a2.com.ng">Our Leos</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="contact">Contact</a>
                </li>

                <li class="header-get-a-quote">
                  <a
                    class="btn btn-primary"
                    style="color: #fff !important"
                    href="contact">Donate Now</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
        <!--/ Col end -->
      </div>
      <!--/ Row end -->
    </div>
    <!--/ Container end -->
  </div>
  <!--/ Navigation end -->
</header>
<!--/ Header end -->