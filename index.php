<?php

require __DIR__. '/vendor/autoload.php';

use \app\Pix\Payload;
use \Mpdf\QrCode\QrCode;
use \Mpdf\QrCode\Output;

//Instancia principal do payload do pix
$obPayload = (new Payload)->setpixKey('12345678977')
                          ->setdescription('sla doid')
                          ->setmerchantName('Jeff Santos')
                          ->setmerchantCity('Dubai')
                          ->setamount('5.00')
                          ->settxid('SIIU777');

//Codigo de Pagamento pix
$payloadQrCode = $obPayload->getPayload();
//QR Code
$obQrCode = new QrCode($payloadQrCode);
//Imagem do QR Code
$image = (new Output\Png)->output($obQrCode,400);

header('Content.Type: image/png');
echo $image; 
echo "<pre>";
print_r($payloadQrCode);
echo "<pre>";
?>
<h1>Qr Code Pix</h1>
<br>
<img src="data:image/png;base64, <?=base64_encode($image)?>">
<br>
<br>
<h2>Codigo Pix</h2> <br>
<strong><?=$payloadQrCode?></strong>