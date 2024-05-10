<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental  Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <a href="index.php">Запросы в бд</a>
        <a href="showtable.php">Посмотреть бд</a>
    </header>

    <h1>Rental Database</h1>

    <form action="result.php" method="post">
        <label for="query">Выберите запрос:</label>
        <select name="query" id="query">
            <option value="0" disabled selected>Выберите запрос</option>
            <option value="1">1. Вывести информацию об автомобилях конкретной модели.</option>
            <option value="2">2. Вывести информацию об автомобилях, изготовленных до.</option>
            <option value="3">3. Вывести информацию об автомобилях заданной модели, изготовленных после.</option>
            <option value="4">4. Вывести информацию об автомобиле с госномером.</option>
            <option value="5">5. Вывести информацию о прокатах в некоторый интервал времени.</option>
            <option value="6">6. Вычислить для каждого факта проката стоимость проката.</option>
            <option value="7">7. Вычислить среднюю страховую стоимость автомобиля.</option>
            <option value="8">8. Вывести минимальную и максимальную стоимость одного дня проката.</option>
        </select>
        <br>

        <?php
        include("dbconnect.php");

        // 1
        $sql_query = "SELECT model FROM CARS GROUP BY model;";
        $stmt = $db->prepare($sql_query);
        $stmt->execute();
        $cars = $stmt->fetchAll();
        ?>

        <div id="inputs"></div>

        <input type="submit" name="submit" value="submit">
    </form>

    <script>
        document.getElementById("query").addEventListener("change", function() {
            var query = this.value;
            var inputsDiv = document.getElementById("inputs");
            inputsDiv.innerHTML = "";

            if (query === "1") {
                inputsDiv.innerHTML = `
                    <label for="model">Модель автомобиля:</label>
                    <select name="model" id="model" required>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?php echo $car['model']; ?>"><?php echo $car['model']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                `;
            } else if (query === "2") {
                inputsDiv.innerHTML = `
                    <label for="max_year">Максимальный год изготовления:</label>
                    <input type="number" name="max_year" id="max_year" min="1950" max="2024" required>
                    <br>
                    <br>
                `;
            } else if (query === "3") {
                inputsDiv.innerHTML = `
                    <label for="model">Модель автомобиля:</label>
                    <select name="model" id="model" required>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?php echo $car['model']; ?>"><?php echo $car['model']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label for="min_year">Минимальный год изготовления:</label>
                    <input type="number" name="min_year" id="min_year" min="1950" max="2024" required>
                    <br>
                    <br>
                `;
            } else if (query === "4") {
                inputsDiv.innerHTML = `
                    <label for="license_plate">Госномер автомобиля:</label>
                    <input type="text" name="license_plate" id="license_plate" required>
                    <br>
                `;
            } else if (query === "5") {
                inputsDiv.innerHTML = `
                    <label for="min_date">Нижний диапазон:</label>
                    <input type="date" name="min_date" id="min_date" required>
                    <br>
                    <br>
                    <label for="max_date">Верхний диапазон:</label>
                    <input type="date" name="max_date" id="max_date" required>
                    <br>
                    <br>
                `;
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            var query = document.getElementById("query").value;
            var inputsDiv = document.getElementById("inputs");

            if (query === "1") {
                inputsDiv.innerHTML = `
                    <label for="model">Модель автомобиля:</label>
                    <select name="model" id="model" required>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?php echo $car['model']; ?>"><?php echo $car['model']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                `;
            } else if (query === "2") {
                inputsDiv.innerHTML = `
                    <label for="max_year">Максимальный год изготовления:</label>
                    <input type="number" name="max_year" id="max_year" min="1950" max="2024" required>
                    <br>
                    <br>
                `;
            } else if (query === "3") {
                inputsDiv.innerHTML = `
                    <label for="model">Модель автомобиля:</label>
                    <select name="model" id="model" required>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?php echo $car['model']; ?>"><?php echo $car['model']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label for="min_year">Минимальный год изготовления:</label>
                    <input type="number" name="min_year" id="min_year" min="1950" max="2024" required>
                    <br>
                    <br>
                `;
            } else if (query === "4") {
                inputsDiv.innerHTML = `
                    <label for="license_plate">Госномер автомобиля:</label>
                    <input type="text" name="license_plate" id="license_plate" required>
                    <br>
                `;
            } else if (query === "5") {
                inputsDiv.innerHTML = `
                    <label for="min_date">Нижний диапазон:</label>
                    <input type="date" name="min_date" id="min_date" required>
                    <br>
                    <br>
                    <label for="max_date">Верхний диапазон:</label>
                    <input type="date" name="max_date" id="max_date" required>
                    <br>
                    <br>
                `;
            }
        });
    </script>
</body>
</html>
