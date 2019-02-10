<?php
    session_start();
    require 'vendor/autoload.php';

    $mj = new MJIntegra\App('AUTH_STRING_AQUI', 'GRANT_STRING_AQUI');

    $seller_id = 'SEU_SELLER_ID';
    $paymentId = 'PAYMENTID_DO_BOLETO_AQUI';

    $boletoRequest = new MJIntegra\BoletoRequest();
    $boletoRequest->setSellerId($seller_id)->setPaymentId($paymentId);
    $retorno = $mj->boletoDischarge($boletoRequest);

    echo '<pre>';
    var_dump(json_decode($retorno, true));