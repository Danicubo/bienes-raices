<?php

use App\Propiedad;
use  Intervention\Image\ImageManagerStatic as  Image;

require_once '../../includes/app.php';

isAuth();

//validar que sea id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /bienes-raices/admin');
}

$db = conectarDB();

//consulta obtener datos para actualizar propiedad
$propiedad = Propiedad::find($id);

//consulta para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);


$titulo = $propiedad->titulo;

/* Arreglo con mensajes errores */
$errores = Propiedad::getErrores();

/* Despues de enviar el desayuno */
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);
    
    $errores = $propiedad->validar();

    //validacion subida de archivos
    $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

    if(empty($errores)){
        //almacenar img
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        $propiedad->guardar();
    }
}


?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="../indexAdmin.php">Volver</a>


    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
    <?php endforeach?>



    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer');
?>