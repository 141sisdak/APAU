<?php ob_start() ?>

<div class="cont_inicio">

    <div class="cont_inicio_entidades">
        <div class='row mb-3'>
            <div class='col-sm-4'>
            <a href="index.php?ctl=rescate">
               <div class="cont_entidad_pc">
                  <img src="../web/css/imagenes/iconos_dash/icono_rescates_dash.png" alt="">
                  <span><?php echo $params["datosDash"]["totalRescates"] ?></span>
                  <span>Rescates</span>
               </div>
            </a>
            </div>
            <div class='col-sm-4'>
            <a href="index.php?ctl=gastos">
               <div class="cont_entidad_pc">
                  <img src="../web/css/imagenes/iconos_dash/icono_gastos_dash.png" alt="">
                  <span><?php echo $params["datosDash"]["totalGastos"]["total"] . "€"?></span>
                  <span>Gastos</span>
               </div>
            </a>
            </div>
            <div class='col-sm-4'>
            <a href="index.php?ctl=panelControl" <?php if($_SESSION["rol"]!=2)  echo "style='visibility: hidden';" ?> >
               <div class="cont_entidad_pc">
                  <img src="../web/css/imagenes/iconos_dash/icono_panel_dash.png" alt="">
                  <span>Panel</span>
                  <span>de control</span>
               </div>
            </a>
            </div>
        </div>

        <div class='row'>
            <div class='col-sm-4'>
            <a href="index.php?ctl=socios">
               <div class="cont_entidad_pc">
                  <img src="../web/css/imagenes/iconos_dash/icono_socios_dash.png" alt="">
                  <span><?php echo $params["datosDash"]["totalSocios"] ?></span>
                  <span>Socios de APAU</span>
               </div>
            </a>
            </div>
            <div class='col-sm-4'>
            <a href="index.php?ctl=donaciones">
               <div class="cont_entidad_pc">
                  <img src="../web/css/imagenes/iconos_dash/icono_donaciones_dash.png" alt="">
                  <span><?php echo $params["datosDash"]["totalDonaciones"]["total"] . " €" ?></span>
                  <span>Donaciones</span>
               </div>
            </a>
            </div>
            <div class='col-sm-4'>
               
            </div>
        </div>
    </div>

    <div class="ilustracion">
        <img src="../web/css/imagenes/iconos_dash/mujer_dash.png" alt="" alt="">
        <img src="../web/css/imagenes/iconos_dash/perrete_dash.png" alt="">
    </div>

</div>


<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
