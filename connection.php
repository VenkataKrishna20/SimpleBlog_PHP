<?php

    $env = parse_ini_file(__DIR__ . '/.env');

    define("DB_SERVER", $env["DB_SERVER"]);
    define("DB_USERNAME", $env["DB_USERNAME"]);
    define("DB_PASSWORD", $env["DB_PASSWORD"]);
    define("DB_NAME", $env["DB_NAME"]);
    
    $link = mysqli_connect(
        DB_SERVER,
        DB_USERNAME,
        DB_PASSWORD,
        DB_NAME
    );
    
    if ($link == false) {
        die("Error: could not connect to the Database. Exception: " . mysqli_connect_error());
    }

?>