<?php

$host = 'localhost';
$user = 'root';
$pass = 'vbn';
$dbname = 'ilam';

$DBH = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);

unset($host);
unset($user);
unset($pass);
unset($dbname);

?>