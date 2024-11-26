<?php
    $dsn = 'mysql:host=localhost;dbname=Velvet&VineDB';
    $username = 'root';
    // can include a password to the db:
    // $password = '...';

    try {
        $db = new PDO($dsn, $username);
        // otherwise, if using a password:
        // $db = new PDO($dsn, $username, $password);

        // check if the connection is successful
        if ($db) {
            echo "Database connected successfully!";
        } else {
            echo "Database connection failed!";
        }
    } catch (PDOException $e) {
        $error = "Database Error: ";
        $error .= $e->getMessage();
        include('views/error/index.php');
        exit();
    }

?>
