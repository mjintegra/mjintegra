<?php
    session_start();
    require 'vendor/autoload.php';
    //Faz o requerimento dos objetos que serão utilizados
    use MJIntegra\Entity\{
        Customer,
        Address,
        Boleto,
        Interest,
        PostExpiration,
        Penalty,
        Discount
    };


    $mj = new MJIntegra\App('AUTH_STRING_AQUI', 'GRANT_STRING_AQUI');

    $seller_id = 'SEU_SELLER_ID';
    $amount = 10.50;


    /***
    * Montagem dos dados do comprador
    */
    $customer = new Customer();

    $billingAddress = new Address();
    $billingAddress->setAddress('Rua da Tecnologia')
        ->setNumber('123')
        ->setDistrict('Fibra Optica')
        ->setCity('Ciencia')
        ->setState('TI')
        ->setPostalCode('12345678');

    $customer->setName('Fulano de Tal')
            ->setDocumentType('CPF')
            ->setDocumentNumber('55341584090')
            ->setBillingAddress($billingAddress);

    /***
    * Montagem dos dados do Boleto
    */

    $boleto = new Boleto();

    //Dados dos Juros do boleto
    $interest = new Interest();
    $interest->setType('TAXA_MENSAL')->setExpiration('25/02/2019')->setAmount(3.00);

    //Pós expiração do boleto
    $postExpiration = new PostExpiration();
    $postExpiration->setAction('DEVOLVER')->setDays(365);

    //Multa do boleto
    $penalty = new Penalty();
    $penalty->setDate('25/02/2019')->setAmount(3);


    /**Configuração dos descontos do boleto**/
    $desconto1 = new Discount();
    $desconto1->setDate('12/02/2019')->setAmount(10.00);

    $desconto2 = new Discount();
    $desconto2->setDate('15/02/2019')->setAmount(7.00);

    $desconto3 = new Discount();
    $desconto3->setDate('18/02/2019')->setAmount(5.00);

    //Populando o objeto de boleto
    $boleto->setExpirationDate('20/02/2019')
        ->setDocumentNumber('300000193')
        ->setInterest($interest)
        ->setPostExpiration($postExpiration)
        ->setPenalty($penalty)
        ->setDiscounts([$desconto1, $desconto2, $desconto3])
        ->setAbatimento('0');


    //Recebendo objeto para os Requests do Boleto
    $boletoRequest = $mj->boletoRequest($seller_id, $amount);
    $boletoRequest->setCustomer($customer)->setBoleto($boleto);

    //requisição da geração do boleto
    $retorno = $mj->boletoGenerate($boletoRequest); //saida json