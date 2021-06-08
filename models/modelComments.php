<?php

function loadComments()
{

    $database = new dbHelper();
    $result = $database->getAllComments();

    if (count($result) > 0) {
        echo '<ul>';
        foreach ($result as $res) {
            if ($res['parentId'] == "") {
                echo '<li id="' . $res['id'] . '" >';
                echo '<div class="li-parent-comments">';
                echo "<p class='authot'>Пользователь: " . $res['author'] . "</p>";
                echo "<span class='date'>" . $res['date'] . "</span><br>";
                echo "<p class='message-сomment'>Комментарий: " . $res['textComment'] . "</p>";
                echo "<button id='btn" . $res['id'] . "' class='btn' onclick='addParentComment(" . $res['id'] . ");'>Ответить</button>";
                echo '</div>';
                createTree($res['id']);
                echo '</li>';
            }
        }
        echo '</ul>';
    } else {
        echo 'No comments';
    }
}

function createTree($parentId)
{
    $tt = new dbHelper();
    $result = $tt->getParentComments($parentId);
    if (count($result > 0)) {
        echo '<ul>';
        foreach ($result as $res) {
            echo '<li id="' . $res['id'] . '" >';
            echo '<div class="li-child-comments">';
            echo "<p class='authot'>Пользователь: " . $res['author'] . "</p>";
            echo "<span class='date'>" . $res['date'] . "</span><br>";
            echo "<p class='message-сomment'>Комментарий: " . $res['textComment'] . "</p>";
            echo "<button id='btn" . $res['id'] . "' class='btn' onclick='addParentComment(" . $res['id'] . ");'>Ответить</button>";
            echo '</div>';
            createTree($res['id']);
            echo '</li>';
        }
        echo '</ul>';
    }


}