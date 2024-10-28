<?php
include_once("app/include/config.php");
// $eventID = $_GET["eid"];

if (isset($_POST["register"])) {
  $registerCategory = strip_tags($_POST["registerCategory"]);
  $event = strip_tags($_POST["event"]);
  $payParam = strip_tags($_POST["payParam"]);
  $lionsID = strip_tags($_POST["lionsID"]);
  $clubName = strip_tags($_POST["clubName"]);
  $fullname = strip_tags($_POST["fullname"]);
  $email = strip_tags($_POST["email"]);
  $phone = strip_tags($_POST["phone"]);
  $amount = strip_tags($_POST["amount"]);
  if($registerCategory == 'Lions' || $registerCategory == 'Leo'){
      $payParam = $lionsID;
  }else if($registerCategory == 'Guest'){
    $payParam = $email;
}
//   echo $event; exit;
//   echo $payParam; exit;
  

  $pay_detail = "INSERT INTO tbleventregister Values(null, $event, '$registerCategory', '$lionsID', '$clubName', '$fullname',
   '$email', '$phone', '$amount', '','', '$payParam', now())";
//   echo $pay_detail; exit;
  $pay_query = mysqli_query($con, $pay_detail);

}