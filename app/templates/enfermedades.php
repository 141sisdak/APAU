
<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>



<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Enfermedades</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" id="btnNuevaEnfermedad" data-toggle="modal" data-target="#nuevaEnfermedad"> + Añadir nuevo</button>
    </div>
  </div>
  <div class='row'>
    <div class='col-sm-12'>
       <hr>
    </div>
  </div>
  <div class='row lineaFiltrosTitulo'>
    <div class="col-sm-3">
      <label for="busquedaUsuarios" class="cab-item-filtros">Búsqueda global</label>
    
    </div>
           
    </div>
    <div class='row lineaFiltrosDatos'>
      <div class='col-sm-3'>
      <input type="text" name="busquedaEnfermedad" id="busquedaEnfermedad">
      </div>
     
    
    </div>
  </div>

  <?php if(isset($_GET["exito"])) :?>
<div class="mensajeConfirmacion">
<span><?php echo "¡Éxito al " . $_GET["exito"] . "!"?></span>
<button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
  </div>
<?php endif; ?>

<div class="mensajeConfirmacionAjax">
  <span> ¡Éxito al elminar el registro!</span>
  <button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
</div>

<!--I - Nueva enfermedad****************************************************************************************************************************-->

<div class="modal fade" id="nuevaEnfermedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nueva enfermedad</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevaEnfermedad" id="formNuevaEnfermedad" name="formNuevaEnfermedad" method="POST">

            <div class="form-group">
                <label for="lblNombreEnfermedad">Nombre de la enfermedad</label>
                <input type="text" class="form-control obligatorio" id="nombreEnfermedad" name="nombreEnfermedad">        
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="enviarNuevaEnfermedad" id="enviarNuevaEnfermedad">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Nueva enfermedad****************************************************************************************************************************-->

<!--I - Tabla enfermedad****************************************************************************************************************************-->
<div class="cont_tabla_resto tabla_peq">
    <table class="table" id="tablaEnfermedades">
    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th></th>
            <th></th>
           
        </tr>
        </thead>
        <tbody>
        </tbody>

</table>
</div>
<!--F - Tabla enfermedad****************************************************************************************************************************-->

<!--I - Modal modificacion enfermedad****************************************************************************************************************************-->

<div class="modal fade" id="modficarEnfermedad"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar enfermedad</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modificarEnfermedad" id="formModEnfermedad" name="formModEnfermedad" method="POST">
     

<div class="form-group">
    <input type="text" class="form-control" id="idEnfermedad" name="idEnfermedad" hidden>        
</div>

<div class="form-group">
    <label for="lblNombreEnfermedad">Nombre de la enfermedad</label>
    <input type="text" class="form-control modObligatorio" id="modNombreEnfermedad" name="modNombreEnfermedad">        
</div>

</form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModEnfermedad" name="btnEnviarModEnfermedad">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion enfermedad****************************************************************************************************************************-->
<br>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>