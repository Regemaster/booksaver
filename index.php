<?php

require_once 'connection.php';

if (isset($_GET['controller']) && isset($_GET['action']))
{
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    if(isset($_GET['var']))
    {
        $var = $_GET['var'];
    }
}
else
{
    $controller = 'home';
    $action = 'home';
}

    require_once 'views/layout.php';
?>
