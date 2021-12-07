<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>


<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Usuarios</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
     
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
      <input type="text" name="busquedaUsuarios" id="busquedaUsuarios">
      </div>
      <div class="col-sm-2 offset-sm-2 noLeftPadding">
        <input type="date" name="fechaAltaDesde" id="fechaAltaDesde">
      </div>
      <div class="col-sm-2">
        <input type="date" name="fechaAltaHasta" id="fechaAltaHasta">
      </div>
      <div class="col-sm-2">
     
      <input type="checkbox" id="cbxSinPermiso" class="css-checkbox" name="cbxSinPermiso" value='<button type="button" class="btn_icono_tabla btnPermitir">'>
      <label for="cbxSinPermiso" name="cbxSinPermiso" class="css-label lite-cyan-check">Sin permiso</label>
      
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

<!--I - Nuevo usuario****************************************************************************************************************************-->

<div class="modal fade" id="nuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nuevo usuario</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevoUsuario" id="formNuevoUsuario" name="formNuevoUsuario" method="POST">

            <div class="form-group">
                <label for="lblNombreUsuario">Nombre de usuario</label>
                <input type="text" class="form-control obligatorio" id="nombreUsuario" name="nombreUsuario">        
            </div>

            <div class="form-group">
                <label for="lblPass1">Contraseña</label>
                <input type="text" class="form-control obligatorio" id="pass1" name="pass1">        
            </div>

            <div class="form-group">
                <label for="lblPass2">Repite contraseña</label>
                <input type="text" class="form-control obligatorio" id="pass2" name="pass2">        
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Rol</label>
                <select class="form-control obligatorio" id="rolesSelect" name="rolesSelect">
                    <option value="0" selected disabled>Selecciona tipo de usuario</option>
                    <option value="1">Usuario</option>
                    <option value="2">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="lblTelf">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">        
            </div>

            <div class="form-group">
                <label for="lblEmail">Email</label>
                <input type="email" class="form-control" id="email" name="email">        
            </div>

            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="btnNuevoUsuario" id="btnNuevoUsuario">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Nuevo usuario****************************************************************************************************************************-->

<!--I - Tabla usuario****************************************************************************************************************************-->
<div class="cont_tabla_resto">
    <table class="table" id="tablaUsuarios">
      <thead>
        <tr>
            <th></th>
            <th>Usuario</th>
            <th>Permitido</th>
            <th>Rol</th>
            <th>Fecha alta</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>

</table>
</div>
<!--F - Tabla usuario****************************************************************************************************************************-->

<!--I - Modal modificacion usuario****************************************************************************************************************************-->

<div class="modal fade" id="modficarUsuario"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar usuario</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modUsuario" id="formModUsuario" name="formModUsuario" method="POST">
     

<div class="form-group">
    <input type="text" class="form-control" id="idUsuario" name="idUsuario"  hidden>        
</div>
<div class="form-group">
    <label for="lblNombreUsuario">Nombre de usuario</label>
    <input type="text" class="form-control obligatorio" id="modNombreUsuario" name="modNombreUsuario">        
</div>

<div class="form-group">
    <label for="lblRol">Rol</label>
    <select class="form-control" id="modRolesSelect" name="modRolesSelect">
        <option value="0" selected disabled>Selecciona tipo de usuario</option>
        <option value="1">Usuario</option>
        <option value="2">Admin</option>
    </select>
</div>

<div class="form-group">
    <label for="lblTelf">Teléfono</label>
    <input type="text" class="form-control" id="modTelefono" name="modTelefono">        
</div>

<div class="form-group">
    <label for="lblEmail">Email</label>
    <input type="email" class="form-control" id="modEmail" name="modEmail">        
</div>


</form>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btnDialogo_Aceptar" id="btnModUsuario" name="btnModUsuario">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion usuario****************************************************************************************************************************-->



<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>