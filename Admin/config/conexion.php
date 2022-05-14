<?php
include("config.php");
function pdo_connect_mysql() {
    try {
     return new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ';charset=utf8', DATABASE_USER, DATABASE_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
          ]);
    } catch (PDOException $exception) {
     die ('Failed to connect to database!');
    }
}

$pdo = pdo_connect_mysql();
