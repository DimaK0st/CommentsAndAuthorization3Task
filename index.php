<?php


include('controllers/controller.php');
require_once('models/dbHelper.php');
require_once('models/modelComments.php');


$requestUri = explode('/', stristr($_SERVER['REQUEST_URI'] . '?', '?', true));
array_shift($requestUri);
$router = array();
$router['GET'] = [
    '/\/auth/' => ['getAuthPage'],
    '/\/register/' => ['getRegisterPage'],
    '/\/successAuth/' => ['successAuthorization'],
    '/\/comments/' => ['comments'],
    '/\/loadComments/' => ['loadComments'],
    '/\//' => ['getMainPage']
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