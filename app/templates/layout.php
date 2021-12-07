<!DOCTYPE html>
<html>
<head>
<title>AUPAU Gest</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css_reset ?>" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


<?php 
if(isset($_GET["ctl"])){


switch ($_GET["ctl"]) {
  case 'rescate':
  case 'modificarRescate':
      echo '<script src="../web/javascript/rescate.js"></script>';
  break;
  case 'usuarios':
  case 'modPerfil':
  case 'login':
  case'modPass':
    echo '<script src="../web/javascript/usuarios.js"></script>';
  break;
  case 'adoptante':
    echo '<script src="../web/javascript/adoptante.js"></script>';
  break;
  case 'refugios':
    echo '<script src="../web/javascript/refugios.js"></script>';
  break;
  case 'enfermedades':
  case 'vacunas':
  case 'tratamientos':
    echo '<script src="../web/javascript/envatra.js"></script>';
  break;
  case 'gastos':
  case 'gastosPc':
    echo '<script src="../web/javascript/gastos.js"></script>';
  break;
  case 'socios':
    echo '<script src="../web/javascript/socios.js"></script>';
  break;
  case 'donaciones':
    echo '<script src="../web/javascript/donaciones.js"></script>';
  break;
 
}

}else{
  echo '<script src="../web/javascript/usuarios.js"></script>';
}

?>

<script src="../web/javascript/val_forms.js"></script>
<script src="../web/javascript/utils_var_forms.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/fc-3.3.1/fh-3.1.7/sc-2.0.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/fc-3.3.1/fh-3.1.7/sc-2.0.2/datatables.min.js"></script>

<script type="text/javascript" src="../web/javascript/sorting_datetime.js"></script>

</head>
<body>


<div class="sidebar" <?php if(isset($params["login"]) && $params["login"]==true)echo "hidden" ?>>
	<div class="sidebar-content">
		<div class="sidebar-logo">
			<img src="../web/css/imagenes/logo_sidebar.svg" alt="logoSidebar">
		</div>
		<div class="sidebar-menu">

      <div class="sidebar-item ">
      <?php if(isset($_GET['ctl']) && $_GET['ctl'] =='inicio'): echo 
      '<img src="../web/css/imagenes/iconos_sidebar/icono_dash_activo.png" alt="iconoSidebar"/>'
       ;
        else: echo  
        '<img src="../web/css/imagenes/iconos_sidebar/icono_dash_normal.png" alt="iconoSidebar"/>'
       ;
      endif;?>
       
        <a  href="index.php?ctl=inicio">Dashboard</a>
        </div>
       
     
            
			<div class="sidebar-item" <?php if($_SESSION["rol"] ==1 ) echo "style='display: none';" ?>>
      <?php if(isset($_GET['ctl']) && $_GET['ctl'] =='panelControl'): echo 
      '<img src="../web/css/imagenes/iconos_sidebar/icono_pc_activo.png" alt="iconoSidebar"/>'
       ;
        else: echo  
        '<img src="../web/css/imagenes/iconos_sidebar/icono_pc_normal.png" alt="iconoSidebar"/>'
       ;
      endif;?>
		  		<a  href="index.php?ctl=panelControl">Panel de control</a>
        </div>
      
    
      <div class="sidebar-item ">
      <?php if(isset($_GET['ctl']) && $_GET['ctl'] =='rescate'): echo 
      '<img src="../web/css/imagenes/iconos_sidebar/icono_rescates_activo.png" alt="iconoSidebar"/>'
       ;
        else: echo  
        '<img src="../web/css/imagenes/iconos_sidebar/icono_rescates_normal.png" alt="iconoSidebar"/>'
       ;
      endif;?>
        <a  href="index.php?ctl=rescate">Rescates</a>
      </div>  
		  <div class="sidebar-item">
      <?php if(isset($_GET['ctl']) && $_GET['ctl'] =='gastos'): echo 
      '<img src="../web/css/imagenes/iconos_sidebar/icono_gastos_activo.png" alt="iconoSidebar"/>'
       ;
        else: echo  
        '<img src="../web/css/imagenes/iconos_sidebar/icono_gastos_normal.png" alt="iconoSidebar"/>'
       ;
      endif;?>
		  		<a  href="index.php?ctl=gastos">Gastos</a>
		  	</div>
		  	<div class="sidebar-item ">
        <?php if(isset($_GET['ctl']) && $_GET['ctl'] =='socios'): echo 
      '<img src="../web/css/imagenes/iconos_sidebar/icono_socios_activo.png" alt="iconoSidebar"/>'
       ;
        else: echo  
        '<img src="../web/css/imagenes/iconos_sidebar/icono_socios_normal.png" alt="iconoSidebar"/>'
       ;
      endif;?>
		  		<a  href="index.php?ctl=socios">Socios</a>
		  	</div>
		  	<div class="sidebar-item">
        <?php if(isset($_GET['ctl']) && $_GET['ctl'] =='donaciones'): echo 
      '<img src="../web/css/imagenes/iconos_sidebar/icono_donaciones_activo.png" alt="iconoSidebar"/>'
       ;
        else: echo  
        '<img src="../web/css/imagenes/iconos_sidebar/icono_donaciones_normal.png" alt="iconoSidebar"/>'
       ;
      endif;?>
		  		<a  href="index.php?ctl=donaciones">Donaciones</a>
        </div>

        
	  </div>
</div>
</div>

<nav class="navbar" <?php if(isset($params["login"]) && $params["login"]==true) echo "hidden" ?>>

<div class="usuario">
<img src="../web/css/imagenes/icono-usuario.png" alt="icnoUsuario">

<div class="dropdown dropUsu">
  <button class="btnDropUsu" type="button" data-toggle="dropdown">
      <span><?php echo $_SESSION["usuario"] ?></span>
      <img src="../web/css/imagenes/flecha_select.png" alt="felchaDrop" id="flechaDrop"/>
    </button>
  <ul class="contenidoDropUsu dropdown-menu">
    <li class="dropdown-item" data-toggle="modal" data-target="#modalEditarPerfil">Editar perfil</li>
    <li class="dropdown-item" data-toggle="modal" data-target="#modalEditarPass">Cambiar contraseña</li>
  </div>
 
</div>
</div>

<div>
  
  <a href="index.php?ctl=logout">
        <img src="../web/css/imagenes/icono_logout.png" alt="iconologout" id="logout">    
  </a>
</div>

</nav>
<?php if(isset($params["mensaje"])):?>
<div class="mensajeConfirmacion">
  <span><?php echo $params["mensaje"] ?></span>
 
  <button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="cerrar">
  </button>
</div>
<?php endif; ?>

<?php if(isset($_GET["modPerf"])):?>
  <div class="mensajeConfirmacion">
  <?php if($_GET["modPerf"]=="perf") :?>
  <span>Éxito en la modificación del perfil</span>
  <?php else: ?>
    <span>Éxito en la modificación de la contraseña</span>
    <?php endif; ?>
  <button type="button" class="btn_cerrarConfirmacion">
    <img src="../web/css/imagenes/icono_cerrarConfirmacion.png" alt="cerrar">
  </button>
</div>
<?php endif; ?>
  
  

 
  <?php echo $contenido ?>
  


<?php include 'dialogos.php' ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
