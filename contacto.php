<?php 
    require 'includes/app.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contactanos</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpe" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">

            <h2>Llene el formulario de contacto</h2>
            <form class="formulario">
                <fieldset>
                    <legend>Información Personal</legend>
                    <label for="nombre">Nombre: </label>
                    <input type="text" id="nombre" placeholder="Tu nombre">

                    <label for="email">Email: </label>
                    <input type="email" id="email" placeholder="Tu email">

                    <label for="telefono">Telefono: </label>
                    <input type="tel" id="telefono" placeholder="Tu telefono">

                    <label for="mensaje">Mensaje: </label>
                    <textarea name="mensaje" id="mensaje"></textarea>
                  
                </fieldset>
                <fieldset>
                    <legend>Información Sobre la Propiedad</legend>
                    <label for="opciones">Vende o Compra: </label>
                    <select id="opciones">
                        <option value="" selected disabled>Seleccione una opción...</option>
                        <option value="Compra">Compra</option>
                        <option value="Vende">Vende</option>
                    </select>
                    <label for="presupuesto">Presupuesto: </label>
                    <input type="number" id="presupuesto" placeholder="Tu precio o presupuesto">
                </fieldset>
                <fieldset>
                    <legend>Información Sobre la Propiedad</legend>
                    <p>Cómo desea ser contactado</p>
                    <div class="forma-contacto">
                        <label for="contactar-telefono">Teléfono</label>
                        <input name="contacto" type="radio" value="Teléfono" id="contactar-telefono">

                        <label for="contactar-email">Email</label>
                        <input name="contacto" type="radio" value="Email" id="contactar-email">
                    </div>

                    <p>Si eligió teléfono, elija la fecha y hora para ser contactado</p>
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha">

                    <label for="hora">Hora: </label>
                    <input type="time" id="hora" min="09:00" max="18:00">
                </fieldset>

                <input type="submit" value="Enviar" class="boton-verde">
            </form>
        </picture>

    </main>
<?php 
    incluirTemplate('footer');
?>