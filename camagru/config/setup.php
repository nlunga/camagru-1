<?php
    include_once 'database.php';
    include_once 'config.php';
    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = "DROP DATABASE IF EXISTS $DB_NAME";
        $conn->exec($statement);
        $statement = "CREATE DATABASE $DB_NAME";
        $conn->exec($statement);
        echo 'done';
    }
    catch(PDOException $e){
        echo $statement . "<br>" . $e->getMessage();
    }
    try{
        $conn = new PDO($DB_DSNF, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = "CREATE TABLE users(
            user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(150) NOT NULL,
            email VARCHAR(255) NOT NULL,
            `password` VARCHAR(255)NOT NULL,
            fname VARCHAR(150) NOT NULL,
            lname VARCHAR(100) NOT NULL,
            acl TEXT,
            deleted TINYINT(4) DEFAULT 0,
            creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            token VARCHAR(150),
            verified TINYINT DEFAULT 0,
            notify TINYINT DEFAULT 1
            );";
        $conn->exec($statement);
        $hash = password_hash('admin', PASSWORD_DEFAULT);
        $statement = 'INSERT INTO users(username, email, `password`, fname, lname, token, verified, notify)
        VALUES("admin", "vesingh@student.wethinkcode.co.za", "'.$hash.'", "admin", "admin", "", 1, 1)';
        $conn->exec($statement);

        $hash = password_hash('123456', PASSWORD_DEFAULT);
        $statement = 'INSERT INTO users(username, email, `password`, fname, lname, token, verified, notify)
        VALUES("beansontoast", "vishakha108@gmail.com", "'.$hash.'", "Jono", "bob", "", 1, 1)';
        $conn->exec($statement);

        $hash = password_hash('123456', PASSWORD_DEFAULT);
        $statement = 'INSERT INTO users(username, email, `password`, fname, lname, token, verified, notify)
        VALUES("deeznutz", "godalmighty@cuvox.de", "'.$hash.'", "God", "Almighty", "", 1, 1)';
        $conn->exec($statement);


        $statement = "CREATE TABLE user_sessions(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            email VARCHAR(255),
            `session` VARCHAR(255)NOT NULL,
            user_agent VARCHAR(255) NOT NULL
            );";
        $conn->exec($statement);

        $statement = "CREATE TABLE posts(
            post_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            img LONGTEXT NOT NULL,
            creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            );";
        $conn->exec($statement);

        $statement = "CREATE TABLE comments(
            comment_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            post_id INT NOT NULL,
            FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE, 
            comment TEXT NOT NULL,
            creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            );";
        $conn->exec($statement);

        $statement = "CREATE TABLE likes(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            post_id INT NOT NULL,
            FOREIGN KEY(post_id) REFERENCES posts(post_id) ON DELETE CASCADE, 
            user_id INT NOT NULL
            );";
        $conn->exec($statement);
    }
    catch(PDOException $e){
        echo $statement."<br>".$e->getMessage();
    } 
    $conn = NULL;

    // echo '<script type="text/javascript">';
	// 		echo 'window.location.href="'.PROOT.'home";';
	// 		echo '</script>';
	// 		echo '<noscript>';
	// 		echo '<meta http-quiv="refresh" content="0;url=home" />';
	// 		echo '</noscript>';
?>
