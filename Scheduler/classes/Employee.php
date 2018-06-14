<?php 
    class Employee{
        private $id = null;
        private $name = null;
        private $weekly_hours = null;
        private $computer_number = null;
        private $json_info = null;

        public function __construct($data){
            $this->$id = $data['id'];
            $this->$name = $data['name'];
            $this->$weekly_hours = $data['weeklyHours'];
            $this->$computer_number = $data['computerNum'];
            $this->$json_info = json_decode($data['info']);
        }
        
        public function getID()                  { return $this->$id;  }
        public function getFullName($db = false) { return ($db ? $this->$json_info['name'] : $this->$name); }
        public function getFirstName()           { return $this->$json_info['first']; }
        public function getLastName()            { return $this->$json_info['last'];  }
        public function getPhone()               { return $this->$json_info['phone']; }
        public function getEmail()               { return $this->$json_info['email']; }
        public function getComputer()            { return $this->$computer_number;    }
        public function getBusy()                { return $this->$json_info['busy'];  }        
    }
?>