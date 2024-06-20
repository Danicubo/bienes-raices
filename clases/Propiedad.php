<?php

namespace App;

class Propiedad {

    //Base de datos
    protected static $db;
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

    public static function setDB($database)
    {
        self::$db = $database;
    }
    

    public function __construct($args = [])
    {
        $this -> db;
        $this -> id = $args['id'] ?? '';
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? 'imagen.jpg';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> habitaciones = $args['habitaciones'] ?? '';
        $this -> wc = $args['wc'] ?? '';
        $this -> estacionamiento = $args['estacionamiento'] ?? '';
        $this -> creado = date('Y/m/d');
        $this -> vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar()
    {
        //Sanitizar datos
        $atributos = $this -> sanitizarDatos();

        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
        VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedorId' )";
        $resultado = self::$db->query($query);
    }

    public function atributos ()
    {
        $atributos = [];
        foreach (self::$columnas_db as $columna){
            if ($columna === 'id') continue;
            $atributos[$columna] = $this -> $columna;
        }
        return $atributos;
    }

    public function sanitizarDatos()
    {
        $atributos = $this -> atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }
   
}