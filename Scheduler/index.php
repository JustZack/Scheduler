<?php
    include_once "db_connect.php";
    include_once dirname(__FILE__) . "/classes/Company.php";

    //old
    /*
    $company = new Company("Colab", 8, 17);

    $stmt = $pdo_db->query('SELECT * FROM colab');
    while ($row = $stmt->fetch()){
        $company->addEmployee(new Employee($row));
    }
    $company->schedule();
    $wss = $company->getWorkStations();
    foreach($wss as $ws){
        //print_r($ws->schedule_m);
    }*/
    //end old

    $company;

    $query = "SELECT * FROM companies WHERE id=1";
    $stmt = $pdo_db->query($query);
    while($row = $stmt->fetch()){
        $company = new Company(json_decode($row['meta'], true));
        $company->addEmployees(json_decode($row['employees'], true));
    }
    $company->schedule();
    //print_r($company);

    
?>