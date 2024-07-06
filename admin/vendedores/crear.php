<?php
require_once '../../includes/app.php';
use App\Vendedor;

isAuth();

$vendedor = new Vendedor;
$errorres = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //crear nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);

    //validar que no haya campos vacios
    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }
}


incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <a href="../indexAdmin.php">Volver</a>
    <?php 
        foreach($errores as $error) {?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
    <?php } ?>
    <form class="formulario" method="POST" action="../vendedores/crear.php" >
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>
</main>

<?php 
incluirTemplate('footer');
?>