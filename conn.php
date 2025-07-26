<?php
// Configurer les paramètres PHP
ini_set('upload_max_filesize', '4G');
ini_set('post_max_size', '4G');
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '600');

// Connexion à la base de données ou autres configurations
$db_username = 'root';
$db_password = '';
$db_name     = 'sendflix';
$db_host     = 'localhost';
$pdo = new PDO(
    "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", 
    $db_username, 
    $db_password
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES utf8mb4');
?>
