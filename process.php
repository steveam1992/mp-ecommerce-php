<?php
require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

MercadoPago\SDK::setAccessToken("TEST-5986425512030588-112517-3bece8b99c747f9cf1af03c5295db77c-169100115"); // Either Production or SandBox AccessToken

$token = $_REQUEST["token"];
$method_id = $_REQUEST["payment_method_id"];
$installments = $_REQUEST["installments"];
$issuer_id = $_REQUEST["issuer_id"];
$total = floatval($_POST['unit'] * $_POST['price']);



$payment = new MercadoPago\Payment();
$payment->transaction_amount = $total;
$payment->token = $token;
$payment->description = $_POST['title'];
$payment->installments = $installments;
$payment->payment_method_id = $method_id;
$payment->issuer_id = $issuer_id;


$payment->payer = array(
    "email" => "example@gmail.com"
);
$payment->save();



//  var_dump($payment);
echo json_encode(array('id'=>$payment->id,'estatus'=>$payment->status,'status_detail'=>$payment->status_detail,'description'=>$payment->description, 'live_mode'=>$payment->live_mode, 'collector_id'=>$payment->collector_id,'payment_method_id'=>$payment->payment_method_id ));


?>