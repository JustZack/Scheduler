<?php 
    class Workstation{
        public $computerNumber;
        public $employees;

        public $schedule_o;

        public function __construct($number, $emp = null){
            $this->computerNumber = $number;
            $this->employees = array();
            if($emp !== null) $this->employees[] = $emp;
        }
        public function schedule($open, $close){
            if(!isset($this->schedule_o)) $this->schedule_o = new Schedule($this->employees);
            $this->schedule_o->schedule($open, $close, 0);
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