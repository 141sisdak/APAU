<?php 

require_once ('../Models/Model.php');
require_once ('../Models/modelDonaciones.php');
require_once ('../libs/Validacion.php');
require_once ('../libs/utils.php');

$json = array();

$m = new modelDonaciones();

header('Content-type: application/json');



if(isset($_GET["idDonacionMod"])){

   if($json = $m->getDonacionePorId($_GET["idDonacionMod"])){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }

}else if(isset($_POST["idDelete"])){

   if($m->eliminarDonacion($_POST["idDelete"])){
      echo json_encode(true);
   }else{
      echo json_encode(false);
   }

}else{

   if($json = $m->getDonacionesAll()){

      echo json_encode($json);

   }else{
      echo json_encode(false);
   }

}





?>