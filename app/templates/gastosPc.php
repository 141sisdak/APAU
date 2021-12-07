
<?php ob_start() ?>

<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-4'>
       <span class="titulo-entidad">Gastos (Admin)</span>
    </div>
    <div class="col-md-5"></div>
    
  </div>
  <div class='row'>
    <div class='col-sm-12'>
       <hr>
    </div>
  </div>
  <div class='row lineaFiltrosTitulo'>
    <div class="col-sm-3">
      <label for="busquedaGastos" class="cab-item-filtros">Búsqueda global</label>
     <!---->
    </div>

    <div class="col-sm-3">
      <label class="cab-item-filtros">Pagado</label>
      
    </div>
       
    </div>
    <div class='row lineaFiltrosDatos'>
      <div class='col-sm-3'>
      <input type="text" name="busquedaGastosPc" id="busquedaGastosPc">
      </div>
      <div class="col-sm-3">
        <div style="display: inline;">
          <input type="checkbox" name="pagadoPc" id="chxPagadosPcSi" class="css-checkbox" value="1">
          <label for="chxPagadosPcSi" name="chxPagados" class="css-label lite-cyan-check">Si</label>
        </div>
        <div style="display: inline; margin-left:10px">
          <input type="checkbox" name="pagadoPc" id="chxPagadosPcNo" class="css-checkbox" value="0">
          <label for="chxPagadosPcNo" name="chxPagados" class="css-label lite-cyan-check">No</label>
        </div>
      </div>
    
    </div>
  </div>

<?php if(isset($_GET["exito"]) && $_GET["exito"]=="insertar") :?>
<div class="mensajeConfirmacion"><?php echo "¡Éxito al insertar!" ?></div>
<?php endif; ?>

<div class="mensajeConfirmacionAjax">
  <span> ¡Éxito al elminar el registro!</span>
  <button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
</div>


<!--I - Tabla gastos****************************************************************************************************************************-->
<div class="cont_tabla_resto">
    <table class="table" id="tablaGeneralGastosMod">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Usuario</th>
            <th>Concepto</th>
            <th>Importe (€)</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        </tbody>
       

</table>
</div>
<!--F - Tabla gastos****************************************************************************************************************************-->

<!--I - Modal modificacion gasto****************************************************************************************************************************-->

<div class="modal fade" id="modficarGasto"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar gasto</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modificarGasto" id="formModGasto" name="formModGasto" method="POST">
     

            <div class="form-group">
                <input type="text" class="form-control" id="idGastoMod" name="idGastoMod" hidden>        
            </div>

            <div class="form-group">
              <label for="lblUsu">Usuario</label>
              <select class="form-control" name="selUsu" id="selUsu">
                
                <?php foreach($params["usuarios"] as $usuario){?>

                <option value="<?php echo $usuario["id"] ?>"><?php echo $usuario["usuario"] ?></option>

                <?php
                } 
                ?>
                </select>
              </div> 

            <div class="form-group">
                <label for="lblConcepto">Concepto</label>
                <input type="text" class="form-control obligatorioMod" id="conceptoMod" name="conceptoMod">        
            </div>

            <div class="form-group">
                <label for="lblImporte">Importe</label>
                <input type="text" class="form-control obligatorioMod" id="importeMod" name="importeMod">        
            </div>

            <div class="form-group">
                <label for="lblComentario">Comentario</label>
                <textarea type="text" class="form-control" id="comentarioMod" name="comentarioMod"></textarea>
            </div>

</form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModGasto" name="btnEnviarModGasto">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion refugio****************************************************************************************************************************-->

<!--I modal mensajes-->

<div class="modal fade" id="modalMensajesGastosMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-success" id="btnOkMensaje">OK</button>
      </div>
    </div>
  </div>
</div>
<!--F modal mensajes-->
<br>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>