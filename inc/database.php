<?php

try {

    $pdo = new PDO("mysql:host=localhost;dbname=harjoitusvuokraamo", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    die("ERROR: Could not connect to Database" . $e->getMessage());
}