
<?php ob_start() ?>




<div class="filtros">

  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Socios</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" id="btnNuevoGasto" data-toggle="modal" data-target="#nuevoSocio"> + Añadir nuevo</button>
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
      <input type="text" name="busquedaSocios" id="busquedaSocios">
      </div>
      <div class="col-sm-3">
      <select name="selPagosTabla" id="selPagosTabla">
                    <option value="0" selected disabled>Elige el tipo de pago</option>
                    <option value="Mensual">Mensual</option>
                    <option value="Trimestral">Trimestral</option>                   
                    <option value="Anual">Anual</option>
                    <option value="">Todos</option>
                </select>
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








<!--I - Nuevo socio****************************************************************************************************************************-->

<div class="modal fade" id="nuevoSocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nuevo socio</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevoSocio" id="formNuevoSocio" name="formNuevoSocio" method="POST">

            <div class="form-group">
                <label for="lblNombreSocio">Nombre(*)</label>
                <input type="text" class="form-control obligatorio" id="nombreSocio" name="nombreSocio">        
            </div>

            <div class="form-group">
                <label for="lblApellidosSocio">Apellidos</label>
                <input type="text" class="form-control " id="apellidosSocio" name="apellidosSocio">        
            </div>

            <div class="form-group">
                <label for="lblEmailSocio">Email</label>
                <input type="text" class="form-control" id="emailSocio" name="emailSocio">        
            </div>

            <div class="form-group">
                <label for="lblTelefonoSocio">Teléfono</label>
                <input type="text" class="form-control" id="telefonoSocio" name="telefonoSocio">        
            </div>

            <div class="form-group">
                <label for="lblDireccionSocio">Dirección</label>
                <input type="text" class="form-control" id="direccionSocio" name="direccionSocio">        
            </div>

            <div class="form-group">
                <label for="lblNum_cuentaSocio">Nº Cuenta</label>
                <input type="text" class="form-control" id="num_cuentaSocio" placeholder="ES00 0000 0000 0000 0000" name="num_cuentaSocio">        
            </div>

            <div class="form-group">
                <label for="lblAportacionSocio">Aportación(*)</label>
                <input type="text" class="form-control obligatorio" id="aportacionSocio" name="aportacionSocio">        
            </div>

            <div class="form-group">
                <label for="lblPagoSocio">Pago</label>
                <select name="selPago" id="selPago" class="selects_tabla_rescates obligatorio">
                    <option value="0" selected disabled>Elige el tipo de pago</option>
                    <option value="Mensual">Mensual</option>
                    <option value="Trimestral">Trimestral</option>                   
                    <option value="Anual">Anual</option>
                </select>     
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
       
        <button class="btnDialogo_Aceptar" type="button" name="enviarNuevoSocio" id="enviarNuevoSocio">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Nuevo socio****************************************************************************************************************************-->

<!--I - Tabla socio****************************************************************************************************************************-->
<div class="cont_tabla_resto">
 
    <table class="table" id="tablaSocios">
      <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Nº Cuenta</th>
            <th>Aportacion(€)</th>
            <th>Pago</th>
            <th></th>
            <th></th>
        </tr>
      </thead>
      <tbody>

      </tbody>
</table>
</div>
<!--F - Tabla socio****************************************************************************************************************************-->

<!--I - Modal modificacion socio****************************************************************************************************************************-->

<div class="modal fade" id="modificarSocio"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar socio</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modificarSocio" id="formModSocio" name="formModSocio" method="POST">
     

            <div class="form-group">
                <input type="text" class="form-control" id="idSocio" name="idSocio" hidden>        
            </div>

            <div class="form-group">
                <label for="lblNombreModSocio">Nombre</label>
                <input type="text" class="form-control obligatorioMod" id="nombreSocioMod" name="nombreSocioMod">        
            </div>

            <div class="form-group">
                <label for="lblApellidosModSocio">Apellidos</label>
                <input type="text" class="form-control " id="apellidosSocioMod" name="apellidosSocioMod">        
            </div>

            <div class="form-group">
                <label for="lblEmailModSocio">Email</label>
                <input type="text" class="form-control" id="emailSocioMod" name="emailSocioMod">        
            </div>

            <div class="form-group">
                <label for="lblTelefonoModSocio">Teléfono</label>
                <input type="text" class="form-control" id="telefonoSocioMod" name="telefonoSocioMod">        
            </div>

            <div class="form-group">
                <label for="lblDireccionModSocio">Dirección</label>
                <input type="text" class="form-control" id="direccionSocioMod" name="direccionSocioMod">        
            </div>

            <div class="form-group">
                <label for="lblNum_cuentaModSocio">Nº Cuenta</label>
                <input type="text" class="form-control" id="num_cuentaSocioMod" name="num_cuentaSocioMod">        
            </div>

            <div class="form-group">
                <label for="lblAportacionSocio">Aportación</label>
                <input type="text" class="form-control" id="aportacionSocioMod" name="aportacionSocioMod">        
            </div>

            <div class="form-group">
                <label for="lblPagoSocioMod">Pago</label>
                <select name="selPagoMod" id="selPagoMod" class="selects_tabla_rescates">
                    <option value="0" selected disabled>Elige el tipo de pago</option>
                    <option value="Mensual">Mensual</option>
                    <option value="Trimestral">Trimestral</option>                   
                    <option value="Anual">Anual</option>
                </select>     
            </div>

</form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModSocio" name="btnEnviarModSocio">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion socio****************************************************************************************************************************-->



<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>