<?php
// get the PDO library
require_once(__DIR__ . '/vendor/autoload.php');
// connect to mysql database with pdo_mysql driver
$db = new PDO('mysql:host=mysql;dbname=esapp', 'root', 'secret');
echo 'Connected to MySQL database. ';
echo 'Status: '. $db->getAttribute(PDO::ATTR_CONNECTION_STATUS).' ';
$result = $db->query('SHOW DATABASES');

echo 'Databases: ' . $result->fetchColumn();

// log the connection error
// if ($db->connect_error) {
//     die('Connect Error (' . $db->connect_errno . ') '
//     . $db->connect_error);
// }