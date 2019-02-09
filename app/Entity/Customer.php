<?php
    namespace MJIntegra\Entity;

    class Customer
    {
        protected $name;
        protected $document_type;
        protected $document_number;
        protected $billing_address;


        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function getName()
        {
            return $this->name;
        }


        public function setDocumentType($type)
        {
            $this->document_type = $type;
            return $this;
        }

        public function getDocumentType()
        {
            return $this->document_type;
        }

        public function setDocumentNumber($document_number)
        {
            $this->document_number = $document_number;
            return $this;
        }

        public function getDocumentNumber()
        {
            return $this->document_number;
        }


        public function setBillingAddress(Address $address)
        {
            $this->billing_address = $address;
            return $this;
        }

        public function getBillingAddress(){
            return $this->billing_address;
        }
    }