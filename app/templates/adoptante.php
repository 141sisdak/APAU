<?php ob_start() ?>

<?php ob_start() ?>
<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>


<div class="filtros">
  <div class='row cab-filtros'>
    <div class='col-md-3'>
       <span class="titulo-entidad">Adoptantes</span>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" data-toggle="modal" data-target="#nuevoAdoptante"> + Añadir nuevo</button>
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
      <input type="text" name="busquedaAdoptante" id="busquedaAdoptante">
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

<div class="modal fade" id="nuevoAdoptante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nuevo adoptante</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevoAdoptante" id="formNuevoAdoptante" name="formNuevoAdoptante" method="POST">

        <div class="form-group">
              <label for="lblNombreAdop">Nombre*</label>
              <input class="form-control obligatorio" type="text" name="nombreAdop" id="nombreAdop"/>
              </div>

            <div class="form-group">
              <label for="lblApellidosAdop">Apellidos*</label>
              <input class="form-control obligatorio" type="text" name="apellidosAdop" id="apellidosAdop"/>
            </div>

            <div class="form-group">
              <label for="lblTelf1">Teléfono 1</label>
              <input class="form-control" type="text" name="telf1Adop" id="telf1Adop"/>
            </div>

            <div class="form-group">              
              <label for="lblTelf2">Teléfono 2</label>
              <input class="form-control" type="text" name="telf2Adop" id="telf2Adop"/>
            </div>

            <div class="form-group">              
              <label for="lblComentarios">Comentarios</label>
              <textarea type="text" class="form-control" name="comentariosAdop" id="comentariosAdop"></textarea>
            </div>

            <div class="form-group">
              <label for="lblEmail">Email</label>
              <input class="form-control" type="text" name="emailAdop" id="emailAdop"/>
            </div>

            <div class="form-group">
              <label for="lblDireccion">Dirección</label>
              <input class="form-control" type="text" name="direccionAdop" id="direccionAdop"/>
            </div> 

            <div class="form-group">
              <label for="lblProvincia">Provincia</label>
              <input class="form-control" type="text" name="provinciaAdop" id="provinciaAdop" value="Valencia"/>
            </div> 

            <div class="form-group">
              <label for="lblLocalidad">Localidad</label>
              <select class="form-control" name="selLocalidadAdop" id="selLocalidadAdop">
                <option disabled selected value="0">Selecciona una localidad</option>
                <?php foreach($params["localidades"] as $localidad){?>

                <option value="<?php echo $localidad["id"] ?>"><?php echo $localidad["localidad"] ?></option>

                <?php
                } 
                ?>
                </select>
              </div> 

            <div class="form-group">
              <label for="lblDni">DNI</label>
              <input class="form-control" type="text" name="dniAdop" id="dniAdop"/>
            </div>

            <div class="form-group">
              <label for="lblNumMascotas">Nº mascotas</label>
              <input class="form-control" type="number" name="numMascotasAdop" id="numMascotasAdop"/>
            </div>

            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="btnNuevoAdoptante" id="btnNuevoAdoptante">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Nuevo usuario****************************************************************************************************************************-->
<br>
<!--I - Tabla usuario****************************************************************************************************************************-->
<div class="cont_tabla_resto">
    <table class="table" id="tablaAdoptante">
      <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono 1</th>
            <th>Teléfono 2</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Provincia</th>
            <th>Localidad</th>
            <th>DNI</th>
            <th>Nº mascotas</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        </tbody>

</table>
</div>
<!--F - Tabla usuario****************************************************************************************************************************-->

<!--I - Modal modificacion adoptante****************************************************************************************************************************-->

<div class="modal fade" id="modficarAdoptante"  role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Modificar adoptante</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=modAdoptante" id="formModAdoptante" name="formModAdoptante" method="POST">
     

            <div class="form-group">
                <input type="text" class="form-control" id="idAdoptante" name="idAdoptante" hidden>        
            </div>  

            <div class="form-group">
              <label for="lblNombreAdop">Nombre*</label>
              <input class="form-control obligatorioMod" type="text" name="nombreModAdop" id="nombreModAdop"/>
              </div>

            <div class="form-group">
              <label for="lblApellidosAdop">Apellidos*</label>
              <input class="form-control obligatorioMod" type="text" name="apellidosModAdop" id="apellidosModAdop"/>
            </div>

            <div class="form-group">
              <label for="lblTelf1">Teléfono 1</label>
              <input class="form-control" type="number" name="telf1ModAdop" id="telf1ModAdop"/>
            </div>

            <div class="form-group">              
              <label for="lblTelf2">Teléfono 2</label>
              <input class="form-control" type="number" name="telf2ModAdop" id="telf2ModAdop"/>
            </div>

            <div class="form-group">              
              <label for="lblComentarios">Comentarios</label>
              <textarea type="text" class="form-control" name="comentariosModAdop" id="comentariosModAdop"></textarea>
            </div>

            <div class="form-group">
              <label for="lblEmail">Email</label>
              <input class="form-control" type="text" name="emailModAdop" id="emailModAdop"/>
            </div>

            <div class="form-group">
              <label for="lblDireccion">Dirección</label>
              <input class="form-control" type="text" name="direccionModAdop" id="direccionModAdop"/>
            </div> 

            <div class="form-group">
              <label for="lblProvincia">Provnincia</label>
              <input class="form-control" type="text" name="provinciaModAdop" id="provinciaModAdop"/>
            </div> 

            <div class="form-group">
              <label for="lblLocalidad">Localidad</label>
              <select class="form-control" name="selLocalidadModAdop" id="selLocalidadModAdop">
                <option disabled selected value="0">Selecciona una localidad</option>
                <?php foreach($params["localidades"] as $localidad){?>

                <option value="<?php echo $localidad["id"] ?>"><?php echo $localidad["localidad"] ?></option>

                <?php
                } 
                ?>
                </select>
              </div> 

            <div class="form-group">
              <label for="lblDni">DNI</label>
              <input class="form-control" type="text" name="dniModAdop" id="dniModAdop"/>
            </div>

            <div class="form-group">
              <label for="lblNumMascotas">Nº mascotas</label>
              <input class="form-control" type="number" name="numMascotasModAdop" id="numMascotasModAdop"/>
            </div>


</form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarModAdop" name="btnEnviarModAdop">Modificar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal modificacion adoptante****************************************************************************************************************************-->



<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>