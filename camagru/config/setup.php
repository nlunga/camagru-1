<?php
    include_once 'database.php';
    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = "DROP DATABASE IF EXISTS $DB_NAME";
        $conn->exec($statement);
        $statement = "CREATE DATABASE $DB_NAME";
        $conn->exec($statement);
        echo "done";
    }
    catch(PDOException $e){
        echo $statement . "<br>" . $e->getMessage();
    }
    try{
        $conn = new PDO($DB_DSNF, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = "CREATE TABLE users(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(150) NOT NULL,
            email VARCHAR(255) NOT NULL,
            `password` VARCHAR(255)NOT NULL,
            fname VARCHAR(150) NOT NULL,
            lname VARCHAR(100) NOT NULL,
            acl TEXT,
            deleted TINYINT(4) DEFAULT 0,
            creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            );";
        $conn->exec($statement);
        $statement = 'INSERT INTO users(username, email, `password`, fname, lname)
        VALUES("admin", "vesingh@student.wethinkcode.co.za", "$2y$10$5XxvFxngf2RzlyugwqansOK7G3mXXYd18v5kQYzbepwBaFxdC4XMK", "admin", "admin")';
        $conn->exec($statement);
        $statement = "CREATE TABLE user_sessions(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            email VARCHAR(255) NOT NULL,
            `session` VARCHAR(255)NOT NULL,
            user_agent VARCHAR(255) NOT NULL
            );";
        $conn->exec($statement);
    }
    catch(PDOException $e){
        echo $statement."<br>".$e->getMessage();
    } 
    $conn = NULL;
?>
