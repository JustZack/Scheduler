<?php
    include_once "db_connect.php";
    include_once dirname(__FILE__) . "/classes/Company.php";

    $company = new Company("Colab", 8, 17);

    $stmt = $pdo_db->query('SELECT * FROM colab');
    while ($row = $stmt->fetch()){
        $company->addEmployee(new Employee($row));
    }

    function generate_employee_html($row){
        $emp = "<div class='employee'>";
        
        echo $row['id'] . "<br>";
        echo $row['name'] . "<br>";
        echo $row['computerNum'] . "<br>";
        echo $row['weeklyHours'] . "<br>";
        echo $row['info'] . "<br>";

        $emp .= "</div>";
    }
?>