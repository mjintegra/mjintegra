<?php
    namespace MJIntegra\Entity;

    class Address
    {
        protected $address;
        protected $number;
        protected $district;
        protected $city;
        protected $state;
        protected $postal_code;


        public function setAddress($address)
        {
            $this->address = $address;

            return $this;
        }

        public function getAddress()
        {
            return $this->address;
        }

        public function setNumber($number)
        {
            $this->number = $number;
            return $this;
        }

        public function getNumber()
        {
            return $this->number;
        }

        public function setDistrict($district)
        {
            $this->district = $district;
            return $this;
        }

        public function getDistrict()
        {
            return $this->district;
        }

        public function setCity($city)
        {
            $this->city = $city;
            return $this;
        }

        public function getCity()
        {
            return $this->city;
        }

        public function setState($state)
        {
            $this->state = $state;
            return $this;
        }

        public function getState()
        {
            return $this->state;
        }

        public function setPostalCode($postal_code)
        {
            $this->postal_code = $postal_code;
            return $this;
        }

        public function getPostalCode()
        {
            return $this->postal_code;
        }
    }