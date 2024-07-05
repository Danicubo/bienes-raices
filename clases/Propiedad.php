<?php

namespace App;

class Propiedad extends ActiveRecord 
{
    protected static $tabla = 'propiedades';
    protected static $columnas_db = ['id', 'precio', 'imagen', 'descripcion', 
    'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? '';
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? '';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> habitaciones = $args['habitaciones'] ?? '';
        $this -> wc = $args['wc'] ?? '';
        $this -> estacionamiento = $args['estacionamiento'] ?? '';
        $this -> creado = date('Y/m/d');
        $this -> vendedorId = $args['vendedorId'] ?? '';
    }

        public function validar()
    {
        if (!$this-> titulo){
            self::$errores[] = "Debes de añadir un título";
        }
        if (!$this-> precio){
            self::$errores[] = "Debes de añadir un precio";
        }
        if (strlen($this-> descripcion)< 50){
            self::$errores[] = "La descripción al menos debe de tener 50 carácteres";
        }
        if (!$this-> habitaciones){
            self:: $errores[] = "Debes de añadir una habitación";
        }
        if (!$this-> wc){
            self::$errores[] = "Debes de añadir un baño";
        }
        if (!$this-> estacionamiento){
            self::$errores[] = "Debes de añadir un estacionamiento";
        }
        if (!$this-> vendedorId){
            self::$errores[] = "Debes de añadir un vendedor";
        }
        if (!$this-> imagen){
            self::$errores[] = "Debes de añadir una imagen";
        }
        return self::$errores;
    }
    
}