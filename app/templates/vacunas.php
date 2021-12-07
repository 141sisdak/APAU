
<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>

<?php if(isset($_GET["exito"])) :?>
<b><span style="color: red;"><?php echo "Éxito al " . $_GET["exito"] ?></span></b>
<?php endif; ?>
<!--Boton para el modal de nuevo Tratamiento-->

<span style="color: green" id="mensEliminado" hidden>Eliminado con éxito</span>

<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Vacunas</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" id="btnNuevaVacuna" data-toggle="modal" data-target="#nuevaVacuna"> + Añadir nuevo</button>
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
      <input type="text" name="busquedaVacuna" id="busquedaVacuna">
      </div>
     
    
    </div>
  </div>

<!--I - Nueva Vacuna****************************************************************************************************************************-->

<div class="modal fade" id="nuevaVacuna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nueva vacuna</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevaVacuna" id="formNuevaVacuna" name="formNuevaVacuna" method="POST">

            <div class="form-group">
                <label for="lblNombreVacuna">Nombre de la vacuna</label>
                <input type="text" class="form-control obligatorio" id="nombreVacuna" name="nombreVacuna">        
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="enviarNuevaVacuna" id="enviarNuevaVacuna">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Nueva Vacuna****************************************************************************************************************************-->

<!--I - Tabla Vacuna****************************************************************************************************************************-->
<div class="cont_tabla_resto tabla_peq">
    <table class="table" id="tablaVacunas">
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
<!--F - Tabla Vacuna****************************************************************************************************************************-->

<!--I - Modal modificacion Vacuna****************************************************************************************************************************-->

<div class="modal fade" id="modficarVacuna"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar vacuna</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modificarVacuna" id="formModVacuna" name="formModVacuna" method="POST">
     

<div class="form-group">
    <input type="text" class="form-control" id="idVacuna" name="idVacuna" hidden>        
</div>

<div class="form-group">
    <label for="lblNombreVacuna">Nombre de la vacuna</label>
    <input type="text" class="form-control modObligatorio" id="modNombreVacuna" name="modNombreVacuna">        
</div>

</form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModVacuna" name="btnEnviarModVacuna">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion Vacuna****************************************************************************************************************************-->
<br>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>