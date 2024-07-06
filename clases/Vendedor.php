<?php

namespace App;

class Vendedor extends ActiveRecord 
{
    protected static $tabla = 'vendedores';
    protected static $columnas_db = ['id', 'nombre', 'apellido', 'telefono'];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? '';
        $this -> nombre = $args['nombre'] ?? '';
        $this -> apellido = $args['apellido'] ?? '';
        $this -> telefono = $args['telefono'] ?? '';
    }
    public function validar()
    {
        if (!$this-> nombre){
            self::$errores[] = "Debes de añadir un nombre";
        }
        if (!$this-> apellido){
            self::$errores[] = "Debes de añadir un apellido";
        }
        if (!$this-> telefono){
            self::$errores[] = "Debes de añadir un telefono";
        }
        if (!preg_match('/[0-9]{10} /', $this->telefono)){
            self::$errores[] = "Formato no válido";
        }
        return self::$errores;
    }
}