<?php
include_once __DIR__ . "/../vendor/autoload.php";
include_once __DIR__ . "/../includes/functions.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$host = $_ENV['DB_HOST'];
$database = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try{
    $conn = new PDO("mysql:host={$host}; dbname={$database}", $username, $password);
} catch(PDOException $error) {
    die("Error connecting to database. Error info: {$error}");
}