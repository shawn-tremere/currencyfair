<?php
require 'vendor/autoload.php';

use Src\Utill\DatabaseConnection;



$db = new DatabaseConnection();
$dbConnection = $db->getConnection();