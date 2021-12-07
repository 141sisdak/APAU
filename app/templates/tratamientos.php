
<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>

<?php if(isset($_GET["exito"])) :?>
<b><span style="color: red;"><?php echo "Éxito al " . $_GET["exito"] ?></span></b>
<?php endif; ?>

<span style="color: green" id="mensEliminado" hidden>Eliminado con éxito</span>

<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Tratamientos</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" id="btnNuevoTratamiento" data-toggle="modal" data-target="#nuevoTratamiento"> + Añadir nuevo</button>
    </div>
  </div>
  <div class='row'>
    <div class='col-sm-12'>
       <hr>
    </div>
  </div>
  <div class='row lineaFiltrosTitulo'>
    <div class="col-sm-3">
      <label for="busquedaTratamiento" class="cab-item-filtros">Búsqueda global</label>
    
    </div>
           
    </div>
    <div class='row lineaFiltrosDatos'>
      <div class='col-sm-3'>
      <input type="text" name="busquedaTratamiento" id="busquedaTratamiento">
      </div>
     
    
    </div>
  </div>

<!--I - Nuevo tratamiento****************************************************************************************************************************-->

<div class="modal fade" id="nuevoTratamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nuevo tratamiento</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevoTratamiento" id="formNuevoTratamiento" name="formNuevoTratamiento" method="POST">

            <div class="form-group">
                <label for="lblNombreTratamiento">Nombre del tratamiento</label>
                <input type="text" class="form-control obligatorio" id="nombreTratamiento" name="nombreTratamiento">        
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="enviarNuevoTratamiento" id="enviarNuevoTratamiento">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Nuevo Tratamiento****************************************************************************************************************************-->

<!--I - Tabla Tratamiento****************************************************************************************************************************-->
<div class="cont_tabla_resto tabla_peq">
    <table class="table" id="tablaTratamientos">
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
<!--F - Tabla Tratamiento****************************************************************************************************************************-->

<!--I - Modal modificacion Tratamiento****************************************************************************************************************************-->

<div class="modal fade" id="modficarTratamiento"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar tratamiento</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modificarTratamiento" id="formModTratamiento" name="formModTratamiento" method="POST">
     

<div class="form-group">
    <input type="text" class="form-control" id="idTratamiento" name="idTratamiento" hidden>        
</div>

<div class="form-group">
    <label for="lblNombreTratamiento">Nombre del tratamiento</label>
    <input type="text" class="form-control modObligatorio" id="modNombreTratamiento" name="modNombreTratamiento">        
</div>

</form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModTratamiento" name="btnEnviarModTratamiento">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion tratamiento****************************************************************************************************************************-->
<br>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>