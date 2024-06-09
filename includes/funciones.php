<?php

require 'app.php';

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/{$nombre}.php";
}

function incluirTemplateCrud(){
    include BUILD_CSS."/app.css" ;
}