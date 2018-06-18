<?php
    class Schedule{
        public static $minimumShift = 2;

        public $employees;

        public $open;
        public $close;

        public $schedule_times;

        public function __construct($employees_array, $open, $close){
            $this->employees = $employees_array;
            $this->open = $open;
            $this->close = $close;
        }
        public function schedule($primaryid){
            $this->schedule_times = array();
            foreach($this->employees as $emp){
                $jsonAvailable = $emp['json_info']['busy'];
                $days = array('mon'=>false, 'tues'=>false, 'weds'=>false, 'thurs'=>false, 'fri'=>false);
                foreach($jsonAvailable as $day=>$value){
                    if(count($value) == 0) $days[$day] = false; 
                    $free = array();
                    $lastEndTime = null;
                    foreach($value as $busy){
                        //This busy time comes before the opening of the company.
                        if($busy[1] < $this->open) continue;
                    
                        if($busy[0] > $this->open) {
                            $free[] = array($this->open, $busy[0]);
                            $lastEndTime = $busy[1];
                        } else if($busy[0] == $this->open){
                            $lastEndTime = $busy[1];
                        } else if($busy[0] < $this->open && $busy[1] > $this->open){
                            $lastEndTime[0] = $busy[1];
                        }

                        } else if($busy[0] > $this->open && $busy[1] < $this->close) $free[];
                    }
                } 
                print_r($days);
                $this->schedule_times[]  
            }
        }
    }
?>