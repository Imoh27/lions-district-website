<?php
include_once "app/includes/config.php";



    $bizID = $_GET['business'];
    $categoryID = $_GET['category'];
    // echo $bizID.' - '.$categoryID; exit;


?>

<style>
.img-fluidd {
    width: 100% !important;
    height: auto !important;
}
</style>
    <?php
    include "includes/header.php";
include "includes/navbar.php";

?>
<link rel="stylesheet" href="css/slide.css">
</head>

<body>



    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="/">Home</a>
                    <a class="breadcrumb-item text-dark" href="businesses">Businesses</a>
                    <span class="breadcrumb-item active">Business Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
                        <?php 
                          $bizselect = "SELECT * FROM tblsamplephotos sp JOIN tblbusineses biz ON biz.bizID = sp.bizID INNER JOIN tblcategory c on c.categoryID = biz.categoryID INNER JOIN tblstates s on s.stateID = biz.bizStateID WHERE sp.bizID = $bizID AND biz.categoryID = $categoryID  ";  
                        //   echo $bizselect; exit;
                            $fetch = $con->query($bizselect);
                            $bizresult = $fetch->fetchAll(PDO::FETCH_ASSOC);
                          ?>
        
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30 h-auto">
                <div class="slideshow-container"></div>
                             <?php 
                           foreach($bizresult as $photoresult){?>
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img class="img-fluidd" src="samplePhotos/<?php echo $photoresult['photo_name']; ?>">
                </div>
                <br>
                <?php } ?>

                <div style="text-align:center">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
            <div class="col-lg-7 h-auto mb-30 mt-5">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $photoresult['bizName']; ?></h3>
                    <div class="d-flex mb-2">
                        <div class="text-primary mr-1">
                            <small class="" style="font-size:15px !important">Category: </small>
                        </div>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['categoryName']; ?></small>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="text-primary mr-1" style"display: block">
                            <small class="" style="font-size:15px !important">Location: </small>
                        </div>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['bizCity'].' - '.$photoresult['stateName']; ?></small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo $photoresult['contactPhone']; ?></h3>
                    <p class="mb-2"><?php echo $photoresult['aboutBiz']; ?></p>
                    <div class="d-flex mb-2">
                        <strong class="text-dark mr-2">Address:</strong>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['bizAddress']; ?>
                        </small>
                    </div>
                    <div class="d-flex mb-2">
                        <?php 
                        if($photoresult['cacNO']!='') {
                        ?>
                        <strong class="text-dark mr-2">RC NO:</strong>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['cacNO']; ?>
                        </small>
                        <?php } ?>
                    </div>
                    <div class="d-flex mb-2">
                        <strong class="text-dark mr-3">Email:</strong>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['bizEmail']; ?></small>
                    </div>
                    <?php 
                        if($photoresult['bizWebsite']!='') {
                            ?>
                    <div class="d-flex mb-2">
                        <strong class="text-dark mr-3">Website:</strong>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['bizWebsite']; ?></small>
                    </div>
                    <?php } ?>
                    <div class="d-flex mb-2">
                        <strong class="text-dark mr-2">Owner:</strong>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['ownerName']; ?></small>
                    </div>
                    <div class="d-flex mb-2">
                        <strong class="text-dark mr-2">Lions ID:</strong>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['lionsID']; ?></small>
                    </div>
                    <div class="d-flex mb-2">
                        <strong class="text-dark mr-2"> CLub:</strong>
                        <small class="font-weight-bold"
                            style="font-size:15px !important"><?php echo $photoresult['ownerClub']; ?></small>
                    </div>

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Follow Us On:</strong>
                        <div class="d-inline-flex">
                            <?php 
                            if($photoresult['fb']!='') {
                                ?>
                            <a class="text-dark px-2" href="https://facebook.com/<?php echo $photoresult['fb']; ?>">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <?php } 
                            if($photoresult['tw']!='') {
                                ?>
                            <a class="text-dark px-2" href="https://twitter.com/<?php echo $photoresult['tw']; ?>">
                                <i class="fab fa-twitter"></i>
                            </a>
                             <?php } 
                             if($photoresult['ig']!='') {
                                ?>
                            <a class="text-dark px-2" href="https://twitter.com/<?php echo $photoresult['ig']; ?>">
                                <i class="fab fa-insatgram-in"></i>
                            </a>
                             <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row px-xl-5">
            <div class="col">

            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
                

    <!-- Other Businesses Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">See
                Also</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <?php
                   $otherbizselect ="SELECT  * FROM tblbusineses biz JOIN tblcategory c ON c.categoryID = biz.categoryID JOIN tblstates s ON s.stateID  = biz.bizStateID";
                //   echo $otherbizselect; exit;
                   $fetch_lim = $con->query($otherbizselect);
                 $results = $fetch_lim->fetchAll(PDO::FETCH_ASSOC); 
                            ?>
                <div class="owl-carousel related-carousel">
                    <?php 
                     foreach ($results as $otherbiz) {
                       $select_photo1 = "SELECT DISTINCT(bizID) FROM tblsamplephotos WHERE bizID =".$otherbiz['bizID'];
                        // echo $select_photo1; exit;
                        $fetch_photo1 = $con->query($select_photo1);
                        $resultphoto = $fetch_photo1->fetch(PDO::FETCH_ASSOC); 
                        if($resultphoto){
                            $select_photo1 = "SELECT photo_name FROM tblsamplephotos WHERE bizID =".$resultphoto['bizID'];
                            $fetch_photo1 = $con->query($select_photo1);
                            $result = $fetch_photo1->fetch(PDO::FETCH_ASSOC);    
                        }?>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="samplePhotos/<?php echo $result['photo_name']; ?>" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="detail?business=<?php echo $otherbiz['bizID']; ?>&&category=<?php echo $otherbiz['categoryID']; ?>"><?php echo $otherbiz['bizName']; ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h6 class="ml-2"><?php echo $otherbiz['bizCity'].', '.$otherbiz['stateName']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Other Businesses End -->
    <script src="js/slide.js"></script>
    <!-- Footer Start -->
    <?php
         include "includes/footer.php";
        ?>
</body>
</html>