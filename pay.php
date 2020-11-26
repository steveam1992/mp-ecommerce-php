
 <?php
 require __DIR__ . '/vendor/autoload.php';

 // Mercado Pago Credentials
 MercadoPago\SDK::setAccessToken( "TEST-5986425512030588-112517-3bece8b99c747f9cf1af03c5295db77c-169100115" ); // On Production
 //MercadoPago\SDK::setAccessToken( "YOUR_TEST_ACCESS_TOKEN" ); // On Sandbox
 
 $file = 'logs.txt';
 
 $json_event = file_get_contents( 'php://input', true );
 $event = json_decode( $json_event );
 
 if ( isset( $event->type, $event->data->id ) ) {
     $event_type = $event->type;
     $event_id = $event->data->id;
 
     $payment = MercadoPago\Payment::find_by_id( $event_id );
 
     $current = file_get_contents( $file );
     $current .= $event_type . " recibido - ID #" . $payment->id . "\n";
 
 } else {
     $current = file_get_contents( $file );
     $current .= "Llamada directa\n";
 }
 
 file_put_contents( $file, $current );
 
 http_response_code( 200 );