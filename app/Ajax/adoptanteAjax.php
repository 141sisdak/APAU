<?php 

require_once ('../Models/Model.php');
require_once ('../Models/modelAdoptante.php');
require_once ('../libs/Validacion.php');
require_once ('../libs/utils.php');

$json = array();

$m = new modelAdoptante();

header('Content-type: application/json');



if(isset($_GET["idMod"])){

   if($json = $m->getAdoptantePorId($_GET["idMod"])){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }

}

else if(isset($_GET["dniNuevo"])){

   $dni = recoge("dniNuevo");

   if($json = $m->getAdoptantePorDni($dni)){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }

}

else if(isset($_POST["idDelete"])){

   if($m->eliminarAdoptante($_POST["idDelete"])){
      echo json_encode(true);
   }else{
      echo json_encode(false);
   }

}
else{
   if($json = $m->getAdoptantes()){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }
}

?>