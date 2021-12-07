<?php ob_start() ?>

<div class="container position-relative" id="error404">

    <div id="cont_text_error" class="text-center position-fixed">
        <p id="textoError">Error 404</p>
        <p id="subTextError">Página no encontrada</p>
        <img src="../web/css/imagenes/404.png" alt="" id="img404">
    </div>

</div>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>