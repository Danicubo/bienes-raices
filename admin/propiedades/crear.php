<?php 

require '../../includes/config/database.php';
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
$errores = [];

/* Despues de enviar el desayuno */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

/* echo "<pre>". var_dump($_FILES). "</pre>"; */

    $titulo = mysqli_real_escape_string($db, $_POST['titulo'] );
    $precio = mysqli_real_escape_string($db, $_POST['precio'] );
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] );
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones'] );
    $wc = mysqli_real_escape_string($db, $_POST['wc'] );
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] );
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor'] );
    $creado = date('Y/m/d');

    $imagen = $_FILES['imagen'];

    if (!$titulo){
        $errores[] = "Debes de añadir un título";
    }
    if (!$precio){
        $errores[] = "Debes de añadir un precio";
    }
    if (strlen($descripcion)< 50){
        $errores[] = "La descripción al menos debe de tener 50 carácteres";
    }
    if (!$habitaciones){
        $errores[] = "Debes de añadir una habitación";
    }
    if (!$wc){
        $errores[] = "Debes de añadir un baño";
    }
    if (!$estacionamiento){
        $errores[] = "Debes de añadir un estacionamiento";
    }
    if (!$vendedorId){
        $errores[] = "Debes de añadir un vendedor";
    }
    if (!$imagen || $imagen['error']){
        $errores[] = "Debes de añadir una imagen";
    }

    //validar por tamaño
    $medida = 1000 * 100;
    
    if($imagen['size'] > $medida){
        $errores[] = "La imagen es muy pesada";
    }


    if(empty($errores)){

        /* Subida de archivos */
        //crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes); 
        }

        //nombrar archivo
        $nombreImagen = md5( uniqid( rand() ) . ".jpg");
        //subir imagen a carpeta
        move_uploaded_file($imagen['tmp_file'], $carpetaImagenes . $nombreImagen);

      
        
        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id)
        VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId' )";
    
        
        $resultado = mysqli_query($db, $query);
        var_dump($resultado);
        if($resultado){
            header('Location: /bienes-raices/admin/indexAdmin.php?resultado=1');

        }else {
            echo "Error datos  insertados "; 
        }
    }
}
require '../../includes/funciones.php';
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
            <select name="vendedor">
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