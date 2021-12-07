<?php ob_start() ?>

<div class="contenedor_pc container">
   <span class="titulo-entidad">Panel de control</span>
   <hr>
   <div class="cont_entidades_pc">
      <div class='row'>
         <div class='col-sm-3'>
            <a href="index.php?ctl=usuarios">
               <div class="cont_entidad_pc_usuarios">
                  <img src="../web/css/imagenes/iconos_pc/icono_usuarios.png" alt="">
                  <span>Usuarios</span>
               </div>
            </a>
         </div>
         <div class='col-sm-9'>
            <div class='row'>
               <div class="col-sm-4 mb-3">
                  <a href="index.php?ctl=adoptante">
                     <div class="cont_entidad_pc">
                        <img src="../web/css/imagenes/iconos_pc/icono_adoptantes.png" alt="">
                        <span>Adoptantes</span>
                     </div>
                  </a>
               </div>
               <div class="col-sm-4">
                  <a href="index.php?ctl=refugios">
                     <div class="cont_entidad_pc">
                        <img src="../web/css/imagenes/iconos_pc/icono_refugios.png" alt="">
                        <span>Refugios</span>
                     </div>
                  </a>
               </div>
               <div class="col-sm-4">
                  <a href="index.php?ctl=gastosPc">
                     <div class="cont_entidad_pc">
                        <img src="../web/css/imagenes/iconos_pc/icono_gastos.png" alt="">
                        <span>Gastos</span>
                     </div>
                  </a>
               </div>
               <div class="col-sm-4">
                  <a href="index.php?ctl=enfermedades">
                     <div class="cont_entidad_pc">
                        <img src="../web/css/imagenes/iconos_pc/icono_enfermedades.png" alt="">
                        <span>Enfermedades</span>
                     </div>
                  </a>
               </div>
               <div class="col-sm-4">
                  <a href="index.php?ctl=vacunas">
                     <div class="cont_entidad_pc">
                        <img src="../web/css/imagenes/iconos_pc/icono_vacunas.png" alt="">
                        <span>Vacunas</span>
                     </div>
                  </a>
               </div>
               <div class="col-sm-4">
                  <a href="index.php?ctl=tratamientos">
                     <div class="cont_entidad_pc">
                        <img src="../web/css/imagenes/iconos_pc/icono_tratamientos.png" alt="">
                        <span>Tratamientos</span>
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
<!--
<a class="btn btn-primary" href="index.php?ctl=usuarios">Usuarios</a><br><br><br>

<a class="btn btn-primary" href="index.php?ctl=adoptante">Adoptantes</a><br><br><br>

<a class="btn btn-primary" href="index.php?ctl=refugios">Refugios</a><br><br><br>

<a class="btn btn-primary" href="index.php?ctl=tratamientos">Tratamientos</a><br><br><br>

<a class="btn btn-primary" href="index.php?ctl=enfermedades">Enfermedades</a><br><br><br>

<a class="btn btn-primary" href="index.php?ctl=vacunas">Vacunas</a><br><br><br>

<a class="btn btn-primary" href="index.php?ctl=gastosPc">Gastos</a><br><br><br>
-->