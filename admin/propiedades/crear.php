<?php 
require_once '../../includes/app.php';
use App\Propiedad;
use  Intervention\Image\ImageManagerStatic as  Image;

isAuth();

$db = conectarDB();
//consulta para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);


$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

/* Arreglo con mensajes errores */
$errorres = Propiedad::getErrores();

/* Despues de enviar el desayuno */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $propiedad = new Propiedad($_POST);

    $titulo = mysqli_real_escape_string($db, $_POST['titulo'] );
    $precio = mysqli_real_escape_string($db, $_POST['precio'] );
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] );
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones'] );
    $wc = mysqli_real_escape_string($db, $_POST['wc'] );
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] );
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor'] );
    $creado = date('Y/m/d');
    
    //nombrar archivo
    
    $carpetaImagenes = '../../imagenes/';
    if(!is_dir($carpetaImagenes)){
        mkdir($carpetaImagenes); 
    }
    $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";
  
    if($_FILES['image']['tmp_name']){
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
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
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Ingrese Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Ingrese Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?>"</textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="wc" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedorId">
                <option value="" disabled selected>-Selecciona Vendedor-</option>
                <?php while($row = mysqli_fetch_assoc( $resultado ) ) : ?>
                    <option <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']?>"><?php echo $row['nombre'] . " " . $row['apellido'] ?></option>
                <?php endwhile?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer');
?>