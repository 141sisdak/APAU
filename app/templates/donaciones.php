
<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>



<br>
<span style="color: green" id="mensEliminado" hidden>Eliminado con éxito</span>
<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Donaciones</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" id="btnNuevaDonacion" data-toggle="modal" data-target="#nuevaDonacion"> + Añadir nuevo</button>
    </div>
  </div>
  <div class='row'>
    <div class='col-sm-12'>
       <hr>
    </div>
  </div>
  <div class='row lineaFiltrosTitulo'>
    <div class="col-sm-3">
      <label for="busquedaDonaciones" class="cab-item-filtros">Búsqueda global</label>
     <!---->
    </div>

    <div class="col-sm-2 noRightPadding">
      <label class="cab-item-filtros">Filtrar por fecha:</label>
    </div>
    <div class="col-sm-2  noLeftPadding">
      <label class="lblRango">Desde</label>
    </div>
    <div class="col-sm-2">
      <label class="lblRango">Hasta</label>
    </div>
       
    </div>
    <div class='row lineaFiltrosDatos'>
      <div class='col-sm-3'>
      <input type="text" name="busquedaDonaciones" id="busquedaDonaciones">
      </div>
      <div class="col-sm-2 offset-sm-2 noLeftPadding">
        <input type="date" name="fechaDesde" id="fechaDesde">
      </div>
      <div class="col-sm-3">
        <input type="date" name="fechaHasta" id="fechaHasta">
      </div>
    
    </div>
  </div>

  <?php if(isset($_GET["exito"])) :?>
<div class="mensajeConfirmacion"><?php echo "¡Éxito al " . $_GET["exito"] . "!"?></div>
<button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
<?php endif; ?>

<div class="mensajeConfirmacionAjax">
  <span> ¡Éxito al elminar el registro!</span>
  <button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
</div>

<!--I - Tabla donacion****************************************************************************************************************************-->

<div class="cont_tabla_resto tabla_peq">

    <table class="table" id="tablaDonaciones">
      <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Importe (€)</th>
            <th>Fecha</th>
            <th></th>
            <th></th>
           
        </tr>
      </thead>
      <tbody>

      </tbody>


</table>
</div>
<!--F - Tabla donacion****************************************************************************************************************************-->

<!--I - Modal nueva donacion****************************************************************************************************************************-->

<div class="modal fade" id="nuevaDonacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="titulo-modal">Nueva donación</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevaDonacion" id="formNuevaDonacion" name="formNuevaDonacion" method="POST">

            <div class="form-group">
                <label for="lblNombre">Nombre</label>
                <input type="text" class="form-control obligatorio" id="nombre" name="nombre">        
            </div>

            <div class="form-group">
                <label for="lblApellidos">Apellidos</label>
                <input type="text" class="form-control " id="apellidos" name="apellidos">        
            </div>

            <div class="form-group">
                <label for="lblFecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha">
            </div>

            <div class="form-group">
                <label for="lblImporte">Importe</label>
                <input type="text" class="form-control obligatorio" id="importe" name="importe">
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="enviarNuevaDonacion" id="enviarNuevaDonacion">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal nueva donacion****************************************************************************************************************************-->

<!--I - Modal modificacion donacion****************************************************************************************************************************-->

<div class="modal fade" id="modificarDonacion"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="titulo-modal">Modificar donación</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modificarDonacion" id="formModDonacion" name="formModDonacion" method="POST">
     

            <div class="form-group">
                <input type="text" class="form-control" id="idDonacionMod" name="idDonacion" hidden>        
            </div>
            
            <div class="form-group">
                <label for="lblNombreModDonacion">Nombre</label>
                <input type="text" class="form-control obligatorioMod" id="nombreDonacionMod" name="nombreDonacionMod">        
            </div>

            <div class="form-group">
                <label for="lblApellidosModDonacion">Apellidos</label>
                <input type="text" class="form-control " id="apellidosDonacionMod" name="apellidosDonacionMod">        
            </div>

            <div class="form-group">
                <label for="lblFechaModDonacion">Fecha</label>
                <input type="date" class="form-control " id="fechaDonacionMod" name="fechaDonacionMod">
                     
            </div>

            <div class="form-group">
                <label for="lblImporteModDonacion">Importe</label>
                <input type="text" class="form-control obligatorioMod" id="importeDonacionMod" name="importeDonacionMod">        
            </div>

          
</form>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModDonacion" name="btnEnviarModDonacion">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion donacion****************************************************************************************************************************-->


<!--I modal mensajes-->

<div class="modal fade" id="modalMensajesDonaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Mensaje</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnOkDonaciones">OK</button>
      </div>
    </div>
  </div>
</div>
<!--F modal mensajes-->



<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>