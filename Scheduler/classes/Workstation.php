<?php 
    class Workstation{
        private $computerNumber = null;
        private $employees = null;

        public function __construct($number, $emp = null){
            $this->ComputerNumber = $number;
            $this->employees = array();
            if($emp !== null) $this->employees[] = $emp;
        }
        public function addEmployee($emp){
            if(isset($this->employees))
                if($emp->getComputer() !== $this->computerNumber) 
                    return false;
            
            $this->employees[] = $emp;
            return true;
        }
        public function getNumber() { return $this->computerNumber; }
    }
?>