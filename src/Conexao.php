<?php

session_start();
$conn;
try {
    $conn = new PDO("mysql:dbname=trabalho_final;host=localhost", "root", "");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
