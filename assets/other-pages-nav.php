 <!--/ Navigation Start -->
 <?php
  include_once("app/include/config.php");
  $cat_select =  "SELECT * FROM tblcategory";
  ?>
 <div class="site-navigation">
   <div class="container">
     <div class="row">
       <div class="col-lg-12">
         <nav class="navbar navbar-expand-lg navbar-dark p-0">
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>

           <div id="navbar-collapse" class="collapse navbar-collapse">
             <ul class="nav navbar-nav m-auto align-items-center">
               <li class="nav-item nav-itemactive">
                 <a href="index">Home</a>
               </li>

               <li class="nav-item dropdown">
                 <a
                   href="#"
                   class="nav-link dropdown-toggle"
                   data-toggle="dropdown">About <i class="fa fa-angle-down"></i></a>
                 <ul class="dropdown-menu" role="menu">
                   <li>
                     <a href="about">District 404A2 </a>
                   </li>
                   <li>
                     <a href="lci-leaders">International Leaders </a>
                   </li>
                   <li>
                     <a href="past-district-governors">Past District Governors</a>
                   </li>
                   <li class="dropdown-submenu">
                     <a
                       href="#!"
                       class="dropdown-toggle"
                       data-toggle="dropdown">District Team</a>
                     <ul class="dropdown-menu">
                       <li><a href="#!">Core Team</a></li>
                       <li><a href="#!">District Officers</a></li>
                     </ul>
                   </li>
                   <li class="nav-item nav-itemactive">
                     <a href="">District Directory</a>
                   </li>
                 </ul>
               </li>
               <li class="nav-item dropdown">
                 <a
                   href="#"
                   class="nav-link dropdown-toggle"
                   data-toggle="dropdown">Focus Areas <i class="fa fa-angle-down"></i></a>
                 <ul class="dropdown-menu" role="menu">
                   <li class="dropdown-submenu">
                     <a
                       href="#!"
                       class="dropdown-toggle"
                       data-toggle="dropdown">Global Causes</a>
                     <ul class="dropdown-menu">
                       <li class="menu-logo">
                         <a href="#">
                           <img
                             src="images/global-causes-icons/diabetes-icon.png"
                             style="margin-right: 0 !important" />
                           Diabetes</a>
                       </li>
                       <li class="menu-logo">
                         <a href="#">
                           <img
                             src="images/global-causes-icons/sight-icon.png"
                             style="margin-right: 0 !important" />
                           Vision</a>
                       </li>
                       <li class="menu-logo">
                         <a href="https://www.lionsclubs.org/en/give-our-focus-areas/vision">
                           <img
                             src="images/global-causes-icons/HungerRelief.webp"
                             style="margin-right: 0 !important" />
                           Hunger</a>
                       </li>
                       <li class="menu-logo">
                         <a href="">
                           <img
                             src="images/global-causes-icons/environment.png"
                             style="margin-right: 0 !important" />
                           Environmment</a>
                       </li>
                       <li class="menu-logo">
                         <a href="">
                           <img
                             src="images/global-causes-icons/disaster-icon.png"
                             style="margin-right: 0 !important" />
                           Disaster Relief</a>
                       </li>
                       <li class="menu-logo">
                         <a href="">
                           <img
                             src="images/global-causes-icons/childhood-cancer.png"
                             style="margin-right: 0 !important" />
                           Paediatric Cancer</a>
                       </li>
                       <li class="menu-logo">
                         <a href="">
                           <img
                             src="images/global-causes-icons/humanitarian-icon.png"
                             style="margin-right: 0 !important" />
                           Humanitarian</a>
                       </li>
                       <li class="menu-logo">
                         <a href="">
                           <img
                             src="images/global-causes-icons/youth-icon.png"
                             style="margin-right: 0 !important" />
                           Youth</a>
                       </li>
                     </ul>
                   </li>
                   <li class="nav-item nav-itemactive">
                     <a href="index">Core Projects</a>
                   </li>
                 </ul>
               </li>

               <li class="nav-item dropdown">
                 <a
                   href="#"
                   class="nav-link dropdown-toggle"
                   data-toggle="dropdown">Events <i class="fa fa-angle-down"></i></a>
                 <ul class="dropdown-menu" role="menu">
                   <!-- <li><a href="#">Events</a></li> -->
                   <li class="dropdown-submenu">
                     <a
                       href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown">Events</a>
                     <ul class="dropdown-menu">
                       <?php
                        $cat_query = mysqli_query($con, $cat_select);
                        while ($row = mysqli_fetch_array($cat_query)) { ?>
                         <li><a href="events?cid=<?php echo $row['catID']; ?>"><?php echo $row['categoryName']; ?></a></li>
                       <?php } ?>
                     </ul>
                   </li>
                <li><a href="#">Events Gallery</a></li>
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
                          <a href="#">Newsletter</a>
                        </li>
                      </ul>
                    </li> -->

               <li class="nav-item">
                 <a class="nav-link" target="_blank" href="https://leodistrict404a2.com.ng">Our Leos</a>
               </li>

               <li class="nav-item">
                 <a class="nav-link" href="contact">Contact</a>
               </li>
               <!--/ Row end -->

               <div class="nav-search">
                 <span id="search"><i class="fa fa-search"></i></span>
               </div><!-- Search end -->

               <div class="search-block" style="display: none;">
                 <label for="search-field" class="w-100 mb-0">
                   <input type="text" class="form-control" id="search-field" placeholder="Type what you want and enter">
                 </label>
                 <span class="search-close">&times;</span>
               </div><!-- Site search end -->
           </div>
           <!--/ Container end -->

       </div>
       <!--/ Navigation end -->