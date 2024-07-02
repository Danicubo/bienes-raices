<?php

namespace App;

class Propiedad {

    //Base de datos
    protected static $db;
    protected static $columnas_db = ['id', 'precio', 'imagen', 'descripcion', 
    'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    protected static $errores = [];

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
        $this -> imagen = $args['imagen'] ?? '';
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

        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        return $resultado;
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

    public static function getErrores()
    {
        return self::$errores;
    }

    public function setImagen($imagen)
    {
        if($imagen){
            $this->imagen = $imagen;
        }
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

    public static function all()
    {
        $query = "SELECT * FROM propiedades;";
        $resultado = self::$db->consultarSql($query);

        return $resultado;
    }
    public static function consultarSql($query)
    {
        $resultado = self::$db->query($query);
        $array = [];
        while($registro = $resultado -> fetch_assoc()){
            $array[] =self::crearObjeto($registro);
        }
        $resultado->free();

        return $array;
    }
    public static function crearObjeto($registro)
    {
        $objecto = new self;
        foreach($registro as $key => $value){
            if(property_exists($objecto, $key )){
                $objecto->$key = $value;
            }
        }
        return $objecto;
    }
}