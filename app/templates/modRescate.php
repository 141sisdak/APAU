<?php ob_start() ?>


<?php
if(isset($validacion->mensaje)){
    if (is_object ($validacion)){
        foreach ($validacion->mensaje as $errores) {
            foreach ($errores as $error)?>
            <b><span style="color: red;"><?php echo $error ?></span></b><br>
            <?php 
    }}
    
}
?>

<?php if(isset($_GET["exito"])) :?>
<div class="mensajeConfirmacion">
<span><?php echo "¡Éxito al " . $_GET["exito"] . "!"?></span>
<button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
  </div>
<?php endif; ?>

<?php if(isset($params["mensError"])) :?>
<div class="mensajeError">
<span><?php echo $params["mensError"]?></span>
<button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="">
  </button>
  </div>
<?php endif; ?>

<span id="id_rescate" hidden><?php echo $_GET["id"] ?></span>
<div class="cont_principal_modRescate">

  <div class="cont_cabeceraVerFicha">
  
          <span class="titulo-entidad">Modificar ficha</span>
          <label for="modificar" tabindex="0" class="btnGuardarCambios">Guardar cambios</label>
          
      </div>
      <hr>

  <div class="cont_datos_modRescat">
  <form action="index.php?ctl=modificarRescate&id=<?php echo $params["ficha"]["id"] ?>" enctype="multipart/form-data" method="post" name="formModRescate" id="formModRescate">
    <div class='row rowMod'>
      <div class='col-sm-4 columnaIzqFicha mr-3'>
        <div class="cont_foto">
        <?php if($params["ficha"]["path_foto"]!="Sin datos"){
                        
                        echo "<img src='" . $params["ficha"]["path_foto"] ."'>";
                    }else{
                        echo "<img src='../web/uploads/foto_defecto.png'>";
                    }

                    ?>
                    <?php if  ($params["ficha"]["estadoAdop"]=="adoptado") :echo ' <img src="../web/css/imagenes/icono_adoptado.png"/>';
                    else: echo '<img src="../web/css/imagenes/icono_no_adoptado.png"/>';
                    endif;?>
                    
        </div>
        <input class="nombreAnimalFicha" value="<?php echo $params["ficha"]["nombre"]?>" name="nombre" id="nombre"/>
        <input class="nchip" value="<?php echo $params["ficha"]["numchip"]?>" name="numChip" id="numChip"/>
        <span class="labelAtributoAnimal">Especie</span>
        <select name="modSelEspecie" id="modSelEspecie" class="selects_tabla_rescates">

        <?php foreach($params["especies"] as $especies){?>

        <option value="<?php echo $especies["id"] ?>"<?php if($params["ficha"]["especie"]==$especies["nombre"]) echo "selected" ?>><?php echo $especies["nombre"] ?></option>

        <?php
        } 
        ?>
        </select>

        <span class="labelAtributoAnimal">Raza</span> 
        <select name="modSelRaza" id="modSelRaza" class="selects_tabla_rescates">

        <?php foreach($params["razas"] as $raza){?>

        <option value="<?php echo $raza["id"] ?>"<?php if($params["ficha"]["raza"]==$raza["nombre"]) echo "selected" ?>><?php echo $raza["nombre"] ?></option>

        <?php
        } 
        ?>
        </select>

        

        <span class="labelAtributoAnimal">Sexo</span> 
        <div class="cont_machoHembra">

          <label class="containerRadio mr-3">Macho
            <input type="radio" name="radioSexo" value="macho" <?php if($params["ficha"]["sexo"]=="macho") echo "checked" ?>>
            <span class="checkmark"></span>
          </label>
          <label class="containerRadio">Hembra
            <input type="radio" name="radioSexo" value="hembra" <?php if($params["ficha"]["sexo"]=="hembra") echo "checked" ?>>
            <span class="checkmark"></span>
          </label>
        </div>  
        
        <span class="labelAtributoAnimal">Tamaño</span> 
        <select name="mSelTamanyo" id="mSelTamanyo" class="selects_tabla_rescates">

        <?php foreach($params["tamanyos"] as $tamanyos=>$campo){?>

        <option value="<?php echo $campo["id"] ?>"<?php if($params["ficha"]["tamanyo"]==$campo["tamanyo"]) echo "selected" ?>><?php echo $campo["tamanyo"] ?></option>

        <?php
        } 
        ?>
        </select>

        <span class="labelAtributoAnimal">Adoptado</span>
        <div class="cont_machoHembra ">

          <label class="containerRadio mr-3">Si
            <input type="radio" name="radioAdoptado"  value="adoptado" <?php if($params["ficha"]["estadoAdop"]=="adoptado") echo "checked" ?>  >
            <span class="checkmark"></span>
          </label>
          
          
          
        <label class="containerRadio">No
          <input type="radio" name="radioAdoptado"  value="no adoptado" <?php if($params["ficha"]["estadoAdop"]=="no adoptado") echo "checked" ?>  >
          <span class="checkmark"></span>
          </label>

          </div>

          <span class="labelAtributoAnimal">Foto</span>
          <input type="file" id="fotoMod" name="fotoSubidaMod"/>
          
          
        </div>

        <div class='col-sm-4 cont_InfoSalud_Mod'>
           <span class="labelTituloAtritutos">Información</span>
           <div>
             <div class='row'>
               <div class='col-sm-6'>
                <div class="grupoAtributos">
                  <span class="labelAtributoAnimal">Fecha de nacimiento</span>
                  <input type="date" name="fechaNacMod" id="fechaNacMod" value="<?php echo $params["ficha"]["fechaNac"] ?>"/>
                </div>

                <div class="grupoAtributos">
                  <span class="labelAtributoAnimal">Refugio</span>
                  <select name="selRefugio" id="selRefugio" class="selects_tabla_rescates" >

                    <?php foreach($params["refugios"] as $refugio){?>

                    <option value="<?php echo $refugio["id"] ?>"<?php if($params["ficha"]["refugio"]==$refugio)echo "selected" ?>><?php echo $refugio["nombre"] ?></option>

                    <?php
                    } 
                    ?>
                    </select>
                </div>

                <div class="grupoAtributos">
                  <span class="labelAtributoAnimal">Esterilizado</span>
                  <div class="cont_machoHembra ">

                    <label class="containerRadio mr-3">Si
                      <input type="radio" name="ckEsterilizado"  value="si" <?php if($params["ficha"]["esterilizado"]=="si") echo "checked" ?>  >
                      <span class="checkmark"></span>
                    </label>



                    <label class="containerRadio">No
                    <input type="radio" name="ckEsterilizado"  value="no" <?php if($params["ficha"]["esterilizado"]=="no") echo "checked" ?>  >
                    <span class="checkmark"></span>
                    </label>

                  </div>
                </div>

               </div>
               <div class='col-sm-6'>
                  <div class="grupoAtributos">
                    <span class="labelAtributoAnimal">Fecha de ingreso</span>
                    <input type="date" id="fechaIngMod" name="fechaIngMod" value="<?php echo $params["ficha"]["fechaIngreso"] ?>"/>
                  </div>
                  <div class="grupoAtributos">
                    <span class="labelAtributoAnimal">Localidad</span>
                    <select name="selLocalidad" id="selLocalidad" class="selects_tabla_rescates">
                      <?php foreach($params["localidades"] as $localidad){?>
                      <option value="<?php echo $localidad["id"] ?>"<?php if($params["ficha"]["localidad"]==$localidad["localidad"]) echo "selected" ?>><?php echo $localidad["localidad"] ?></option>
                      <?php
                      } 
                      ?>
                    </select>
                  </div>
                  <div class="grupoAtributos">
                  <span class="labelAtributoAnimal">Adoptante</span>
                  <select name="selectAdoptante" id="selAdoptante" class="selects_tabla_rescates">
                    <?php foreach($params["adoptantes"] as $adoptante){?>

                    <option value="<?php echo $adoptante["id"] ?>"<?php if($params["ficha"]["adoptante"]==$adoptante["id"]) echo "selected" ?>><?php echo $adoptante["nombre"] ?></option>

                    <?php
                    } 
                    ?>
                    </select>
                  </div>
               </div>
             </div>
           </div>
           <div class='row cont_desc_coment mt-3'>
             <span class="labelTituloAtritutos">Descripción</span>
             <textarea name="modDescripcion" id="modDescripcion" cols="70" rows="4"><?php echo $params["ficha"]["descripcion"] ?></textarea>
           </div>
           <div class='row cont_desc_coment mt-3'>
             <span class="labelTituloAtritutos">Comentarios</span>
             <textarea name="modComentarios" id="modComentarios" cols="70" rows="4"><?php echo $params["ficha"]["comentarios"] ?></textarea>
           </div>
        </div>
        <div class='col-sm-4 cont_InfoSalud_Mod ml-3'>
          <span class="labelTituloAtritutos">Salud</span>
          <div class="container">
             <div class='row'>
               <div class='col-sm-6'>
                  <div class="grupoAtributos">
                    <span class="labelAtributoAnimal">Vacunas
                      <div type="button" class="btnAnyadir" data-toggle="modal" data-target="#vacunasModal">
                        <img src="../web/css/imagenes/icono_anyadir.png" alt="icono_anyadir">
                      </div>
                      <button type="button" id="btnVacunas" class="btnEliminar" disabled="disabled">
                        <img src="../web/css/imagenes/icono_eliminar.png" alt="icono_eliminar">
                      </button> 
                    </span>
                    <div class="envatra">
 
                      <?php if($params["vacunas"][0]["tipo"]!="Sin datos") :?>
                      <?php for($i = 0;$i<count($params["vacunas"]);$i++){
                    ?>
                    <div class="checksModRescate">
                      <input type="checkbox" class="css-checkbox" id="<?php echo 'cbxVacunas'.($i+1) ?>" name="cbxVacunas" value="<?php echo $params["vacunas"][$i]["id"] ?>">
                      <label class="css-label lite-cyan-check" for="<?php echo 'cbxVacunas'.($i+1) ?>"><?php echo $params["vacunas"][$i]["tipo"] ?></label>
                    </div>

                    <?php 
                    } 
                    ?>
                   
                    
                    <?php else: echo "<span class='datoAtributoAnimal'>Sin vacunas" ?>
                    <?php endif; ?>
                    </div>
                  </div>

                  <span class="labelAtributoAnimal">Enfermedades
                      <div type="button" class="btnAnyadir" data-toggle="modal" data-target="#enfermedadesModal">
                        <img src="../web/css/imagenes/icono_anyadir.png" alt="icono_anyadir">
                      </div>
                      <button type="button" class="btnEliminar" id="btnEnfermedades" disabled="disabled">
                      <img src="../web/css/imagenes/icono_eliminar.png" alt="icono_eliminar">
                      </button> 
                    </span>
                    <div class="envatra">
                      
                      <?php if($params["enfermedades"][0]["tipo"]!="Sin datos") :?>
                      <?php for($i = 0;$i<count($params["enfermedades"]);$i++){
                    ?>
                    <div class="checksModRescate">
                      <input type="checkbox" class="css-checkbox" id="<?php echo 'cbxEnfermedad'.($i+1) ?>" name="cbxEnfermedad" value="<?php echo $params["enfermedades"][$i]["id"] ?>">
                      <label class="css-label lite-cyan-check checksFicha" for="<?php echo 'cbxEnfermedad'.($i+1) ?>"><?php echo $params["enfermedades"][$i]["tipo"] ?></label>
                    </div>

                    <?php 
                    } 
                    ?>
                  

                    <?php else: echo "<span class='datoAtributoAnimal'>Sin enfermedades" ?>
                    <?php endif; ?>
                    </div>
               </div>
               <div class='col-sm-6'>
                <div class="grupoAtributos">
                 <span class="labelAtributoAnimal">Última desparasitación</span> 
                 <input type="date" name="fechaUltMod" id="fechaUltMod" value="<?php echo $params["ficha"]["ult_despa"] ?>"/>
                </div>
                <div class="grupoAtributos">
                  <span class="labelAtributoAnimal">Tratamientos
                  <div type="button" class="btnAnyadir" data-toggle="modal" data-target="#tratamientosModal">
                        <img src="../web/css/imagenes/icono_anyadir.png" alt="icono_anyadir">
                      </div>
                      <button type="button" class="btnEliminar" id="btnEnfermedades" disabled="disabled">
                      <img src="../web/css/imagenes/icono_eliminar.png" alt="icono_eliminar">
                      </button> 
                  </span>
                    <div class="envatra">
                      <?php if($params["tratamientos"][0]["tipo"]!="Sin datos") :?>
                      <?php for($i = 0;$i<count($params["tratamientos"]);$i++){
                    ?>
                    <div class="checksModRescate">
                      <input type="checkbox" class="css-checkbox" id="<?php echo 'cbxTratamientos'.($i+1) ?>" name="cbxTratamientos" value="<?php echo $params["tratamientos"][$i]["id"] ?>">
                      <label class="css-label lite-cyan-check" for="<?php echo 'cbxTratamientos'.($i+1) ?>"><?php echo $params["tratamientos"][$i]["tipo"] ?></label>
                    </div>

                    <?php 
                    } 
                    ?>
                    <?php else: echo "<span class='datoAtributoAnimal'>Sin tratamientos" ?>
                    <?php endif; ?>
                  </div>
                </div>
               </div>
             </div>
          </div>
        </div>

        

        
        

      </div>
      <button type="submit" id="modificar" name="modificar" hidden>Modificar</button>
  </form>
    </div>
  </div>    

</div>
<!-- I  - MODAL ASIGNAR ENVATRA-->

 <div class="modal fade" id="enfermedadesModal" role="dialog" aria-labelledby="<?php switch (substr($params['ficha']['id'],0,1)) {
   case 'P':
     echo "1";
     break;
     case 'G':
     echo "2";
     break;
     case 'R':
     echo "3";
     break;
   
   
 } ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Asignar enfermedad</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btnDialogo_Aceptar btnAceptar" id="ins_enf">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>



 <div class="modal fade" id="vacunasModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Asignar vacuna</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btnDialogo_Aceptar btnAceptar" id="ins_vac">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

  
 <div class="modal fade" id="tratamientosModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="titulo-modal">Asignar tratamiento</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
      <button type="button" class="btnDialogo_Aceptar btnAceptar" id="ins_trat">Asignar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- F - MODAL ASIGNAR ENVATRA-->



 
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>