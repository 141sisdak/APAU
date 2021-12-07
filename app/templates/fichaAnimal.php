<?php ob_start() ?>
<!--Contenido en documentos verficha-->
<div class="cont_principal_ficha">
   
    <div class="cont_cabeceraVerFicha">
        <span class="titulo-entidad">Rescates - ficha</span>
        <a href="index.php?ctl=modificarRescate&id=<?php echo $_GET['id'] ?>"  class="btn linkModFicha" >Modificar ficha</a>
    </div>
    <hr>
    <div class="cont_datos">
        <div class="cont_datosVerFicha container">

            <div class="row">
                <div class="col-sm-4 columnaIzqFicha">
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
                    <span class="nombreAnimalFicha"><?php echo $params["ficha"]["nombre"]?></span>
                    <span class="nchip">Nº de chip <?php echo $params["ficha"]["numchip"] ?></span>
                    <div class="cont_atributos_colIzq">
                        <span class="labelAtributoAnimal">Especie</span>
                        <span class="datoAtributoAnimal"><?php echo $params["ficha"]["especie"] ?></span>
                    </div>
                    <div class="cont_atributos_colIzq">
                        <span class="labelAtributoAnimal">Sexo</span>
                        <span class="datoAtributoAnimal"><?php echo $params["ficha"]["sexo"] ?></span>
                    </div>
                    <div class="cont_atributos_colIzq">
                        <span class="labelAtributoAnimal">Tamaño</span>
                        <span class="datoAtributoAnimal"><?php echo $params["ficha"]["tamanyo"] ?></span>
                    </div>
                    <div class="cont_atributos_colIzq">
                        <span class="labelAtributoAnimal">Raza</span>
                        <span class="datoAtributoAnimal"><?php echo $params["ficha"]["raza"] ?></span>
                    </div>
                    
                </div>

                <div class='col-sm-4 '>
                     <div class="cont_InfoSalud">

                         <span class="labelTituloAtritutos">Información</span>
                        
                         <div class="row mt-4">
                             <div class='col-sm-6'>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Fecha de nacimiento</span>
                                    <br>
                                    <?php $f = strtotime($params["ficha"]["fechaNac"]) ?>
                                    <span class="datoAtributoAnimal"><?php echo date("d-m-Y",$f)?></span>
                                 </div>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Refugio</span>
                                    <br>
                                    <span class="datoAtributoAnimal"><?php echo $params["ficha"]["refugio"] ?></span>
                                 </div>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Esterilizado</span>
                                    <br>
                                    <span class="datoAtributoAnimal"><?php echo $params["ficha"]["esterilizado"] ?></span>
                                 </div>

                                 
                             </div>
                             <div class='col-sm-6'>
                             <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Fecha de ingreso</span>
                                    <br>
                                    <?php $f = strtotime($params["ficha"]["fechaIngreso"]) ?>
                                    <span class="datoAtributoAnimal"><?php echo date("d-m-Y",$f)?></span>
                                 </div>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Localidad</span>
                                    <br>
                                    <span class="datoAtributoAnimal"><?php echo $params["ficha"]["localidad"] ?></span>
                                 </div>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Adoptante</span>
                                    <br>
                                    <span class="datoAtributoAnimal"><?php if($params["ficha"]["nomAdop"]!="Por definir"){
                                        echo $params["ficha"]["nomAdop"] . " " . $params["ficha"]["apeAdop"];
                                    }else{
                                        echo $params["ficha"]["nomAdop"];
                                    }
                                    ?></span>
                                 </div>
                             </div>
                             </div>
                         
                     </div>
                     <div class='row cont_desc_coment mt-3'>
                                <div>
                                    <span class="labelTituloAtritutos">Descripción</span>
                                    <p><?php echo $params["ficha"]["descripcion"] ?></p>
                                </div>
                        </div>
                        <div class='row cont_desc_coment mt-3'>
                                <div>
                                    <span class="labelTituloAtritutos">Comentarios</span>
                                    <p><?php echo $params["ficha"]["comentarios"] ?></p>
                                </div>
                        </div>
                </div>

                <div class='col-sm-4'>
                     <div class="cont_InfoSalud">

                         <span class="labelTituloAtritutos">Salud</span>
                         
                         <div class="row mt-4">
                             <div class='col-sm-6'>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Vacunas</span>
                                    <br>
                                    <?php for($i = 0;$i<count($params["vacunas"]);$i++){
                                    ?>
                                   <span class="datoAtributoAnimal"><?php echo $params["vacunas"][$i]["tipo"] ?></span>
                                    <?php 
                                    } 
                                    ?>
                                 </div>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Enfermedades</span>
                                    <br>
                                    <?php for($i = 0;$i<count($params["enfermedades"]);$i++){
                                    ?>
                                    <span class="datoAtributoAnimal"><?php echo $params["enfermedades"][$i]["tipo"] ?></span>
                                    <?php 
                                    } 
                                    ?>
                                 </div>

                                 
                             </div>
                             <div class='col-sm-6'>
                             <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Última desparasitación</span>
                                    <br>
                                    <?php $f = strtotime($params["ficha"]["ult_despa"]) ?>
                                    <span class="datoAtributoAnimal"><?php echo date("d-m-Y",$f)?></span>
                                 </div>

                                 <div class="grupoAtributos">
                                    <span class="labelAtributoAnimal">Tratamientos</span>
                                    <br>
                                    <?php for($i = 0;$i<count($params["tratamientos"]);$i++){
                                    ?>
                                    <span class="datoAtributoAnimal"><?php echo $params["tratamientos"][$i]["tipo"] ?></p>
                                    <?php 
                                    } 
                                    ?>
                                 </div>

                                
                             </div>
                             </div>
                         
                     </div>
                </div>
                
                           
                       
           
            </div>
            


            
    </div>
    </div>
    
</div>
</div>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>