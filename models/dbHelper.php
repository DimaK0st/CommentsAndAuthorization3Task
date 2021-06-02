<?php
function dbTest()
{

    $host = 'localhost'; // адрес сервера
    $database = 'task3'; // имя базы данных
    $user = 'root'; // имя пользователя
    $password = 'root'; // пароль
    $tableUserData = "userdata";

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных


// экранирования символов для mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $company = htmlentities(mysqli_real_escape_string($link, $_POST['company']));

// выполняем операции с базой данных
    $query = "SELECT * FROM " . $tableUserData;
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if ($result) {
        echo "Выполнение запроса прошло успешно";
    }


    $email = "Ivan@gmail.com";
    $userName = "Ivan228";
    $password = "qwerty123";

// создание строки запроса
    $query = "INSERT INTO " . $tableUserData . " (userName,email,password) VALUES('".$userName."', '".$email."', '".$password."')";
    echo $query;
// выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if ($result) {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }

// закрываем подключение
    mysqli_close($link);


}