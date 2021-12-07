<?php ob_start() ?>

<?php
if(isset($validacion->mensaje)){
    if (is_object ($validacion)){
        foreach ($validacion->mensaje as $errores) {
            foreach ($errores as $error)?>
            <b><span style="color: red;"><?php echo $error?></span></b><br>
            <?php 
    }}
    
}
?>

<!--****************************************************INICIO MODAL***********************************************************-->
<!--***************************************************************************************************************-->
<!--***************************************************************************************************************-->


<div class="modal fade" id="nuevoRescate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="titulo-modal">Nuevo rescate</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">
        <form name="formNuevoRescate" enctype="multipart/form-data" action="index.php?ctl=nuevoRescate" method="post" id="formNuevoRescate">

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nNombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="nNombre" name="nNombre">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nFechaNac" class="col-form-label">Fecha nacimiento:</label>
              <input type="date" class="form-control" id="nFechaNac" name="nFechaNac">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nFechaIng" class="col-form-label">Fecha ingreso:</label>
              <input type="date" class="form-control" id="nFechaIng" name="nFechaIng">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nUlt_desp" class="col-form-label">Ult. desp:</label>
              <input type="date" class="form-control" id="nUlt_desp" name="nUlt_desp">
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nSelEnferemedades" class="col-form-label">Enfermedades:</label><br>
              <select name="nSelEnfermedades[]" id="nSelEnferemedades" multiple>
                <option disabled selected value="0">Selecciona enfermedad/es</option>
                <?php foreach($params["enfermedades"] as $enfermedad){?>

                <option value="<?php echo $enfermedad["id"] ?>"><?php echo $enfermedad["enfermedad"] ?></option>
                <?php } ?>
              </select>
            </div> 
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nSelVacunas" class="col-form-label">Vacunas:</label><br>
              <select name="nSelVacunas[]" id="nSelVacunas" multiple>
                <option disabled selected value="0">Selecciona vacuna/s</option>
                <?php foreach($params["vacunas"] as $vacuna){?>

                <option value="<?php echo $vacuna["id"] ?>"><?php echo $vacuna["nombre"] ?></option>
                <?php } ?>
              </select>
            </div> 
          </div>
        </div>

        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="nSelTratamientos" class="col-form-label">Tratamientos:</label>
              <select name="nSelTratamientos[]" id="nSelTratamientos" multiple>
                <option disabled selected value="0">Selecciona tratamiento/s</option>
                <?php foreach($params["tratamientos"] as $tratamiento){?>

                <option value="<?php echo $tratamiento["id"] ?>"><?php echo $tratamiento["tratamiento"] ?></option>
                <?php } ?>
              </select>
            </div> 
          </div>
          <div class="col-sm-3">
            <div class="form-group">
            <input type="checkbox" class="css-checkbox" id="nCkEsterilizado" name="nCkEsterilizado">
            <label for="nCkEsterilizado" class="css-label lite-cyan-check">Esterilizado</label>
          </div>
           </div>
           <div class="col-sm-3">
            <div class="form-group">
              <input type="checkbox" class="css-checkbox" id="nChAdoptado" name="nChAdoptado">
              <label for="nChAdoptado" class="css-label lite-cyan-check">Adoptado</label>
            </div>
           </div>
        </div>
         
        

         <div class="row">
           <div class="col-sm-6">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Localidad</label><br>
              <select name="nSelLocalidad" id="nSelLocalidad">
                <option disabled selected value="0">Selecciona una localidad</option>
                <?php foreach($params["localidades"] as $localidad){?>
                <option value="<?php echo $localidad["id"] ?>"><?php echo $localidad["localidad"] ?></option>
                <?php } ?>
              </select>
            </div> 
           </div>
           <div class="col-sm-6">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nº Chip:</label>
                <input type="text" class="form-control" id="nNumChip" name="nNumchip">
              </div>
           </div>
         </div>

       
         
         <div class='row'>
           <div class='col-sm-6'>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Refugio</label><br>
              <select name="nSelRefugio" id="nSelRefugio" >
                <option disabled selected value="0">Selecciona un refugio</option>
                <?php foreach($params["refugios"] as $refugio){?>

                <option value="<?php echo $refugio["id"] ?>"><?php echo $refugio["nombre"] ?></option>

                <?php
                } 
                ?>
                </select>
            </div>
           </div>
           <div class='col-sm-6'>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tamaño</label><br>
              <select name="nSelTamanyo" id="nSelTamanyo">
                <option disabled selected value="0">Selecciona un tamaño</option>
                <?php foreach($params["tamanyos"] as $tamanyos=>$campo){?>

                <option value="<?php echo $campo["id"] ?>"><?php echo $campo["tamanyo"] ?></option>

                <?php
                } 
                ?>
              </select>
            </div>
           </div>
         </div>
         <div class='row'>
           <div class='col-sm-3'>
             <label>Sexo</label>
            <div class="form-group">

            <label class="containerRadio">Macho
              <br>
            <input type="radio" name="nRadioSexo" checked value="macho">
            <span class="checkmark"></span>

            
            </label>
            </div>

            </div>
            <div class='col-sm-3'>
              <br>
            <label class="containerRadio">Hembra
            <input type="radio" name="nRadioSexo" value="hembra">
            <span class="checkmark"></span>

            </div>
           
           <div class='col-sm-6'>
           <div class="form-group">
                <label for="lblEspecie" class="col-form-label">Especie(*)</label><br>
                <select name="nSelEspecie" id="nSelEspecie" class="selectObligatorio">
                <option disabled selected value="0">Selecciona una especie</option>
                <?php foreach($params["especies"] as $especies){?>

                <option value="<?php echo $especies["id"] ?>"><?php echo $especies["nombre"] ?></option>

                <?php
                } 
                ?>
                </select>
              </div>
           </div>
         </div>

         <div class='row'>
           <div class='col-sm-6'>
           <div class="form-group">
                <label for="lblRaza" class="col-form-label">Raza</label><br>
                <select name="nSelRaza" id="nSelRaza" disabled>
                <option disabled selected value="0">Selecciona una raza</option>
                </select>
              </div>
           </div>
           </div>
           <div class='row'>
           <div class='col-sm-6'>
           <div class="form-group">
                <label for="foto" class="col-form-label">Foto</label>
                <input type="file" id="foto" name="fotoSubida"/>
              </div>
           </div>
           </div>
           
         
         <div class='row'>
            <div class='col-sm-6'>
            <div class="form-group">
              <label for="adopNuevoDesplegable" id="btnCrearAdop">Adoptante</label>
              <div type="button" id="btnCrearAdop">
              <img src="../web/css/imagenes/icono_anyadir.png" alt="iconoAnyadir"
              name="adopNuevoDesplegable" id="adopNuevoDesplegable"/>
              </div>
            </div>
              <div class='row'>
                <div class='col-sm-12'>
                <select name="nSelAdoptante" id="nSelAdoptante">
              <option disabled selected value="0">Selecciona adoptante</option>
              <?php foreach($params["adoptantes"] as $adoptante){?>

              <option value="<?php echo $adoptante["id"] ?>"><?php echo $adoptante["nombre"] ." ". $adoptante["apellidos"]?></option>
              <?php } ?>
            </select>
                </div>
              
              </div>
            
         
           
            </div> 
            </div>
          

         
            
              <!--Nuevo adoptante-->
              <!--Manejador en ajaxRescate.js-->
