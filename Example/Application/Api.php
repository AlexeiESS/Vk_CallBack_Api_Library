<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if (!isset($_REQUEST)) {
return;
}
spl_autoload_register(function($class) {
	$path = str_replace('\\', '/', $class.'.php');
    if(file_exists($path)){
    	require $path;
    }
});


use CoreClass; 


$data = json_decode(file_get_contents('php://input'));
$json = file_get_contents('php://input');
$api = new CoreClass($data);
$api->LogJson($json);



?>