<?php 
require_once ('../Models/Model.php');
require_once ('../Models/modelRefugios.php');
require_once ('../libs/Validacion.php');
require_once ('../libs/utils.php');

$json = array();

$m = new modelRefugios();

header('Content-type: application/json');

if(isset($_GET["nombreNuevo"])){

    $nombreNuevo = recoge("nombreNuevo");

    if($json = $m->getNombreRefugio($nombreNuevo)){
       echo json_encode($json);
    }else{
       echo json_encode(false);
    }
}



else if(isset($_POST["idDelete"])){

   if($m->eliminarRefugio($_POST["idDelete"])){
      echo true;
   }else{
      echo false;
   }

}
 
else{
   if($json = $m->getRefugiosAll()){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }
}


?>