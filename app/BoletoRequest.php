<?php
    namespace MJIntegra;

    use MJIntegra\Entity\Customer;
    use MJIntegra\Entity\Boleto;

    class BoletoRequest
    {
        protected $seller_id;
        protected $amount;
        protected $customer;
        protected $boleto;

        public function setSellerId($seller_id)
        {
            $this->seller_id = $seller_id;

            return $this;
        }
        public function getSellerId()
        {
            return $this->seller_id;
        }


        public function setAmount($amount)
        {
            $amount = number_format((float)$amount, 2, '.', '');
            $this->amount = $amount;

            return $this;
        }

        public function getAmount()
        {
            return $this->amount;
        }

        public function setCustomer(Customer $customer)
        {
            $this->customer = $customer;
            return $this;
        }

        public function getCustomer()
        {
            return $this->customer;
        }

        public function setBoleto(Boleto $boleto)
        {
            $this->boleto = $boleto;
            return $this;
        }

        public function getBoleto()
        {
            return $this->boleto;
        }

    }