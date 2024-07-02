<?php 

require_once '../../includes/app.php';
$auth = isAuth();
if(!$auth){
    header('Location: /bienes-raices/login.php');
}

//validar que sea id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /bienes-raices/admin');
}

$db = conectarDB();

//consulta obtener datos para actualizar propiedad
$consulta = "SELECT * FROM propiedades WHERE id=$id";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//consulta para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);


$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedores_id'];
$imagenPropiedad = $propiedad['imagen'];
/* Arreglo con mensajes errores */
$errores = [];

/* Despues de enviar el desayuno */
if($_SERVER['REQUEST_METHOD'] === 'POST'){

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

    //validar por tamaño
    $medida = 1000 * 100;
    
    if($imagen['size'] > $medida){
        $errores[] = "La imagen es muy pesada";
    }


    if(empty($errores)){

        $carpetaImagenes = '../../imagenes/';
        if($imagen['name']) {
            //Elimina imagen previa
            unlink($carpetaImagenes . $propiedad['imangen'] );
            $nombreImagen = md5( uniqid( rand() ) . ".jpg");

            move_uploaded_file($imagen['tmp_file'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen'];
        }

        
        $query = " UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion =  '$descripcion', habitaciones = $habitaciones,
         wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedorId WHERE id = $id ";

        echo $query;
        
        $resultado = mysqli_query($db, $query);
        var_dump($resultado);
        if($resultado){
            header('Location: /bienes-raices/admin/indexAdmin.php?resultado=2');

        }else {
            echo "Error datos  insertados "; 
        }
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
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Ingrese Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Ingrese Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad ?> " class="imagen-small" alt="">

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
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer');
?>