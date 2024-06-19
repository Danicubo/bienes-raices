<?php 
    require 'includes/app.php';
    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et quo doloribus, hic tempore quia temporibus eaque dolorem quaerat maiores provident tempora natus magni. Ipsum voluptate neque expedita inventore, laborum velit?</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
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
    </section>

<?php 
    incluirTemplate('footer');
?>