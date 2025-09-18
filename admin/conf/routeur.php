<?php
require_once('middleware/auth_middleware.php');
authMiddleware();
$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$items = explode('/',$path);

if (empty($items[1])) {
   $controller = 'gestion';
}else{
   $controller = $items[1];
}

if (empty($items[2])) {
 $action = 'index';
}else{
 $action = $items[2];
}

require_once('controller/'.$controller.'_controller.php');
$action();
?>