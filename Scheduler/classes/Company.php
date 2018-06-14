<?php 
    include_once "Employee.php";
    include_once "Schedule.php";
    include_once "Workstation.php";
    class Company{

        private $name = "";
        private $open = "";
        private $close = "";
        private $hours = "";

        private $employees = "";
        private $workstations = "";

        private $schedules = "";

        public function __construct($name, $open, $close){
            $this->name = $name;
            $this->open = $open;
            $this->close = $close;
            $this->hours = $close - $open;
            $this->employees = array();
            
            $this->workstations = array();
        }

        public function getName()       { return $this->$name;      }
        public function getOpenTime()   { return $this->$open;      }
        public function getCloseTime()  { return $this->$close;     }
        public function getHoursOpen()  { return $this->$hours;     }
        public function getEmployees()  { return $this->$employees; }

        public function addEmployee($emp) { 
            //Check if an employee already exists with the current ID.
            foreach($this->employees as $e)
                if($emp->getID() == $e->getID())
                    return false;
            //Add the employee if it doesnt already exist.
            if(!isset($this->employees))   $this->employees = array($emp);
            else                            $this->employees[] = $emp; 

            /* 
                At this point in the function we have the employee added to the company.
                Next, we need to add the employee to a workstation, which makes the data cleaner.
            */
            //Go through each workstation and look for the correct one.
            $wsFound = false;
            foreach($this->workstations as $ws){
                if($ws->getNumber() == $emp->getComputer()){
                    //Correct workstation was found for this employee.
                    $ws->addEmployee($emp); 
                    $wsFound = true;
                }
            }
            //Create a new workstation and add the employee to it.
            if(!isset($this->workstations))    $this->workstations = array(new Workstation($emp->getComputer(), $emp));
            else if(!$wsFound)                  $this->workstations[] = new Workstation($emp->getComputer(), $emp);
            return true;
        }
    }
?>