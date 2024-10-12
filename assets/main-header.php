<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
================================================== -->
    <meta charset="utf-8" />
    

    <!-- Mobile Specific Metas
================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Lions District 404A2" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=5.0"
    />

    <!-- Favicon
================================================== -->
    <link rel="icon" type="image/png" href="images/favicon.png" />

    <!-- CSS
================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css" />
    <!-- Animation -->
    <link rel="stylesheet" href="plugins/animate-css/animate.css" />
    <!-- slick Carousel -->
    <link rel="stylesheet" href="plugins/slick/slick.css" />
    <link rel="stylesheet" href="plugins/slick/slick-theme.css" />
    <!-- Colorbox -->
    <link rel="stylesheet" href="plugins/colorbox/colorbox.css" />
    <!-- Template styles-->
    <link rel="stylesheet" href="css/style.css" />



    <style>
.popupDialog {
  position: fixed;
  top: 100px;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 99999;
  opacity: 0;
  -webkit-transition: opacity 4000ms ease-in-out;
  -moz-transition: opacity 4000ms ease-in-out;
  transition: opacity 4000ms ease-in-out;
  pointer-events: none;
}

.popupDialog:target {
  opacity: 1;
  pointer-events: auto;
}
.popupDialog > div {
  width: 600px;
  position: relative;
  margin: 2% auto;
  padding: 5px 20px 5px 20px;
  border-radius: 10px;
  background: #fff;
  /* background: #339999; */
  -moz-box-shadow: 1px 3px 10px #000000a2;
  -webkit-box-shadow: 1px 3px 10px #000000a2;
  box-shadow: 1px 3px 10px #000000a2;
}
.popupclose {
  background: #112e57;
  color: #FFFFFF;
  line-height: 25px;
  position: absolute;
  right: -12px;
  text-align: center;
  top: -10px;
  width: 24px;
  text-decoration: none;
  font-weight: bold;
  -webkit-border-radius: 12px;
  -moz-border-radius: 12px;
  border-radius: 12px;
  -moz-box-shadow: 1px 1px 3px #000;
  -webkit-box-shadow: 1px 1px 3px #000;
  box-shadow: 1px 1px 3px #000;
}
.popupclose:hover {
  background: #ffb600;
  color: #000
}
@media screen and (max-width: 997px){
  .popupDialog{
  overflow-y: scroll;
 
  }
  .popupDialog > div{
    height: auto !important;
    max-width: 100% !important;
  }
  .adjust-center{
    margin: 0 auto !important;
  }
}
    </style>
    <!-- <a href="#openModal">Open Modal</a> -->

