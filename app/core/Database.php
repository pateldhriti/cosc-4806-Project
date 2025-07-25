<?php

function db_connect() {
    $host = 'iqi08.h.filess.io';
    $dbname = 'COSC4806_troubleson';
    $username = 'COSC4806_troubleson';
    $password = 'fb2da03291cccfe84481c6201921ab2dffbd2000';

    try {
        return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        die("DB connection failed: " . $e->getMessage());
    }
}
