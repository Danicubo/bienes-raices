<?php

require_once 'app.php';
define('TEMPLATES_URL', __DIR__ .'/templates');  
define('FUNCIONES_URL', __DIR__ .'funciones.php');  
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/{$nombre}.php";
}

function isAuth(){
    session_start();
    if(!$_SESSION['login']){
        header('Location: /bienes-raices');
    }
}

function debugear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//escapa de html
function s($html):string{
    $s = htmlspecialchars($html);
    return $s;
}

//validar tipo contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor' , 'propiedad'];
    return in_array($tipo, $tipos); 
}

//muestra notificacion
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Creado Correctamente';
            break;
        case 3:
            $mensaje = 'Creado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}