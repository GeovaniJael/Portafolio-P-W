<?php
$titulo ="Formulario";
include_once "header.php";
?>
<form action="procesa.php" method="get">
    <fieldset>
        <label for="nombre">Nombre</label>
        <input type="text" id="name" name="nombre">
    </fieldset>
    <fieldset>
        <button type = "submit">
            <i class="ph ph-paper-plane-right"></i>
            Enviar
        </button>
    </fieldset>
</form>

<?php
include_once "footer.php";
?>