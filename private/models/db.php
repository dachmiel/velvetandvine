<?php
/**
 * File Name: db.php
 * Purpose: This file connects the website database to a local MySQL server 
 * with the name 'root'. 
 * Version: 1.0
 */
function GetDatabaseConnection()
{
    $dsn = 'mysql:host=localhost;dbname=Velvet&VineDB';
    $username = 'root';
    // can include a password to the db:
    // $password = '...';

    try {
        $connection = new PDO($dsn, $username);
        // otherwise, if using a password:
        // $db = new PDO($dsn, $username, $password);

        // check if the connection is successful
        return $connection;
    } catch (PDOException $e) {
        $error = "Database Error: ";
        $error .= $e->getMessage();
        include('views/error/index.php');
        exit();
    }
}
