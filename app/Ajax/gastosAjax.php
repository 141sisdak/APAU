<?php 

require_once ('../Models/Model.php');
require_once ('../Models/modelGastos.php');
require_once ('../libs/Validacion.php');
require_once ('../libs/utils.php');

$json = array();

$m = new modelGastos();

header('Content-type: application/json');

if(isset($_GET["getGasto"])){

    if($json = $m->getComentarioPorId($_GET["getGasto"])){
        echo json_encode($json);
     }else{
        echo json_encode(false);
     }

}

else if(isset($_POST["pagarGasto"])){

    if($m->pagarGasto($_POST["pagarGasto"])){
        echo json_encode(true);
     }else{
        echo json_encode(false);
     }

}

 else if(isset($_GET["idGastoMod"])){

   if($json = $m->getGastoPorId($_GET["idGastoMod"])){
       echo json_encode($json);
    }else{
       echo json_encode(false);
    }

}

else if(isset($_POST["idDelete"])){

   if($m->eliminarGasto($_POST["idDelete"])){
       echo json_encode(true);
    }else{
       echo json_encode(false);
    }

}

else if(isset($_POST["idGastoDesPago"])){

   if($m->deshacerPago($_POST["idGastoDesPago"])){
       echo json_encode(true);
    }else{
       echo json_encode(false);
    }

}

else{
   if($json = $m->getGastosAll()){
      echo json_encode($json);
   }else{
      echo json_encode(false);
   }
}




?>