<div id="formAdotante" class="container">

  <div class='row'>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblNombreAdop">Nombre(*)</label>
    <input class="form-control obligatorio" type="text" name="nombreAdop" id="nombreAdop"/>
    </div>
    </div>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblApellidosAdop">Apellidos(*)</label>
    <input class="form-control obligatorio" type="text" name="apellidosAdop" id="apellidosAdop"/>
  </div>
    </div>
  </div>

  <div class='row'>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblTelf1">Teléfono 1</label>
    <input class="form-control" type="text" name="telf1Adop" id="telf1Adop"/>
  </div>
    </div>
    <div class='col-sm-6'>
    <div class="form-group">              
    <label for="lblTelf2">Teléfono 2</label>
    <input class="form-control" type="text" name="telf2Adop" id="telf2Adop"/>
  </div>
    </div>
  </div>

  <div class='row'>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblEmail">Email</label>
    <input class="form-control" type="text" name="emailAdop" id="emailAdop"/>
  </div>
    </div>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblDireccion">Dirección</label>
    <input class="form-control" type="text" name="direccionAdop" id="direccionAdop"/>
  </div> 
    </div>
  </div>

  <div class='row'>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblProvincia">Provnincia</label>
    <input class="form-control" type="text" name="provinciaAdop" id="provinciaAdop"/>
  </div> 
    </div>
    <div class='col-sm-6'>
       
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
    </div>
  </div>

  <div class='row'>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblDni">DNI</label>
    <input class="form-control" type="text" name="dniAdop" id="dniAdop"/>
  </div>
    </div>
    <div class='col-sm-6'>
    <div class="form-group">
    <label for="lblNumMascotas">Nº mascotas</label>
    <input class="form-control" type="number" name="numMascotasAdop" id="numMascotasAdop"/>
  </div>
    </div>
  </div>
  <div class='row'>
    <div class='col-sm-12'>
    <div class="form-group">              
    <label for="lblComentarios">Comentarios</label>
    <textarea type="text" class="form-control" name="comentariosAdop" id="comentariosAdop"></textarea>
  </div>
    </div>
  </div>


