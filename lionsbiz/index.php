<?php
include "includes/header.php";
error_reporting(1)

?>
<link rel="stylesheet" href="css/new-slider.css">
<style>
    @media only screen and (max-width: 991px) {
    .product-offer {display:none !important}
    }
</style>
</head>

<body>

    <?php
include "includes/navbar.php";
include_once "app/includes/config.php";

                    
                    global $con;
                   $select_biz = "SELECT  * FROM tblbusineses biz JOIN tblcategory c ON c.categoryID = biz.categoryID ORDER BY RAND()";
                    $fetch = $con->query($select_biz);
                    $result_tbiz = $fetch->fetchAll(PDO::FETCH_ASSOC); 
                    // var_dump($result_tbiz); exit;

?>
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-4">
                <?php
                 $select_biz .= " LIMIT 2";
                //  echo $select_biz; exit;
                 $fetch_lim = $con->query($select_biz);
                 $results = $fetch_lim->fetchAll(PDO::FETCH_ASSOC); 
                  foreach ($results as $bizid) {
                       $select_photo1 = "SELECT DISTINCT(bizID) FROM tblsamplephotos WHERE bizID =".$bizid['bizID'];
                        // echo $select_photo1; exit;
                        $fetch_photo1 = $con->query($select_photo1);
                        $resultphoto = $fetch_photo1->fetch(PDO::FETCH_ASSOC); 
                        if($resultphoto){
                            $select_photo1 = "SELECT photo_name FROM tblsamplephotos WHERE bizID =".$resultphoto['bizID'];
                            $fetch_photo1 = $con->query($select_photo1);
                            $result = $fetch_photo1->fetch(PDO::FETCH_ASSOC);    
                        }?>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="samplePhotos/<?php echo $result['photo_name']; ?>" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-capitalize">Huge Discount</h6>
                        <h3 class="text-white mb-3"><?php echo $bizid['bizName']; ?></h3>
                        <a href="detail?business=<?php echo $bizid['bizID']; ?>&&category=<?php echo $bizid['categoryID']; ?>" class="btn btn-primary">Contact Now</a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-8 justify-coontent-center">

                <div class="carousel-container">
                        <div class="navigation-buttons">
                            <div class="previous nav-btn"><</div>
                            <div class="next nav-btn">></div>
                        </div>

                        <div class="slider-carousel">
                            <?php
                             $bizselect = "SELECT  * FROM tblbusineses";
                             // echo $bizselect; exit;
                             $fetch = $con->query($bizselect);
                             $bizresult = $fetch->fetchAll(PDO::FETCH_ASSOC); 
                                 foreach ($bizresult as $slide) {
                                    $select_photo1 = "SELECT DISTINCT(bizID) FROM tblsamplephotos WHERE bizID =".$slide['bizID'];
                            // echo $select_photo1; exit;
                            $fetch_photo1 = $con->query($select_photo1);
                            $resultphoto = $fetch_photo1->fetch(PDO::FETCH_ASSOC); 
                            if($resultphoto){
                                $select_photo1 = "SELECT distinct(photo_name) FROM tblsamplephotos WHERE bizID =".$resultphoto['bizID'];
                                // echo $select_photo1; exit;
                                $fetch_photo1 = $con->query($select_photo1);
                                $result = $fetch_photo1->fetch(PDO::FETCH_ASSOC);    
                                // echo $result['photo_name']; exit;
                            }
                            ?>
                            <div class="images main">
                                <img class="img-fluid" src="samplePhotos/<?php echo $result['photo_name']; ?>"
                                    alt="" />
                                <div class="image-text"><?php echo $slide['bizName'].' - '.$slide['bizCity'] ; ?></div>
                            </div>
                            <?php } ?>
                           
                        </div>
                    </div>

            </div>

        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">

            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h6 class="font-weight-semi-bold m-0">Connect Product</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h6 class="font-weight-semi-bold m-0">Swift Delivery</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h6 class="font-weight-semi-bold m-0">Connect Services</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h6 class="font-weight-semi-bold m-0">24/7 Support</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            <?php
             $selectCat = "SELECT * from tblcategory";
             $sth = $con->query($selectCat);
             $resultCat = $sth->fetchAll(PDO::FETCH_ASSOC);
             foreach($resultCat as $category){?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="businesses?category=<?php echo $category['categoryID'] ?>"
                    target="_blank">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <!-- <img class="img-fluid" src="img/cat-1.jpg" alt=""> -->
                        </div>
                        <div class="flex-fill pl-3">
                            <h6><?php echo $category['categoryName'] ?></h6>
                            <small class="text-body"><?php echo $category['bizCount']  ?> Business</small>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>
    <!-- Categories End -->


    <!-- Featured Business Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured
                Businesses</span></h2>
        <div class="row px-xl-5">
            <?php 
            foreach ($result_tbiz as $featured) {
               $select_photo1 = "SELECT DISTINCT(bizID) FROM tblsamplephotos WHERE bizID =".$featured['bizID'];
                            // echo $select_photo1; exit;
                            $fetch_photo1 = $con->query($select_photo1);
                            $resultphoto = $fetch_photo1->fetch(PDO::FETCH_ASSOC); 
                            if($resultphoto){
                                $select_photo1 = "SELECT distinct(photo_name) FROM tblsamplephotos WHERE bizID =".$resultphoto['bizID'];
                                // echo $select_photo1; exit;
                                $fetch_photo1 = $con->query($select_photo1);
                                $result = $fetch_photo1->fetch(PDO::FETCH_ASSOC);    
                                // echo $result['photo_name']; exit;
                            }
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="samplePhotos/<?php echo $result['photo_name']; ?>" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="<?php echo $featured['fb']; ?>"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate"
                            href="detail?business=<?php echo $featured['bizID']; ?>&&category=<?php echo $featured['categoryID']; ?>"><?php echo $featured['bizName']; ?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h7>Location:</h7>
                            <h7 class="text-bold ml-2"><?php echo $featured['bizCity']; ?></h7>
                        </div>
                       
                    </div>
                </div>
            </div>
            <?php } ?>
           
        </div>
    </div>
    <!-- Products End -->


    <!-- Brand Logos Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="img/vendor-1.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-2.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-4.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-6.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-7.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Logos End -->
    <script src="js/new-slider.js"></script>
    <?php
include "includes/footer.php";
?>
</body>

</html>