<?php

/**
 * Gets the database connection
 * @return object Connection to the database
 */

 function getDB() {
    $serverName = "tcp:" . getenv('DB_SERVER_NAME') . ",1433";
    $connectionOptions = array(
        "Database" => getenv('DB_NAME'),
        "Uid" => getenv('DB_UID'),
        "PWD" => getenv('DB_PWD')
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn) {
        return $conn;
    } else {
        die(print_r(sqlsrv_errors(), true));
    }
 }
 ?>
