<?php 
    /*   */
    require 'includes/app.php';
    
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro dicta perspiciatis numquam ipsum mollitia possimus minima sint ut quos, id sapiente eaque iste magnam quod delectus alias repellendus, iure accusamus.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono Precio" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro dicta perspiciatis numquam ipsum mollitia possimus minima sint ut quos, id sapiente eaque iste magnam quod delectus alias repellendus, iure accusamus.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono Tiempop" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro dicta perspiciatis numquam ipsum mollitia possimus minima sint ut quos, id sapiente eaque iste magnam quod delectus alias repellendus, iure accusamus.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>
        <?php 
        $limite = 3;
        include 'includes/templates/anuncios.php'
        
        ?>
        <div class="alinear-derecha">
            <a href="anuncios.html" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuenta la Casa de Tus Sueños</h2>
        <p>Llena el formulario de contacto para que un asesor se comunique contigo</p>
        <a href="contacto.html" class="boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">
                        <img src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito por: <span>Admin</span> en el año <span>2024/05/30</span></p>
                        <p>Consejos para construir tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">
                        <img src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito por: <span>Admin</span> en el año <span>2024/05/30</span></p>
                        <p>Consejos para construir tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonio">
                <blockquote>
                    La vida es una 
                </blockquote>
                <p>- Danicubo -</p>
            </div>
        </section>
    </div>
<?php 
    incluirTemplate('footer');

?>