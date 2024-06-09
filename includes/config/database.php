<?php

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'bienes-raices', 8111);
    if(!$db) {
        echo 'Se conectó';
        exit;
    }
    return $db;
}