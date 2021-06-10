<?php

function loadComments()
{

    $database = new dbHelper();
    $result = $database->getAllComments();

    if (count($result) > 0) {
        echo '<ul>';
        foreach ($result as $res) {
            if ($res['parentId'] == "") {
                $hierarchy=0;
                $className="li-parent-comments";

                require ('./views/comment.php');
            }
        }
        echo '</ul>';
    } else {
        echo 'No comments';
    }
}

function createTree($parentId, $hierarchy)
{
    $hierarchy++;
    $tt = new dbHelper();
    $result = $tt->getParentComments($parentId);
    if (count($result > 0) && $hierarchy<6) {
        echo '<ul>';
        foreach ($result as $res) {
            $className="li-child-comments";
           require ('./views/comment.php');
        }
        echo '</ul>';
    }


}