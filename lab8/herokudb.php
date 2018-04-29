<?php
function getDatabaseConnection($dbName) {
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $db = $dbName;
    $user = "b57418a11ae169";
    $pass = "86d2cbc7";
    $charset = "utf8mb4"; 
    
    // Create connection
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE     => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    // $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo = new PDO($dsn,$user,$pass,$opt);

    return $pdo; 
}

?>