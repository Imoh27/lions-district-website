<?php

  $ref = $_GET['reference'];
  if (empty($ref) || $ref == "") {
    header("Location:javascript://history.go(-1)");
    }
    
  include "app/include/config.php";
  $payParam = $_GET['payParam'];
  $email = $_GET['email'];
  // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
  
  // $voterscode = substr(str_shuffle($characters),  0, 7);
  // $codemsg = 'Dear Ln '.$fullname.', Your Code is '.$voterscode;
  
  $fetch = "SELECT * FROM tbleventregister where payParam = ".$payParam;
            // echo $fetch; exit;
            $fetch_sth = mysqli_query($con, $fetch);
            $fetch_result = mysqli_fetch_array($fetch_sth);
            // echo $fetch_result['lions_id']; exit;
            if(!empty($fetch_result)){
            // $phone = $fetch_result['phone'];
            // echo $lion_phone; exit;
            }
  
  $curl = curl_init();
  // echo $ref; exit;
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/".rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_189c5b6840ab1efbd09aed7340cb4a213e21c275",
      "Cache-Control: no-cache",
    ),
  ));
  
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $result = json_decode($response);
    // echo $response; exit;
  }
  if ($result->data->status == 'success') {
    $payment_status = $result->data->status;
    $payment_ref = $result->data->reference;
    $email = $result->data->customer->email;
    // $phone = $result->data->customer->phone;

// echo $lion_phone; exit;
    
    
    $update = "UPDATE tbleventregister SET payStatus='$payment_status', paymentRef='$payment_ref' where payParam='$payParam'";
    // echo $update; exit;
    $query = $con->query($update);
if ($query) {
    // Send Text Message
       session_start();
       $_SESSION['payment_reference'] = $payment_ref;
    header("Location: https://www.lionsdistrict404a2.com/event-register-success.php?status=".$payment_status."&&reference=".$_SESSION['payment_reference']."&&payParam=".$payParam);
    exit;
  }
}else {
    header("Location: error.php");
    exit;
  }
?>

