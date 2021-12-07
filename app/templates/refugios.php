
<?php ob_start() ?>



<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Refugios</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" id="btnNuevoRefugio" data-toggle="modal" data-target="#nuevoRefugio"> + Añadir nuevo</button>
    </div>
  </div>
  <div class='row'>
    <div class='col-sm-12'>
       <hr>
    </div>
  </div>
  <div class='row lineaFiltrosTitulo'>
    <div class="col-sm-3">
      <label for="busquedaRefugio" class="cab-item-filtros">Búsqueda global</label>
    
    </div>
           
    </div>
    <div class='row lineaFiltrosDatos'>
      <div class='col-sm-3'>
      <input type="text" name="busquedaRefugio" id="busquedaRefugio">
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


<!--I - Nuevo refugio****************************************************************************************************************************-->

<div class="modal fade" id="nuevoRefugio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nuevo refugio</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevoRefugio" id="formNuevoRefugio" name="formNuevoRefugio" method="POST">

            <div class="form-group">
                <label for="lblNombreRefugio">Nombre del refugio</label>
                <input type="text" class="form-control obligatorio" id="nombreRefugio" name="nombreRefugio">        
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="enviarNuevoRefugio" id="enviarNuevoRefugio">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Nuevo refugio****************************************************************************************************************************-->

<!--I - Tabla refugio****************************************************************************************************************************-->
<div class="cont_tabla_resto tabla_peq">
    <table class="table" id="tablaRefugios">
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
<!--F - Tabla refugio****************************************************************************************************************************-->

<!--I - Modal modificacion refugio****************************************************************************************************************************-->

<div class="modal fade" id="modficarRefugio"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar refugio</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modificarRefugio" id="formModRefugio" name="formModRefugio" method="POST">
     

<div class="form-group">
    <input type="text" class="form-control" id="idRefugio" name="idRefugio" hidden>        
</div>

<div class="form-group">
    <label for="lblNombreTratamiento">Nombre del refugio</label>
    <input type="text" class="form-control modObligatorio" id="modNombreRefugio" name="modNombreRefugio">        
</div>

</form>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModRefugio" name="btnEnviarModRefugio">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion refugio****************************************************************************************************************************-->
<br>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>