<?php
try {
    $host = 'localhost';
    $db = 'db_comercioit';
    $username = 'labs';
    $passwd = 'Labs123@';

    $dsn = "mysql:host=$host;dbname=$db";
    $pdo = new PDO($dsn, $username, $passwd);
} catch (\Throwable $e) {
    echo $e->getMessage();
}