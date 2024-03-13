<?php
$dbhost = 'localhost';
$dbname = 'carpool';

$username = 'root';
$userpwd = '';

try {

    $db = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname . ";charset=utf8", $username, $userpwd);

} catch (Exception $e) {

    die("Erreur :" . $e->getMessage());

}