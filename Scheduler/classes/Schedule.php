<?php
    class Schedule{
        public static $minimumShift = 2;

        public $employees;
        public $schedule_times;

        public function __construct($employees_array){
            $this->employees = $employees_array;
        }
        public function schedule($open, $close, $primaryid){
            $result = $this->employees[0]->free;
            for($i = 1;$i < count($this->employees);$i++)
                for($j = 0;$j < count($this->employees[$i]->free);$j++)
                    $result[$j] = (int)$result[$j] xor (int)$this->employees[$i]->free[$j];
            print_r($result);
        }
    }
?>