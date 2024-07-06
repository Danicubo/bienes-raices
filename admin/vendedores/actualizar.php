<?php
require_once '../../includes/app.php';
use App\Vendedor;

isAuth();
//validad que sea un id válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /bienes-raices/index.php');
}

//obtener el arreglo desde la bd
$vendedor = Vendedor::find($id);

$vendedor = new Vendedor;
$errorres = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //asignar valores
    $args = $_POST['vendedor'];
    $vendedor->sincronizar($args);

    //validacion
    $errores = $vendedor->validar();
    if(empty($errores)){
        $vendedor->guardar();
    }
}


incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="../indexAdmin.php">Volver</a>
    <?php 
        foreach($errores as $error) {?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
    <?php } ?>
    <form class="formulario" method="POST">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer');
?>