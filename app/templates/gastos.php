
<?php ob_start() ?>



<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Gastos</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" id="btnNuevoGasto" data-toggle="modal" data-target="#nuevoGasto"> + Añadir nuevo</button>
    </div>
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
      <input type="text" name="busquedaGastos" id="busquedaGastos">
      </div>
      <div class="col-sm-3">
        <div style="display: inline;">
          <input type="checkbox" name="pagado" id="chxPagadosSi" class="css-checkbox" value="1">
          <label for="chxPagadosSi" name="chxPagados" class="css-label lite-cyan-check">Si</label>
        </div>
        <div style="display: inline; margin-left:10px">
          <input type="checkbox" name="pagado" id="chxPagadosNo" class="css-checkbox" value="0">
          <label for="chxPagadosNo" name="chxPagados" class="css-label lite-cyan-check">No</label>
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
    <table class="table" id="tablaGeneralGastos">
      <thead>
        <tr>
            <th></th>
            <th>id</th>
            <th>Usuario</th>
            <th>Concepto</th>
            <th>Importe (€)</th>
            <th></th>
            <th></th>
        </tr>
      </thead>
      <tbody>

      </tbody>

</table>
</div>
<!--F - Tabla gastos****************************************************************************************************************************-->

<!--I - Modal nuevo gasto****************************************************************************************************************************-->

<div class="modal fade" id="nuevoGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nuevo gasto</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevoGasto" id="formNuevoGasto" name="formNuevoGasto" method="POST">

            <div class="form-group">
                <label for="lblConcepto">Concepto(*)</label>
                <input type="text" class="form-control obligatorio" id="concepto" name="concepto">        
            </div>

            <div class="form-group">
                <label for="lblImporte">Importe(*)</label>
                <input type="text" class="form-control obligatorio" id="importe" name="importe">        
            </div>

            <div class="form-group">
                <label for="lblComentario">Comentario</label>
                <textarea type="text" class="form-control" id="comentario" name="comentario"></textarea>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
       
        <button class="btnDialogo_Aceptar" type="button" name="enviarNuevoGasto" id="enviarNuevoGasto">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal nuevo gasto****************************************************************************************************************************-->

<!--I modal comentarios-->

<div class="modal fade" id="verComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Comentario</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--F modal comentarios-->

<!--I modal mensajes-->

<div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Mensaje</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="cab-item-filtros">¡Gasto saldado!</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btnOkMensaje">OK</button>
      </div>
    </div>
  </div>
</div>
<!--F modal mensajes-->

<div class="filtros" style="margin-top: 50px;">
  <div class="row cab-filtros">
    <span class="titulo-entidad">Acumulado (Por usuario)</span>
  </div>
</div>

<div class="cont_tabla_resto">
    <table class="table" id="tablaGastosUsuario">
      <thead>
        <tr>
        <th>Usuario</th>
        <th>Total gastos sin pagar (€)</th>
        </tr>
      </thead>
      <tbody>
       
<?php 
if(isset($params["gastosUsuario"])){
    foreach($params["gastosUsuario"] as $gastoUsu){
        ?>

        <tr>
          
            <td ><?php echo $gastoUsu["usu"] ?> </td>            
            <td ><?php echo $gastoUsu["importe"] ?> </td>
           
        </tr>
        
<?php          
    }
}
?>
</tbody>
</table>
</div>






<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>