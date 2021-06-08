<?php
include('models/modelComments.php');

function comments()
{

    echo '
        <div class="tempAddClass">
        
</div>
        <form class="mainform form-add-child-comments" name="formAddChildComments" onsubmit="return false;" STYLE="display: none">
        <input id="parentId" name="parentId" class="parentId" style="display: none"></input>
        <p class="name">
            <input type="text" name="name"  placeholder="Имя автора"
                   />
        </p>

        <p class="msg">
            <textarea name="message"  placeholder="Текст сообщения"></textarea>
        </p>

        <p class="send">
            <button >Отправить</button>
        </p>


    </form>';

    echo '
<link href="/style/comments.css" rel="stylesheet">

<body onload="loadComments()">
<div style="margin-bottom: 10px">
                    <span id="response" style="width: 100px; height: 100px;"></span>
                </div>
<div id="container">


    <form class="mainform" name="formAddComments" >

        <p class="name">
            <input type="text" name="name" placeholder="Имя автора"
                   />
            <label for="name">Имя</label>
        </p>

        <p class="msg">
            <textarea name="message" placeholder="Текст сообщения"></textarea>
        </p>

        <p class="send">
            <input type="submit" value="Отправить"/>
        </p>


    </form>
    
    <div class="comments">
    
</div>

</div>
<script src="/script/comments.js"></script>
</body>
';

}
