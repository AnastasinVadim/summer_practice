<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .maincontent {
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
        header {
            background-color: #289799;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        header a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        header a:hover {
            background-color: #096b6c;
        }

    </style>
</head>
<body>
    <header>
        <a href="index.php">Запросы в бд</a>
        <a href="showtable.php">Посмотреть бд</a>
    </header>
    <div class="maincontent">
<?php

include("dbconnect.php");

$query = $_POST['query'];

if ($query === "1") {
   
    $model = $_POST['model'];
    
    $sql_query = "SELECT * FROM CARS WHERE model = ?";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$model]);
    
    $result = $stmt->fetchAll();
    
    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель</th>";
        echo "<th>Год изготовления</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>Цена 1 дня проката</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['car_id'] . "</th>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['license_plate'] . "</th>";
            echo "<td>" . $row['insurance_value'] . "</td>";
            echo "<td>" . $row['rental_cost'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }
    
} elseif ($query === "2") {

    $max_year = $_POST['max_year'];
    
    $sql_query = "SELECT * FROM CARS WHERE year < ?";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$max_year]);

    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель</th>";
        echo "<th>Год изготовления</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>Цена 1 дня проката</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['car_id'] . "</th>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['license_plate'] . "</th>";
            echo "<td>" . $row['insurance_value'] . "</td>";
            echo "<td>" . $row['rental_cost'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }

} elseif ($query === "3") {
    
    $model = $_POST['model'];
    $min_year = $_POST['min_year'];
    
    $sql_query = "SELECT * FROM CARS WHERE model = ? AND year >= ?";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$model, $min_year]);

    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель</th>";
        echo "<th>Год изготовления</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>Цена 1 дня проката</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['car_id'] . "</th>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['license_plate'] . "</th>";
            echo "<td>" . $row['insurance_value'] . "</td>";
            echo "<td>" . $row['rental_cost'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }

} elseif ($query === "4") {
    
    $license_plate = $_POST['license_plate'];
    
    $sql_query = "SELECT * FROM CARS WHERE license_plate = ?";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$license_plate]);

    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель</th>";
        echo "<th>Год изготовления</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>Цена 1 дня проката</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['car_id'] . "</th>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['license_plate'] . "</th>";
            echo "<td>" . $row['insurance_value'] . "</td>";
            echo "<td>" . $row['rental_cost'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }

} elseif ($query === "5") {
    
    $min_date = $_POST['min_date'];
    $max_date = $_POST['max_date'];
    
    $sql_query = "SELECT
        c.full_name, cr.model, cr.license_plate, r.start_date
            FROM RENTALS r
            JOIN CLIENTS c ON r.client_id = c.client_id
            JOIN CARS cr ON r.car_id = cr.car_id
            WHERE r.start_date BETWEEN ? AND ?

        ";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$min_date, $max_date]);

    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ФИО клиента</th>";
        echo "<th>Модель автомобиля</th>";
        echo "<th>Госномер</th>";
        echo "<th>Дата начала проката</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['license_plate'] . "</td>";
            echo "<td>" . $row['start_date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {    
        echo "Ничего не найдено.";
    }

} elseif ($query === "6") {

    $sql_query = "SELECT 
        cr.license_plate, cr.model, r.start_date, 
        cr.rental_cost, r.rental_days, 
        (cr.rental_cost * r.rental_days) AS total_cost
    FROM RENTALS r
    JOIN CARS cr ON r.car_id = cr.car_id;
    ";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>Госномер автомобиля</th>";
    echo "<th>Модель</th>";
    echo "<th>Дата начала проката</th>";
    echo "<th>Стоимость одного дня проката</th>";
    echo "<th>Количество дней проката</th>";
    echo "<th>Стоимость проката</th>";
    echo "</tr>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['license_plate'] . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['start_date'] . "</td>";
        echo "<td>" . $row['rental_cost'] . "</td>";
        echo "<td>" . $row['rental_days'] . "</td>";
        echo "<td>" . $row['total_cost'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    
} elseif ($query === "7") {

    $sql_query = "SELECT 
        model, AVG(insurance_value) AS average_insurance_value
        FROM CARS
        GROUP BY model;
    ";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();

    $result = $stmt->fetchAll();

    echo "<table>";
    echo "<tr>";
    echo "<th>Модель автомобиля</th>";
    echo "<th>Средняя страховая стоимость</th>";
    echo "</tr>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['average_insurance_value'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} elseif ($query === "8") {
    
    $sql_query = "SELECT
        year, MIN(rental_cost) AS min_rental_cost, 
            MAX(rental_cost) AS max_rental_cost
        FROM CARS
        GROUP BY year;
    ";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();

    $result = $stmt->fetchAll();

    echo "<table>";
    echo "<tr>";
    echo "<th>Год выпуска автомобиля</th>";
    echo "<th>Минимальная стоимость 1 дня проката</th>";
    echo "<th>Максимальная стоимость 1 дня проката</th>";
    echo "</tr>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['min_rental_cost'] . "</td>";
        echo "<td>" . $row['max_rental_cost'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>
</div>
</body>
</html>