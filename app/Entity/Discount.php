<?php
    namespace MJIntegra\Entity;

    class Discount
    {
        protected $date;
        protected $amount;
        protected $percentage;

        public function setDate($date)
        {
            $this->date = $date;

            return $this;
        }

        public function getDate()
        {
            return $this->date;
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