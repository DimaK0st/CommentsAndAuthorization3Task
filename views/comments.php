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


    <form class="mainform" name="formAdddComments">

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
}