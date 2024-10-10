<?php
include("assets/main-header.php");
?>
 <title>Contact Us - Lions District 404A2</title>

</head>
<body>
<?php
include("assets/topbar.php");
include("assets/navbar.php");

if (isset($_POST["send-message"])) {
 $name = strip_tags($_POST["name"]);
 $email = strip_tags($_POST["email"]);
 $subject = strip_tags($_POST["subject"]);
 $contactNo = strip_tags($_POST["contactNo"]);
 $message = str_replace(array( '\'', '"',
    ';','*' ), '', strip_tags($_POST["message"]));
    
$isRead = 0;
 $contact_sql="SELECT * FROM  tblcontactus WHERE fullname = '$name' and email = '$email' and messageSubject  = '$subject' ";
//  echo $contact_sql; exit;
 $contact_query = mysqli_query($con, $contact_sql);
 $contact_row = mysqli_fetch_array($contact_query);
 if (!empty($contact_row)){
  echo "<script>alert('Please Modify Message and retry');</script>";
}else{
  $contact_insert = "INSERT INTO tblcontactus VALUES(NULL, '$name', '$email', '$contactNo', '$subject', '$message', now(), NULL, $isRead)";
  // echo $contact_insert; exit;
  $query = mysqli_query($con, $contact_insert);
  if ($query) {
    echo "<script>alert('Message Sent');</script>";
		echo "<script>window.location.href =''</script>";
  }
}
}

?>

</header>
<!--/ Header end -->
<div id="banner-area" class="banner-area" style="background-image:url(images/banner/banner1.jpg)">
  <div class="banner-text">
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
              <div class="banner-heading">
                <h1 class="banner-title">Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                      <li class="breadcrumb-item"><a href="#">Dedicated to Serving Communities and Making a Difference</a></li>
                      <!-- <li class="breadcrumb-item"><a href="#">Company</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Contact Us</li> -->
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

    <div class="row text-center">
      <div class="col-12">
        <h2 class="section-title">Get in Touch</h2>
        <h3 class="section-sub-title">Serving Communities Together</h3>
      </div>
    </div>
    <!--/ Title row end -->

    <div class="row">
      <div class="col-md-4">
        <div class="ts-service-box-bg text-center h-100">
          <span class="ts-service-icon icon-round">
            <i class="fas fa-map-marker-alt mr-0"></i>
          </span>
          <div class="ts-service-box-content">
            <h4>Visit Our Office</h4>
            <p>Lions Park, Marian Rd by Ekong Etta, Calabar</p>
          </div>
        </div>
      </div><!-- Col 1 end -->

      <div class="col-md-4">
        <div class="ts-service-box-bg text-center h-100">
          <span class="ts-service-icon icon-round">
            <i class="fa fa-envelope mr-0"></i>
          </span>
          <div class="ts-service-box-content">
            <h4>Email Us</h4>
            <p><a href="mailto:info@lionsdistrict404a2.com">info@lionsdistrict404a2.com</a></p>
          </div>
        </div>
      </div><!-- Col 2 end -->

      <div class="col-md-4">
        <div class="ts-service-box-bg text-center h-100">
          <span class="ts-service-icon icon-round">
            <i class="fa fa-phone-square mr-0"></i>
          </span>
          <div class="ts-service-box-content">
            <h4>Call Us</h4>
            <p><a href="tel:(+234) 803 600 5958">(+234) 803 600 5958</a></p>
          </div>
        </div>
      </div><!-- Col 3 end -->

    </div><!-- 1st row end -->

    <!-- <div class="google-map">
      <div id="map" class="map" data-latitude="40.712776" data-longitude="-74.005974" data-marker="images/marker.png" data-marker-name="Constra"></div>
    </div> -->

    <div class="gap-40"></div>

    <div class="row">
      <div class="col-md-12">
        <h3 class="column-title">We love to hear</h3>
        <form id="contact-form" action="" method="post" role="form">
          <div class="error-container"></div>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Name</label>
                <input class="form-control form-control-name" name="name" id="name" placeholder="" type="text" required>
              </div>
            </div>
            <div class="col-4"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control form-control-email" name="email" id="email" placeholder="" type="email"
                  required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Contact Number</label>
                <input class="form-control form-control-contactNo" name="contactNo" id="contactNo" placeholder="" type="tel"
                  required>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Subject</label>
                <input class="form-control form-control-subject" name="subject" id="subject" placeholder="" required>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Message</label>
              <textarea class="form-control form-control-message" name="message" id="message" placeholder="" rows="10"
                required></textarea>
            </div>
            <div class="text-right"><br>
              <button class="btn btn-primary solid blank" type="submit" name="send-message">Send Message</button>
            </div>
          </div>
        </form>
      </div>

    </div><!-- Content row -->
  </div><!-- Conatiner end -->
</section><!-- Main container end -->
<?php
include("assets/footer.php");
?>
  </body>

  </html>