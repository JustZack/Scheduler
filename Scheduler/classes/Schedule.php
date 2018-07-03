<?php
    class Schedule{
        public static $minimumShift = 2;

        public $employees;
        public $schedule_times;

        public function __construct($employees_array){
            $this->employees = $employees_array;
        }
        public function schedule($open, $close, $primaryid){
            $result = array(
                array(),
                array(),
                array(),
                array(),
                array(),
                array(),
                array()
            );
            //Sets up the array to have 7 days, each with 24 entries.
            for($i = 0;$i < 7;$i++)
                for($j = 0;$j < 24;$j++)
                    $result[$i][$j] = " ";
            
            for($e = 0;$e < count($this->employees);$e++)                  //Employees
                for($d = 0;$d < count($result);$d++)                      //Days
                    for($h = 0;$h < count($result[$d]);$h++)             //Hours
                        if((int)$this->employees[$e]->free[$d][$h] == 1)//Free hours check
                            $result[$d][$h] .= $this->employees[$e]->name . " | ";

            //print_r($result);
        }
    }
?>