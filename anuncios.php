<?php 
    require_once 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Casa y depas en Venta</h1>

        <?php 
        $limite = 10;
        include 'includes/templates/anuncios.php'
        
        ?>
    </main>

   

 <?php 
    incluirTemplate('footer');
?>