<?php


 // 1 - Connexion à la BDD


 $connect = new PDO(
    "mysql:host=localhost;dbname=netflix_project",
    "root",
    "root",
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    )
    );

    // var_dump($connect); // Test connexion BDD

    $alert = '';

    session_start();

    require_once 'function.php';

    define('URL', 'http://localhost:8888/netflix_project/');