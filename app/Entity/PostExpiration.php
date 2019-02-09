<?php
    namespace MJIntegra\Entity;

    class PostExpiration
    {
        protected $action;
        protected $days;

        public function setAction($action)
        {
            $this->action = $action;
            return $this;
        }

        public function getAction()
        {
            return $this->action;
        }

        public function setDays($days){
            $this->days = $days;
            return $this;
        }

        public function getDays()
        {
            return $this->days;
        }
    }