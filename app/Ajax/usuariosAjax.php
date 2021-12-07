<?php 

require_once ('../Models/Model.php');
require_once ('../Models/modelUsuario.php');
require_once ('../libs/Validacion.php');
require_once ('../libs/utils.php');
require_once ('../email.php');

session_start();

$json = array();

$m = new modelUsuario();

header('Content-type: application/json');

if(isset($_GET["nombreNuevo"])){

    $nombreNuevo = recoge("nombreNuevo");

    if($json = $m->getNombreUsuario($nombreNuevo)){
       echo json_encode($json);
    }else{
       echo json_encode(false);
    }
}

else if(isset($_GET["nombreMod"])){

   if($json = $m->getUsuarioPorNombre($_GET["nombreMod"])){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }

}

else if(isset($_POST["idDelete"])){

   if($m->eliminarUsuario($_POST["idDelete"])){
      echo true;
   }else{
      echo false;
   }

}
else if(isset($_POST["permitirUsuario"])){
   if($m->permitirUsuario($_POST["permitirUsuario"])){
      
      email::enviarCorreo($_POST["emailUsuario"], "Acceso permitido", "Hola " . $_POST["nombreUsuario"] . "!,
      \nEl administrador te ha concedido permiso de acceso a la aplicación.\nhttp://localhost/AUPAU/web/index.php");

      echo json_encode(true);
   }else{
      echo json_encode(false);
   }
}

else if(isset($_GET["email"])){

   $email = recoge("email");

   if($m->getEmail($email)){
      echo json_encode(true);
   }else{
      echo json_encode(false);
   }
}

else if(isset($_GET["getPass"])){

   $passActual = recoge("getPass");

   if($m->getPass($_SESSION["id"], $passActual)){
      echo json_encode(true);
   }else{
      echo json_encode(false);
   }

}

else{
   if($json = $m->getUsuarios()){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }
}

?>