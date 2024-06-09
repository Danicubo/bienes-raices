<?php 

require '../../includes/config/database.php';
$db = conectarDB();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo "<pre>".
    var_dump($_POST).
    "</pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'];

    $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedoresId)
    VALUES ('$titulo', $precio, '$descripcion', $habitaciones, $wc, $estacionamiento, $vendedorId )";
    var_dump($query);
    $resultado = mysqli_query($db, $query);
    var_dump($resultado);
  
    if($resultado){
        
        echo "Datos  insertados correctamente"; 
    }else {
        echo "Error datos  insertados "; 
    }

}


require '../../includes/funciones.php';
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../indexAdmin.php">Volver</a>
    <form class="formulario" method="POST" action="../propiedades/crear.php">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Ingrese Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Ingrese Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="wc" name="estacionamiento" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="1">Juan</option>
                <option value="2">Karen</option>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer');
?>