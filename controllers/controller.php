<?php

function getMainPage()
{
    require('./views/mainPage.php');
}

function getAuthPage()
{
    require('./views/authorization.php');
}


function comments()
{
    require_once ('models/modelComments.php');
    require('./views/comments.php');
}

function getRegisterPage()
{
    require ('./views/registration.php');
}

function successAuthorization()
{
    require ('./views/successAuthorization.php');
}

function postAuth()
{
    $db = new dbHelper();
    $db->checkUserData($_POST["login"], $_POST["password"]);
}

function postRegister()
{
    $db = new dbHelper();
    $db->addUserToDB($_POST["login"], $_POST["email"], $_POST["password"]);
}

function postAddComments()
{
    $db = new dbHelper();
    $today = date("Y-m-d H:i:s");
    $db->addComments($_POST["parentId"], $_POST["author"], $_POST["msg"], $today);

}