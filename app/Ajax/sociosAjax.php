<?php 
require_once ('../Models/Model.php');
require_once ('../Models/modelSocios.php');
require_once ('../libs/Validacion.php');
require_once ('../libs/utils.php');

$json = array();

$m = new modelSocios();

header('Content-type: application/json');

if(isset($_GET["idSocioMod"])){

    $id = recoge("idSocioMod");

    if($json = $m->getSocioPorId($id)){
       echo json_encode($json);
    }else{
       echo json_encode(false);
    }
}

 

else if(isset($_POST["idDelete"])){

   if($m->eliminarSocio($_POST["idDelete"])){
      echo true;
   }else{
      echo false;
   }

}

else{
   if($json = $m->getSociosAll()){

      echo json_encode($json);

   }else{
      echo json_encode(false);
   }

}


?>