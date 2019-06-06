<?php
require "../../bootstrap.php";
use Src\Controller\ViewController;
use Src\Utill\ServiceHelpers;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



// Get the search pararmters and put them into an array called $parsedOutput
parse_str($_SERVER['QUERY_STRING'],$parsedOutput);
$searchCredentials = ServiceHelpers::parseOutput($parsedOutput);


// Get method of request. ie GET, PUT, DELETE, POST
$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the db connection, request method and $parsedOutput
$controller = new ViewController($dbConnection, $requestMethod, $searchCredentials);
$controller->processRequest();