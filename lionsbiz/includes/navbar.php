
    <div class="container-fluid bg-secondary mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block py-3 py-lg-0 px-0">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" href="/" style="height: 65px; padding: 0 30px;"><img class="img-fluid" src="img/lions-biz-logo.png" alt="">
                    <!-- <h6 class="text-dark m-0"> <img class="img-fluid" src="img/lets-connect.png" alt=""></h6> -->
                </a>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-lionsblue navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none mb-3"><img class="img-fluid" src="img/lions-biz-logo.png" alt="">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            <a href="businesses" class="nav-item nav-link">Businesses</a>
                            <a href="contact" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-lg-block">
                            <a href="" class="btn">
                                <i class="fas fa-heart text-primary"></i>
                                Call:  <span class="badge text-secondary" style="padding-bottom: 2px;">+234 803 932 8207</span>
                                </a>
                                <?php
                                if (empty($_GET['action']) || !$_GET['action']) {?>
                                <a target="_blank" href="add-business.php?action=add-business" class="btn btn-primary" style="margin-right: 5px;">Register</a>
                                <?php  }  ?>
                           
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->