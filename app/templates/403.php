<?php ob_start() ?>

<div class="container position-relative" id="error403">

    <div id="cont_text_error403" class="text-center position-fixed">
        <p id="textoError403">Actualmente no tienes permisos para acceder a esta página</p>
        
        <img src="../web/css/imagenes/404.png" alt="" id="img404">
    </div>

</div>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>