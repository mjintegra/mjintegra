<?php
    namespace MJIntegra;

    class App
    {
        private $apiUrl = 'https://api.mjintegra.com';
        protected $authString;
        protected $grantString;

        protected $tokenData;
        protected $expiresIn;
        protected $currentTime;

        public function __construct($authString, $grantString)
        {
            if(!isset($_SESSION)){
                echo 'Inicie as sessions!';
                die;
            }

            $this->authString = $authString;
            $this->grantString = $grantString;
            

            if (!$this->hasToken()) {
                $this->generateToken();
            } elseif ($this->tokenExpired()) {
                $this->generateToken();
            }
        }

        private function setTimeExpires()
        {
            $_SESSION['createdTime'] = time();
            $_SESSION['expiresIn'] = $_SESSION['createdTime']+$this->getTokenData()['expires'];
        }

        private function getExpirationTime() {
            return $this->expiresIn;
        }

        private function getCurrentTime()
        {
            return $this->currentTime;
        }

        private function hasToken() {
            return isset($_SESSION['access_token']);
        }

        public function getTokenData() {
            if ($this->hasToken()) {
                return $_SESSION['access_token'];
            }

            return false;
        }

        public function getAccessToken(){
            $data = $this->getTokenData();

            return $data['access_token'];
        }

        private function tokenExpired()
        {
            $now = time();

            if ($now >= $this->getExpirationTime()) {
                return true;
            }

            return false;
        }

        public function sendRequest($url, $requestData = [], $headers = [], $json = 'no') {
            if (count($requestData) > 0) {
                if ($json == 'json') {
                    $requestData = json_encode($requestData);
                } else {
                    $requestData = http_build_query($requestData);
                }
            }

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);

            curl_setopt($ch,CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $requestData);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            if (count($headers) > 0) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        }

        private function generateToken()
        {
            $result = $this->sendRequest($this->apiUrl.'/auth/token', [
            ], [
                'Content-type: application/x-www-form-urlencoded',
                'Authorization:Basic '.$this->authString,
                'grant: '.$this->grantString
            ]);

            $_SESSION['access_token'] = json_decode($result, true);
            $this->tokenData = &$_SESSION['access_token'];

            $this->setTimeExpires();

            $this->currentTime = &$_SESSION['createdTime'];
            $this->expiresIn = &$_SESSION['expiresIn'];
        }


        public function boletoRequest($seller_id, $amount)
        {
            $boletoRequest = new BoletoRequest();
            $boletoRequest->setSellerId($seller_id);
            $boletoRequest->setAmount($amount);

            return $boletoRequest;
        }


        public function boletoGenerate(BoletoRequest $boletoRequest) {
            $seller_id = $boletoRequest->getSellerId();
            $amount = $boletoRequest->getAmount();
            $customer = $boletoRequest->getCustomer();
            $address = $customer->getBillingAddress();
            $boleto = $boletoRequest->getBoleto();

            $data = [];
            $data['seller_id'] = $seller_id;
            $data['amount'] = $amount;
            $data['customer'] = [
                'name' => $customer->getName(),
                'document_type' => $customer->getDocumentType(),
                'document_number' => $customer->getDocumentNumber(),
                'billing_address' => [
                    'address' => $address->getAddress(),
                    'number' => $address->getNumber(),
                    'district' => $address->getDistrict(),
                    'city' => $address->getCity(),
                    'state' => $address->getState(),
                    'postal_code' => $address->getPostalCode()
                ]
            ];


            $interest = $boleto->getInterest();
            $postExpiration = $boleto->getPostExpiration();
            $penalty = $boleto->getPenalty();
            $data['boleto'] = [
                'expiration_date' => $boleto->getExpirationDate(),
                'document_number' => $boleto->getDocumentNumber(),
                'post_expiration' => [
                    'action' => $postExpiration->getAction(),
                    'days' => $postExpiration->getDays()
                ],
                'penalty' => [
                    'date' => $penalty->getDate()
                ],
                'abatimento' => $boleto->getAbatimento()
            ];

            if (!is_null($penalty->getAmount())) {
                $data['boleto']['penalty']['amount'] = $penalty->getAmount();
            } else {
                $data['boleto']['penalty']['percentage'] = $penalty->getPercentage();
            }

            if (is_object($interest)) {
                $data['boleto']['interest'] = [
                    'type' => $interest->getType(),
                    'expiration' => $interest->getExpiration()
                ];

                if (!is_null($interest->getAmount())) {
                    $data['boleto']['interest']['amount'] = $interest->getAmount();
                } else {
                    $data['boleto']['interest']['percentage'] = $interest->getPercentage();
                }
            }

            if (count($boleto->getDiscounts()) > 0) {
                foreach ($boleto->getDiscounts() as $discount) {
                    $indice = (!is_null($discount->getAmount())) ? 'amount' : 'percentage';
                    $valor = (!is_null($discount->getAmount())) ? $discount->getAmount() : $discount->getPercentage();

                    $data['boleto']['discounts'][] = [
                        'date' => $discount->getDate(),
                        $indice => $valor
                    ];
                }
            }



            $endpoint = $this->apiUrl.'/v1/boleto/generate';
            $retorno = $this->sendRequest($endpoint, $data, [
                'Content-Type:application/json',
                'Authorization: Bearer '.$this->getAccessToken()
            ], 'json');

            echo '<pre>';
            print_r($retorno);

        }
    }