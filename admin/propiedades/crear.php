<?php 
require_once '../../includes/app.php';
use App\Propiedad;
use  Intervention\Image\ImageManagerStatic as  Image;

isAuth();

$db = conectarDB();
$propiedad = new Propiedad;
//consulta para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

/* Arreglo con mensajes errores */
$errorres = Propiedad::getErrores();

/* Despues de enviar el desayuno */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $propiedad = new Propiedad($_POST['propiedad']);

    
    //nombrar archivo
    
    $carpetaImagenes = '../../imagenes/';
    if(!is_dir($carpetaImagenes)){
        mkdir($carpetaImagenes); 
    }
    $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";
  
    if($_FILES['image']['tmp_name']){
        $image = Image::make($_FILES['propiedad']['tmp_name']['image'])->fit(800,600);
        $propiedad -> setImagen($nombreImagen);
    }
    $errores = $propiedad->validar();
    //realiza un resize a la imagen

    if(empty($errores)){
      
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }
        //guardar imagen
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        //guardar en BD
        $resultado = $propiedad-> guardar();
        if($resultado){
            header('Location: /bienes-raices/admin/indexAdmin.php?resultado=1');
        }
    }
}

?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../indexAdmin.php">Volver</a>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
    <?php endforeach?>



    <form class="formulario" method="POST" action="../propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer');
?>