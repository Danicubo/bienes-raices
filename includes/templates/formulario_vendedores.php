<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Ingrese Nombre Vendedor" value="<?php echo s($vendedor->nombre); ?>">
    <label for="nombre">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Ingrese Apellido Vendedor" value="<?php echo s($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="nombre">Teléfono Vendedor:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Ingrese Teléfono Vendedor" value="<?php echo s($vendedor->telefono);?>">
</fieldset>