</div>


        <div class='row'>
          <div class='col-sm-12'>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Comentarios:</label>
              <textarea class="form-control" id="nComentarios" name="nComentarios"></textarea>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class='col-sm-12'>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Descripción:</label>
              <textarea class="form-control" id="nDescripcion" name="nDescripcion"></textarea>
            </div>
          </div>
        </div>

        </form>
      </div>
    
      <div class="modal-footer">
       
        <button class="btnDialogo_Aceptar" type="submit" name="enviarNuevo" id="btnEnviarNuevoRescate">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</div>
<!--**********************************************FIN MODAL*****************************************************************-->
<!--***************************************************************************************************************-->
<!--***************************************************************************************************************-->



<!--**********************************************INICIO FILTROS*****************************************************************-->
<!--***************************************************************************************************************-->
<!--***************************************************************************************************************-->
<!--I-Cabecera filtros-->
<div class=" filtrosRescate">
<div class="row cab-filtros">
   <div class="col-md-3">
      <span class="titulo-entidad">Rescates</span>
   </div>
   <div class="col-md-6"></div>
   <div class="col-md-3 btn_anyadir">
      <button type="button" class="btn nuevo" data-toggle="modal" data-target="#nuevoRescate">+ Añadir nuevo </button>
   </div>
</div>
<div class="row">
   <div class="col-sm-12">
      <hr>
   </div>
</div>
<!--F-Cabecera filtros-->
	
<!--I-Grid filtros-->
<div class="grid-filtros">
   <div class="cab-item-filtros" id="fNacimiento">Fecha de nacimiento</div>
   <div class="cab-item-filtros" id="fIngreso">Fecha de ingreso</div>
   <div class="cab-item-filtros" id="fDesp">Fecha última desaparasitación</div>
   <div class="lblRango">Desde</div>
   <div class="lblRango">Hasta</div>
   <div class="lblRango">Desde</div>
   <div class="lblRango">Hasta</div>
   <div class="lblRango">Desde</div>
   <div class="lblRango">Hasta</div>

   <div class="inputDate">
      <input type="date" id="fechaDesdeNac" name="fechaDesdeNac">
   </div>
   <div class="inputDate">
      <input type="date" id="fechaHastaNac" name="fechaHastaNac">
   </div>
   <div class="inputDate">
      <input type="date" id="fechaDesdeIng" name="fechaDesdeIng">
   </div>
   <div class="inputDate">
      <input type="date" id="fechaHastaIng" name="fechaHastaIng">
   </div>
   <div class="inputDate">
      <input type="date" id="fechaDesdeDesp" name="fechaHastaNac">
   </div>
   <div class="inputDate">
      <input type="date" id="fechaHastaDesp" name="fechaHastaDesp">
   </div>

   <div class="cab-item-filtros">Adoptado</div>
   <div class="cab-item-filtros">Esterilizado</div>
   <div class="cab-item-filtros" id="lblBusqueda">Busqueda global</div>


    <div>
      <input type="checkbox" id="cbxAdopSi" class="css-checkbox" value='<img src="../web/css/imagenes/icono_si.png"/>' name="adoptado" />
      <label for="cbxAdopSi" name="cbxAdopSi" class="css-label lite-cyan-check">Si</label>
    </div>

   <div>
      <input type="checkbox" id="cbxEstSi" class="css-checkbox" value='<img src="../web/css/imagenes/icono_si.png"/>' name="esterilizado">
      <label for="cbxEstSi" name="cbxEstSi" class="css-label lite-cyan-check">Si</label>
     
   </div>
   
   <input type="text" class="inputBusqueda" id="busquedaResacate" name="busquedaRescate">

   <div>
      <input type="checkbox" id="cbxAdopNo" class="css-checkbox" value='<img src="../web/css/imagenes/icono_no.png"/>' name="adoptado">
      <label for="cbxAdopNo" name="cbxAdopNo" class="css-label lite-cyan-check">No</label>
   </div>

   <div>
      
      <input type="checkbox" id="cbxEstNo" class="css-checkbox" value='<img src="../web/css/imagenes/icono_no.png"/>' name="esterilizado">
      <label for="cbxEstNo" class="css-label lite-cyan-check" name="cbxEstNo">No</label>
      
   </div>
   <button type="button" class="btn btnBorrarFiltros" id="btnResetFiltros">Borrar filtros</button>
