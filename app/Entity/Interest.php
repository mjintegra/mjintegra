<?php
    namespace MJIntegra\Entity;

    class Interest
    {
        protected $type;
        protected $expiration;
        protected $amount;
        protected $percentage;


        public function setType($type)
        {
            $this->type = $type;
            return $this;
        }

        public function getType()
        {
            return $this->type;
        }


        public function setExpiration($expiration)
        {
            $this->expiration = $expiration;

            return $this;
        }

        public function getExpiration()
        {
            return $this->expiration;
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

        public function setPercentage($percentage)
        {
            $percentage = number_format((float)$percentage, 2, '.', '');
            $this->percentage = $percentage;
            return $this;
        }

        public function getPercentage()
        {
            return $this->percentage;
        }

    }