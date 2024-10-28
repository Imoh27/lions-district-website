<?php
if (isset($_POST['register'])) {
  include "app/include/config.php";
  // $eventID = $_GET["eid"];

  // $_SESSION['eventID'] = strip_tags($_GET["eid"]);
  $_SESSION['email'] = strip_tags($_POST['email']);

  $registerCategory = strip_tags($_POST["registerCategory"]);
  $event = strip_tags($_POST["event"]);
  $payParam = strip_tags($_POST["payParam"]);
  $lionsID = strip_tags($_POST["lionsID"]);
  $clubName = strip_tags($_POST["clubName"]);
  $fullname = strip_tags($_POST["fullname"]);
  $email = strip_tags($_POST["email"]);
  $phone = strip_tags($_POST["phone"]);
  $amount = strip_tags($_POST["amount"]);
  
  // $registerCategory = strip_tags($_POST["registerCategory"]);
  // $event = strip_tags($_POST["event"]);
  // $lionsID = strip_tags($_POST["lionsID"]);
  // $email = strip_tags($_POST["email"]);
  // $amount = strip_tags($_POST["amount"]);
  // $phone = strip_tags($_POST["phone"]);


  
  $cat_select = "SELECT * FROM tblevents e JOIN tblcategory c ON c.catID = e.catID WHERE e.eventID = $event";
  $cat_query = mysqli_query($con, $cat_select);
  $newrow = mysqli_fetch_array($cat_query);
  
  if($registerCategory == 'Lion' || $registerCategory == 'Guest'){
    $amount = $newrow['lionsAmount'];
  }else if($registerCategory == 'Leo'){
    $amount = $newrow['leosAmount'];
  }
  
  $payParam = strip_tags($_POST["payParam"]);
  
  if($registerCategory == 'Lion' || $registerCategory == 'Leo'){
    $payParam = $lionsID;
  }else if($registerCategory == 'Guest'){
    $payParam = $email;
  }
  // echo $payParam; exit;
  
// $_SESSION['payParam'] = $payParam;
// var_dump($_SESSION['payParam']); exit;
$select = "SELECT payStatus, paymentRef FROM tbleventregister where payParam  = '" . $payParam. "'";
// echo $select; exit; 
  $sth = mysqli_query($con, $select);
  $results = mysqli_fetch_array($sth);
  // $results = $sth->fetch(PDO::FETCH_ASSOC);

  // echo $results['voterscode'].' - '.$results['payment_status'].' - '.$results['payment_ref']; exit;
  
  // $fetch = "SELECT * FROM tbleventregister where emailAddress  = ".$_SESSION['email'];
  // $fetch_sth = $con->query($fetch);
  // $fetch_result = $fetch_sth->fetch(PDO::FETCH_ASSOC);
  
  // echo $fetch_result['lions_id']; exit;
  $amount =  $amount.'00';
  
  if (empty($results)) {
    
    $curl = curl_init();
    // echo $payParam; exit;
    // $amount =  $amount;
    // echo $amount; exit;
    session_start();
    $_SESSION['email'] = $email;
    //  echo $_SESSION['phone']; exit;

    // url to go to after payment
    $callback_url = 'https://www.lionsdistrict404a2.com/callback.php?payParam='. $payParam.'&email='.$_SESSION['email'];
    // echo $callback_url; exit;
    // echo  $_SESSION['lion']; exit;
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode([
        'amount' => $amount,
        'email' => $email,
        'phone' => $phone,
        'callback_url' => $callback_url
      ]),
      CURLOPT_HTTPHEADER => [
        "authorization: Bearer sk_test_189c5b6840ab1efbd09aed7340cb4a213e21c275", //replace this with your own test key
        "content-type: application/json",
        "cache-control: no-cache"
      ],
    ));
      // echo $amount; exit;
    // var_dump(array($email, $amount, $callback_url)); exit;

    $response = curl_exec($curl);
    $err = curl_error($curl);
    // echo $response; exit;

    if ($err) {
      // there was an error contacting the Paystack API
      die('Curl returned error: ' . $err);
    }

    $tranx = json_decode($response, true);


    if ($tranx['status'] == 'success') {
      // include('assets/eventregister.php');
      $pay_detail = "INSERT INTO tbleventregister Values(null, $event, '$registerCategory', '$lionsID', '$clubName', '$fullname',
      '$email', '$phone', '$amount', '','', '$payParam', now())";
    //  echo $pay_detail; exit;
     $pay_query = mysqli_query($con, $pay_detail);
    if (!$tranx['status']) {
      // there was an error from the API
      print_r('API returned error: ' . $tranx['message']);
    }

    header('Location: ' . $tranx['data']['authorization_url']);
  } else {
    echo "<script> 
                    alert('Record exists, Proceed to login!')
                    window.location.href='index';
                </script>";
  }
}
}
