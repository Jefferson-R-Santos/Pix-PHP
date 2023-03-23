<?php

require __DIR__. '/vendor/autoload.php';

use \app\Pix\Payload;

$obPayload = (new Payload)->setPixKey('')
                          ->setdescription('')
                          ->setmerchantName('')
                          ->setmerchantCity('')
                          ->setamount('')
                          ->settxid('');

$payloadQrCode = $obPayload->getPayload();

echo "<pre>";
print_r($payloadQrCode);
echo "<pre>";exit;

?>