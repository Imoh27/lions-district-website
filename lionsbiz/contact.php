<?php
// include_once "app/includes/config.php";
include "includes/header.php";
include "includes/navbar.php";

?>
</head>

<body>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="/">Home</a>
                    <span class="breadcrumb-item active">Contact</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
       
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <form method="POST" action="includes/contact_data">
                        <div class="row g-3">
                                <div class="col-md-12 form-floating">
                                    <input type="text" class="form-control"  name="name"
                                        placeholder="Enter your Name" required>
                                    <p></p>
                                </div>
                                <div class="col-md-12 form-floating">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Your Email" required>
                                    <label for="email"></label>
                                </div>
                            
                                <div class="col-md-12 form-floating">
                                    <input type="text" class="form-control"  name="subject"
                                        placeholder="Subject">
                                    <label for="subject"></label>
                                </div>
                            
                                <div class="col-md-12 form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" name="message"
                                        style="height: 150px" required></textarea>
                                    <label for="message"></label>
                                </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-2 px-4" type="submit" name="submit">Send
                                    Message</button>
                            </div>
                        </div>
                    </form>

                    
                </div>
            </div>
            <div class="col-lg-5 mb-5 mt-5">
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Lions Park, Marian Road,
                        Calabar Cross River State</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>lionsbnf@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+234 803 932 8207</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php
include "includes/footer.php";
?>
</body>

</html>