<?php
    namespace MJIntegra\Entity;

    class Boleto
    {
        protected $expiration_date;
        protected $document_number;

        protected $interest;
        protected $post_expiration;
        protected $penalty;
        protected $discounts = [];

        protected $abatimento;



        public function setExpirationDate($date)
        {
            $this->expiration_date = $date;

            return $this;
        }

        public function getExpirationDate()
        {
            return $this->expiration_date;
        }

        public function setDocumentNumber($number)
        {
            $this->document_number = $number;
            return $this;
        }

        public function getDocumentNumber()
        {
            return $this->document_number;
        }


        public function setInterest(Interest $interest)
        {
            $this->interest = $interest;
            return $this;
        }

        public function getInterest()
        {
            return $this->interest;
        }


        public function setPostExpiration(PostExpiration $postExpiration)
        {
            $this->post_expiration = $postExpiration;
            return $this;
        }

        public function getPostExpiration()
        {
            return $this->post_expiration;
        }


        public function setPenalty(Penalty $penalty)
        {
            $this->penalty = $penalty;
            return $this;
        }


        public function getPenalty()
        {
            return $this->penalty;
        }


        public function setDiscount(Discount $discount)
        {
            $this->discounts[] = $discounts;

            return $this;
        }

        public function setDiscounts(array $discounts)
        {
            $this->discounts = $discounts;
            return $this;
        }

        public function getDiscounts()
        {
            return $this->discounts;
        }


        public function setAbatimento($abatimento) {
            $abatimento = number_format((float)$abatimento, 2, '.', '');
            $this->abatimento = $abatimento;
            return $this;
        }

        public function getAbatimento()
        {
            return $this->abatimento;
        }

    }