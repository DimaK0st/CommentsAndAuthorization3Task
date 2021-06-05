<?php


include('views/view.php');
include('views/authorization.php');
include('views/registration.php');
include('views/successAuthorization.php');
include('views/comments.php');
require_once ('models/dbHelper.php');


$requestUri = explode('/', stristr($_SERVER['REQUEST_URI'] . '?', '?', true));
array_shift($requestUri);
$router = array();
$router['GET'] = [
    '/\/auth/' => ['getAuthPage'],
    '/\/register/' => ['getRegisterPage'],
    '/\/successAuth/' => ['successAuthorization'],
    '/\/comments/' => ['comments'],
    '/\/dbTest/' => ['dbTest']
];
$router['POST'] = [
    '/\/post\/auth/' => ['postAuth'],
    '/\/post\/register/' => ['postRegister'],
    '/\/post\/addComments/' => ['postAddComments']
];
$router['PUT'] = [];
$router['DELETE'] = [
    '/\/test\/delete\/test\/([0-9]+)/' => ['test']
];
// echo($requestUri);
//print("/" . implode('/', $requestUri));
getRouter("/" . implode('/', $requestUri));
function getRouter($url)
{
    global $router;
    $keys = array_keys($router[$_SERVER['REQUEST_METHOD']]);

    for ($i = 0; $i < count($keys); ++$i) {
        if (preg_match($keys[$i], $url)) {
            $funcs = $router[$_SERVER['REQUEST_METHOD']][$keys[$i]];

            for ($j = 0; $j < count($funcs); ++$j)
                $funcs[$j]();

            break;
        }
    }
}

function postAuth(){

    $db=new dbHelper();
    $db->checkUserData($_POST["login"],$_POST["password"]);
}

function postRegister(){
    $db=new dbHelper();
    $db->addUserToDB($_POST["login"], $_POST["email"], $_POST["password"]);
//    echo "Email: ".$_POST["email"]." Login: ".$_POST["login"]." Password: ".$_POST["password"];
}

function postAddComments(){

    $db=new dbHelper();
    $today = date("Y-m-d H:i:s");
    $db->addUserToDB($_POST["author"], $_POST["msg"], $today);

}



