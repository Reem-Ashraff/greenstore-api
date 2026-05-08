<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "123456";
const DB_DATABASE = "green_store";

$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE, 3306);
//var_dump($connection);
?>