<?php 
require_once '../includes/app.php';
isAuth();

use App\Propiedad;
//importar conexion
$db = conectarDB();

//implementar metodo para obtener propiedades
$propiedades = Propiedad::all();

$resultado = $_GET['resultado'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {

        $query = "SELECT imagen FROM propiedades WHERE id = $id";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

       unlink('../imagenes'. $propiedad['imagen']);


        $query = "DELETE FROM propiedades WHERE id = $id";
        $resultado = mysqli_query($db, $query);

        if($resultado) {
            header ('Location: /bienes-raices/admin/indexAdmin.php');
        }
    }
}
incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if(intval($resultado) === 1):  ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif(intval($resultado) === 2): ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php endif ?>
    <a href="../admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $propiedades as $propiedad ): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad->imagen;?>" class="imagen-tabla"></td>
                <td><?php echo $propiedad->precio;?></td>
                <td>
                    <form action="" method="POST" style="width: 100%;">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar" />
                    </form>
                    
                    <a href="../admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-verde-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php 
mysqli_close($db);
incluirTemplate('footer');
?>