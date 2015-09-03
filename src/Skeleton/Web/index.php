<?php

ini_set('display_errors', 1);

//TODO application (ServiceLocator)
//$application['request'] = new Request()
//$application['Foo'] = new Foo()

//Constante
define("APPLICATION_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR);
define("APPLICATION_MODULE_PATH", APPLICATION_PATH . "Modules" . DIRECTORY_SEPARATOR);

require __DIR__ . '/../vendor/autoload.php';

//SimpleRender
$view = new MickaelBaudoin\SimpleRender\Render\SimpleRender();
$view->setPathLayouts(APPLICATION_PATH . "Layouts/");
$view->setPathViews(APPLICATION_MODULE_PATH . "Front/Views/");
$view->setPathViews(APPLICATION_MODULE_PATH . "Front/Views/");

//Request
$request = new MickaelBaudoin\SimplePhp\Request();

//Dispatcher
$dispatcher = new MickaelBaudoin\SimplePhp\Dispatcher($request, $view);
$dispatcher->dispatch();

?>
