<?php 
    class Workstation{
        public $computerNumber;
        public $employees;

        public $open;
        public $close;

        public $schedule_m;

        public function __construct($number, $open, $close, $emp = null){
            $this->computerNumber = $number;
            $this->employees = array();
            $this->open = $open;
            $this->close = $close;
            if($emp !== null) $this->employees[] = $emp;
        }
        public function schedule(){
            if(!isset($this->schedule_m)) $this->schedule_m = new Schedule($this->employees, $this->open, $this->close);
            $this->schedule_m->schedule(0);
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