<?php

function getMainPage()
{
    echo "
<style>
    *{
    text-align: center;
    }
    
    .all-task{
    width: 60%;
    margin: auto;
    }
    
    span{
    font-size: 30px;
    }
    
    button{
    font-size: 30px;
    }

</style>

    <body>
<div class='all-task'>
<div>
    <span > 1 Задание </span >
    <br>
    <button onclick = \"window.location.href = '/comments'\" >Комментарии</button >
</div >
<div >
    <span > 2 Задание </span >
    <br>
    <button onclick = \"window.location.href = '/auth'\" > Форма авторизации </button >
    <br>
    <button onclick = \"window.location.href = '/register'\" > Форма регистрации </button >

</div >
</div>
</body >
";

    }