<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'bienes-raices', 8111);
    if(!$db) {
        echo 'Se conectó';
        exit;
    }
    return $db;
}