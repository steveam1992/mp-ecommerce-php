<?php
require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

MercadoPago\SDK::setAccessToken("TEST-5986425512030588-112517-3bece8b99c747f9cf1af03c5295db77c-169100115"); // Either Production or SandBox AccessToken

$token = $_REQUEST["token"];
$id = $_REQUEST["id"];
$method_id = $_REQUEST["payment_method_id"];
$installments = $_REQUEST["installments"];
$issuer_id = $_REQUEST["issuer_id"];
$total = floatval($_POST['unit'] * $_POST['price']);


$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->id = $id;
$item->description = $_POST['title'];
$item->title = htmlspecialchars( $_POST["title"] );
$item->quantity = intval( $_POST["unit"] );
$item->unit_price = floatval( $_POST["price"] );
$preference->items = array( $item );



$payment = new MercadoPago\Payment();
$payment->transaction_amount = $total;
$payment->token = $token;
$payment->description = $_POST['title'];
$payment->installments = $installments;
$payment->payment_method_id = $method_id;
$payment->issuer_id = $issuer_id;
$payment->id = $id;

$payment->payer = array(
    "email" => "example@gmail.com"
);
$payment->save();


var_dump($payment);


?>