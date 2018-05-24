<?php

function call($controller, $action)
{
    // require the file that matches the controller name
    require_once 'controllers/' . $controller . '_controler.php';

    // create a new instance of the needed controller
    switch ($controller)
    {
        case 'home':
            $controller = new HomeController();
            break;
        case 'login':

            $controller = new LoginController();
            break;
    }

    // call the action
    $controller->{ $action }();
}

// just a list of the controllers we have and their actions
// we consider those "allowed" values
$controllers = array(
    'home' => ['home', 'error', 'about', 'fastaddingInfo', 'userPage', 'addBookmark', 'addFolder', 'addFast', 'addByExtension',
                'removeBookmark', 'editBookmark', 'getEditBookmarkData', 'removeFolder', 'editFolder', 'getEditFolderData', 'sort'],
    'login' => ['login', 'logout', 'register', 'reminder', 'changePassword']
);

// check that the requested controller and action are both allowed
// if someone tries to access something else he will be redirected to the error action of the home controller
if (array_key_exists($controller, $controllers))
{
    if (in_array($action, $controllers[$controller]))
    {
        call($controller, $action);
    }
    else
    {
        call('home', 'error');
    }
}
else
{
    call('home', 'error');
}
?>
