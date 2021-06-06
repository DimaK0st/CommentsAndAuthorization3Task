<?php
function comments()
{
    echo '
<link href="/style/comments.css" rel="stylesheet">

<body>
<div style="margin-bottom: 10px">
                    <span id="response" style="width: 100px; height: 100px;"></span>
                </div>
<div id="container">


    <form class="mainform" name="formAddComments">

        <p class="name">
            <input type="text" name="name" value="Имя автора" placeholder="Имя автора"
                   />
            <label for="name">Имя</label>
        </p>

        <p class="msg">
            <textarea name="message" value="Текст сообщения" placeholder="Текст сообщения"></textarea>
        </p>

        <p class="send">
            <input type="submit" value="Отправить"/>
        </p>


    </form>

</div>
<script src="/script/comments.js"></script>
</body>
';

    $database= new dbHelper();
    $result= $database->getAllComments();

    if(count($result)>0){
        echo '<ul>';
        foreach ($result as $res){
            echo $res['parentId'];
            if($res['parentId']==""){
            echo '<li id="'.$res['id'].'">'. $res['author'];
            echo "<button id='btn".$res['id']."' onclick='addParentComment(".$res['id'].");'>Ответить</button>";
            echo $res['id'];
            createTree($res['id']);
            echo '</li>';}
        }
        echo '</ul>';
    }
    else{
        echo 'No comments';
    }
}

function createTree($parentId){
    $tt = new dbHelper();
    $result= $tt->getParentComments($parentId);
    if (count($result>0)){
        echo '<ul>';
        echo "huita";
        foreach ( $result as $res){
            echo '<li id="'.$res['id'].'">'. $res['author'];
            echo "<button id='btn".$res['id']."' onclick='addParentComment(".$res['id'].");'>Ответить</button>";
            createTree($res['id']);
            echo '</li>';
        }
        echo '</ul>';
    }



}