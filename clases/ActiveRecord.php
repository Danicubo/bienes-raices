<?php
namespace App;

class ActiveRecord 
{
    protected static $db;
    protected static $columnas_db = [];
    protected static $tabla = '';
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
    

    public function guardar()
    {
        if(isset($this->id)){
            $this->actualizar();
        }else {
            $this->crear();
        }
    }

    public function crear()
    {
        //Sanitizar datos
        $atributos = $this -> sanitizarDatos();
        $query = " INSERT INTO" . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        return $resultado;
    }
    public function actualizar()
    {
        //Sanitizar datos
        $atributos = $this -> sanitizarDatos();
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "$key='$value'";
        }
        $query =  "UPDATE" . static::$tabla . "SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);
        if($resultado){
            header('Location: /bienes-raices/admin/indexAdmin.php?resultado=2');
        }
    }

    public function eliminar()
    {
        $query = "DELETE FROM" . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . "LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado) {
            $this->borrarImagen();
            header ('Location: /bienes-raices/admin/indexAdmin.php');
        }
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
        //elimina imagen previa
        if(isset($this->id)){
            $this->borrarImagen();
        }
        //asigna atributo de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
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
        $query = "SELECT * FROM " .  static::$tabla;
        $resultado = self::$db->consultarSql($query);

        return $resultado;
    }
    //buscar registro por id
    public static function find($id)
    {
        //consulta obtener datos para actualizar propiedad
        $query = "SELECT * FROM". static::$tabla . " WHERE id=$id";
        $resultado = self::consultarSql($query);
        return array_shift($resultado);
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
        $objecto = new static;
        foreach($registro as $key => $value){
            if(property_exists($objecto, $key )){
                $objecto->$key = $value;
            }
        }
        return $objecto;
    }
    public function sincronizar($args = [])
    {
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}