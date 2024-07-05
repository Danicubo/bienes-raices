<?php

require_once 'includes/app.php';

$email = "correo@correo.com";
$password = "123456";
//HASH PASSWORD
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

mysqli_query($db, $query);