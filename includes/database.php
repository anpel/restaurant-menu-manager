<?php

$user = '';
$password = '';
$db = '';

$dsn = "mysql:dbname=$db;host=localhost;charset=utf8";

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
