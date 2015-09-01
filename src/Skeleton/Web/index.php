<?php
ini_set('display_errors', 1);

define("APPLICATION_PATH",__DIR__ . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR);
define("APPLICATION_MODULE_PATH", APPLICATION_PATH . "Module" . DIRECTORY_SEPARATOR);

require __DIR__ . '/vendor/autoload.php';

/* $simpleRender = new MickaelBaudoin\SimpleRender\Render\SimpleRender();

$simpleRender->setPathLayouts(__DIR__ . "/layouts/");
$simpleRender->setPathViews(__DIR__ . "/views/");

$simpleRender->setNameLayout("default");
$simpleRender->render("home", array('test' => 'test1', 'choubi' => 'choubi'));
*/

require __DIR__ . DIRECTORY_SEPARATOR . "Application.php";
require __DIR__ . DIRECTORY_SEPARATOR . "Request.php";
require __DIR__ . DIRECTORY_SEPARATOR . "Dispatcher.php";


$request = new Request();
$dispatcher = new Dispatcher($request);
die($dispatcher->getModuleName());

?>
