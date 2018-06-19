<?php 
    class Employee{
        public $id;
        public $name;
        public $weekly_hours;
        public $computer_number;
        public $busytimes;
        public $busy;
        public $free;
        public $timeintervals = 24;
        
        public function __construct($data){
            //$this->id = $data["id"];
            $this->name = $data["name"];
            $this->weekly_hours = $data["weeklyhours"];
            $this->computer_number = $data["workstation"];
            $this->busytimes = $data["busy"];
            $this->setFree();
        }
        
        public function getID()                  { return $this->id;  }
        public function getFullName($db = false) { return ($db ? $this->busytimes['name'] : $this->name); }
        public function getFirstName()           { return $this->busytimes['first']; }
        public function getLastName()            { return $this->busytimes['last'];  }
        public function getPhone()               { return $this->busytimes['phone']; }
        public function getEmail()               { return $this->busytimes['email']; }
        public function getComputer()            { return $this->computer_number;    }
        public function getBusy()                { return $this->busytimes['busy'];  }        
        private function setFree(){
            $this->busy = array(
                                'sun'=>array(),
                                'mon'=>array(),
                                'tue'=>array(),
                                'wed'=>array(),
                                'thu'=>array(),
                                'fri'=>array(),
                                'sat'=>array()
                                );
            //Setup each value to be set as 0 (meaning not busy)
            foreach($this->busy as $key=>$value) 
                for($i = 0;$i < $this->timeintervals;$i++)
                    $this->busy[$key][] = 0;

            //Go through each busy time 
            foreach($this->busytimes as $key=>$value){
                foreach($this->busytimes[$key] as $hours){
                    if(count($hours) == 0) continue;
                    $lowerBound = (int)substr($hours[0], 0, 2);
                    $upperBound = (int)substr($hours[1], 0, 2);

                    for($i = $lowerBound;$i < $upperBound;$i++)
                        $this->busy[$key][$i] = 1;
                }
            }

            //Get the free time by taking the inverse of the busy time.
            $this->free = $this->busy;
            foreach($this->free as $key=>$value)
                foreach($this->free[$key] as $index=>$indexvalue)
                    $this->free[$key][$index] = ($this->free[$key][$index] == 1) ? 0 : 1;
        }
    }
?>