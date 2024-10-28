<?php
include_once "app/includes/config.php";
global $con;
include "includes/header.php";
if (!empty($_GET['category'])) {
    $categoryID = $_GET['category'];
    // echo $categoryID; exit;
}
        if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
        } else {
          $pageno = 1;
        }
        $no_of_records_per_page = 12;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT * FROM tblbusineses";
        // echo $total_pages_sql; exit;
        $sth = $con->query($total_pages_sql);
        $count = count($sth->fetchAll(PDO::FETCH_ASSOC));
        // echo $count; exit;


        // $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($count / $no_of_records_per_page);
        // echo $total_pages; exit;




// $select_biz = "SELECT  * FROM tblsamplephotos sp JOIN tblbusineses biz ON biz.bizID = sp.bizID";
$select_biz = "SELECT  * FROM tblbusineses biz JOIN tblcategory c ON c.categoryID = biz.categoryID 
";

if (!empty($categoryID)) {
    $select_biz .=" WHERE biz.categoryID = $categoryID"; 
}else{
$select_biz .= " LIMIT $offset, $no_of_records_per_page";
}
// echo $select_biz; exit;
$fetch = $con->query($select_biz);
$result = $fetch->fetchAll(PDO::FETCH_ASSOC); 
if (!empty($categoryID)) {
    $fetch = $con->query($select_biz);
    $results = $fetch->fetchAll(PDO::FETCH_ASSOC);   
    // var_dump($results); exit;
}

include "includes/navbar.php";


?>
</head>
<body>
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="/">Home</a>
                        <a class="breadcrumb-item text-dark" href="">Businesses</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->


        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Product Start -->
                <div class="col-lg-12 col-md-12">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                
                                <!--<div class="ml-2">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                            data-toggle="dropdown">Sorting</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Latest</a>
                                            <a class="dropdown-item" href="#">Popularity</a>
                                            <a class="dropdown-item" href="#">Best Rating</a>
                                        </div>
                                    </div>
                                    <div class="btn-group ml-2">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                            data-toggle="dropdown">Showing</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">10</a>
                                            <a class="dropdown-item" href="#">20</a>
                                            <a class="dropdown-item" href="#">30</a>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>

                        <?php
                        if (empty($categoryID)) {
                         foreach ($result as $featured) {
                             $select_photo1 = "SELECT DISTINCT(bizID) FROM tblsamplephotos WHERE bizID =".$featured['bizID'];
                            // echo $select_photo1; exit;
                            $fetch_photo1 = $con->query($select_photo1);
                            $resultphoto = $fetch_photo1->fetch(PDO::FETCH_ASSOC); 
                            if($resultphoto){
                                $select_photo1 = "SELECT photo_name FROM tblsamplephotos WHERE bizID =".$resultphoto['bizID'];
                                $fetch_photo1 = $con->query($select_photo1);
                                $result = $fetch_photo1->fetch(PDO::FETCH_ASSOC);    
                            }
                            
                            
                            ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="samplePhotos/<?php echo $result['photo_name']; ?>"
                                        alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square"
                                            href="<?php echo $featured['fb']; ?>"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-search"></i></a>
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
                        <?php } }
                         if (!empty($categoryID)) {
                            foreach ($results as $category){
                                 $select_photo1 = "SELECT DISTINCT(bizID) FROM tblsamplephotos WHERE bizID =".$category['bizID'];
                                // echo $select_photo1; exit;
                                $fetch_photo1 = $con->query($select_photo1);
                                $resultphoto = $fetch_photo1->fetch(PDO::FETCH_ASSOC); 
                                if($resultphoto){
                                    $select_photo1 = "SELECT photo_name FROM tblsamplephotos WHERE bizID =".$resultphoto['bizID'];
                                    $fetch_photo1 = $con->query($select_photo1);
                                    $result = $fetch_photo1->fetch(PDO::FETCH_ASSOC);    
                                }
                        ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="samplePhotos/<?php echo $result['photo_name']; ?>"
                                        alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square"
                                            href="<?php echo $category['fb']; ?>"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="detail?business=<?php echo $category['bizID']; ?>&&category=<?php echo $category['categoryID']; ?>"><?php echo $category['bizName']; ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h7>Location:</h7>
                                        <h7 class="text-bold ml-2"><?php echo $category['bizCity']; ?></h7>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php } }
                         if (empty($categoryID)) {?>
                        <div class="col-12">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
                                    <li class="<?php if ($pageno <= 1) {
                                        echo 'disabled';
                                    } ?> page-item">
                                        <a href="<?php if ($pageno <= 1) {
                                        echo '#';
                                        } else {
                                        echo "?pageno=" . ($pageno - 1);
                                        } ?>" class="page-link">Prev</a>
                                    </li>
                                    <li class="<?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?> page-item">
                                        <a href="<?php if ($pageno >= $total_pages) {
                                        echo '#';
                                        } else {
                                        echo "?pageno=" . ($pageno + 1);
                                        } ?> " class="page-link">Next</a>
                                    </li>
                                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
    </end>


        <!-- Footer Start -->
        <?php
         include "includes/footer.php";
        ?>
    </body>

    </html>