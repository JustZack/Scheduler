<?php 
    include_once "Employee.php";
    include_once "Schedule.php";
    include_once "Workstation.php";
    class Company{

        public $name;
        public $open;
        public $close;
        public $hours;

        public $employees;
        public $workstations;

        public $schedules;

        public function __construct($meta){
            $this->name = $meta["name"];
            $this->open = (int)$meta["open"];
            $this->close = (int)$meta["close"];
            $this->hours = $this->close - $this->open;
            
            $this->employees = array();
            $this->workstations = array();
        }

        public function getName()           { return $this->name;           }
        public function getOpenTime()       { return $this->open;           }
        public function getCloseTime()      { return $this->close;          }
        public function getHoursOpen()      { return $this->hours;          }
        public function getEmployees()      { return $this->employees;      }
        public function getWorkstations()   { return $this->workstations;   }

        public function schedule() {
            foreach($this->workstations as $ws) $ws->schedule($this->open, $this->close);
        }

        public function addEmployees($emps){
            foreach($emps as $key=>$value) $this->addEmployee(new Employee($emps[$key]));
        }

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
            if(!isset($this->workstations)) $this->workstations = array(new Workstation($emp->getComputer(), $emp));
            else if(!$wsFound)              $this->workstations[] = new Workstation($emp->getComputer(), $emp);
            return true;
        }
    }
?>