</div>
</div>

<!--F-Grid filtros-->

<div class="mensajeConfirmacionAjax">
  <span> ¡Éxito al elminar el registro!</span>
  <button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="cerrarConfirmacion">
  </button>
</div>

<?php if(isset($_GET["exito"])) :?>
<div class="mensajeConfirmacion">
<span><?php echo "¡Éxito al " . $_GET["exito"] . "!"?></span>
<button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
  </div>
<?php endif; ?>

<!--**********************************************FIN FILTROS*****************************************************************-->
<!--***************************************************************************************************************-->
<!--***************************************************************************************************************-->

<!--**********************************************INICIO TABLA*****************************************************************-->
<!--***************************************************************************************************************-->
<!--***************************************************************************************************************-->

</div>

<div class="cont_tabla">
<table class="table" id="tablaRescates">
  <thead>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Fecha nacimiento</th>
<th>Fecha ingreso</th>
<th>Adoptado</th>
<th>Esterilizado</th>
<th>Nº Chip</th>
<th>Ulitma desparasitación</th>
<th>Especie</th>
<th>Raza</th>
<th>Tamaño</th>
<th>Localidad</th>
<th>Refugio</th>
<th>Registrador</th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>

</tbody>
</table>
</div>
<!--**********************************************FIN TABLA*****************************************************************-->
<!--***************************************************************************************************************-->
<!--***************************************************************************************************************-->

<!--I - PERSONALIZAR CAMPOS-->



<!--F - PERSONALIZAR CAMPOS-->

<!-- I - MODALES ASIGNAR ENVATRA-->
<!--***********************************************************-->
<!--***********************************************************-->
<!--***********************************************************-->

<!-- I - MODAL ASIGNAR ENFERMEDAD -->

<div class="modal fade" id="asignar_enfermedades" tabindex="-1" role="dialog" aria-labelledby="pruebaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Asignar enfermedad</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select name="multi_enfermedades" id="multi_enfermedades" multiple>
      <?php foreach($params["enfermedades"] as $enfermedad){?>

      <option value="<?php echo $enfermedad["id"] ?>"><?php echo $enfermedad["enfermedad"] ?></option>

<?php
} 
?>
</select>
      </div>
      <div class="modal-footer">
        <h5 hidden>ins_enf</h5>
        
        <button type="button" class="btnDialogo_Aceptar btn_asignarEnvatra">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- F - MODAL ASIGNAR ENFERMEDAD -->

<!-- I - MODAL ASIGNAR VACUNAS -->

<div class="modal fade" id="asignar_vacunas" tabindex="-1" role="dialog" aria-labelledby="pruebaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Asignar vacuna</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select name="multi_vacunas" id="multi_vacunas" multiple>
      <?php foreach($params["vacunas"] as $vacuna){?>

      <option value="<?php echo $vacuna["id"] ?>"><?php echo $vacuna["nombre"] ?></option>

<?php
} 
?>
</select>
      </div>
      <div class="modal-footer">
      <h5 hidden>ins_vac</h5>
       
        <button type="button" class="btnDialogo_Aceptar btn_asignarEnvatra">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- F - MODAL ASIGNAR VACUNAS -->

<!-- I - MODAL ASIGNAR TRATAMIENTOS -->

<div class="modal fade" id="asignar_tratamientos" tabindex="-1" role="dialog" aria-labelledby="pruebaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Asignar tratamiento</span>
      <!--  <h5 class="modal-title" id="pruebaModal">Asignar tratamiento</h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select name="multi_tratamientos" id="multi_tratamientos" multiple>
      <?php foreach($params["tratamientos"] as $tratamiento){?>

      <option value="<?php echo $tratamiento["id"] ?>"><?php echo $tratamiento["tratamiento"] ?></option>

<?php
} 
?>
</select>
      </div>
      <div class="modal-footer">
      <h5 hidden>ins_trat</h5>
        
        <button type="button" class="btnDialogo_Aceptar btn_asignarEnvatra">Aceptar </button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- F - MODAL ASIGNAR TRATAMIENTOS -->





<!-- F - MODALES ASIGNAR ENVATRA-->
<!--***********************************************************-->
<!--***********************************************************-->
<!--***********************************************************-->



<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
