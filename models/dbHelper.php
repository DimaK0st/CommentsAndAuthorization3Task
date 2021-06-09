<?php

class dbHelper
{

    public $host = 'localhost';
    public $database = 'task3';
    public $user = 'root';
    public $password = 'root';
    public $tableUserData = "userdata";
    public $link;


    public function __construct()
    {

        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Ошибка " . mysqli_error($this->link));
    }

    public function shieldingHtml($namePostRequest)
    {

        return htmlentities(mysqli_real_escape_string($this->link, $_POST["'" . $namePostRequest . "'"]));
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM " . $this->tableUserData;
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            echo "Выполнение запроса прошло успешно";
        }
        if ($result) {
            $rows = mysqli_num_rows($result); // количество полученных строк

            echo "<table><tr><th>Id</th><th>UserName</th><th>Почта</th><th>Пароль</th></tr>";
            for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($result);
                echo "<tr>";
                for ($j = 0; $j < 4; ++$j) echo "<td>$row[$j]</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        }


    }

    public function checkLoginAndEmail($userName, $email)
    {
        $query = "SELECT * FROM " . $this->tableUserData . " where userName='" . $userName . "'" . " or email='" . $email . "'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            return mysqli_num_rows($result);

        }
    }

    public function addUserToDB($userName, $email, $password)
    {
        if ((int)$this->checkLoginAndEmail($userName, $email) === 0) {
            $query = "INSERT INTO " . $this->tableUserData . " (userName,email,password) VALUES('" . $userName . "', '" . $email . "', '" . $password . "')";
            $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
            if ($result) {
                echo "1";
            }
        } else {
            echo "2";
        }
    }

    public function checkUserData($login, $password)
    {

        $query = "SELECT password FROM " . $this->tableUserData . " where userName='" . $login . "'" . " or email='" . $login . "'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            $row = mysqli_fetch_array($result);
            if ($row['password'] == $password and $password !== "") {
                echo "1";
            } else {
                echo "2";
            }
        }

    }


    public function addComments($parentId, $author, $textComments, $date)
    {
        if (strlen($parentId) > 0) {
            $query = "insert into comments (parentId, author, textComment, date) values ('" . $parentId . "', '" . $author . "', '" . $textComments . "', '" . $date . "'); ";
        } else {
            $query = "insert into comments (author, textComment, date) values ('" . $author . "', '" . $textComments . "', '" . $date . "'); ";
        }
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            echo $result;
        }

    }

    public function getAllComments()
    {

        $query = "SELECT * FROM comments ORDER BY id DESC";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            return $result;
        }


    }


    public function getParentComments($parentId)
    {
        $query = "SELECT * FROM comments where parentId = '" . $parentId . "'";
        $result = mysqli_query($this->link, $query) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            return $result;
        }


    }


    public function __destruct()
    {
        mysqli_close($this->link);
    }


}