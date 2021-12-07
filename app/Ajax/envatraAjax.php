<?php 

require_once ('../Models/Model.php');
require_once ('../Models/modelEnvatra.php');
require_once ('../libs/Validacion.php');
require_once ('../libs/utils.php');



$m = new modelEnvatra();

header('Content-type: application/json');

//I - TRATAMIENTOS

if(isset($_GET["nuevoTratamiento"])){

    $nombreNuevo = recoge("nuevoTratamiento");

    if($m->getNombreTratamiento($nombreNuevo)){
       echo json_encode(true);
    }else{
       echo json_encode(false);
    }
}



//F - TRATAMIENTOS

//I - ENFERMEDADES

if(isset($_GET["nuevaEnfermedad"])){

   $nombreNuevo = recoge("nuevaEnfermedad");

   if($m->getNombreEnfermedad($nombreNuevo)){
      echo json_encode(true);
   }else{
      echo json_encode(false);
   }
}



//F - ENFERMEDADES

//I - VACUNAS

if(isset($_GET["nuevaVacuna"])){

   $nombreNuevo = recoge("nuevaVacuna");

   if($m->getNombreVacuna($nombreNuevo)){
      echo json_encode(true);
   }else{
      echo json_encode(false);
   }
}



//F - VACUNAS

//Datatable envatra

if(isset($_GET["getEnvatra"])){

   switch($_GET["getEnvatra"]){

      case "tratamientos":
         if($json = $m->getTratamientosAll()){
            echo json_encode($json);
         }else{
            echo json_encode(false);
         }
      break;

      case "vacunas":
         if($json = $m->getVacunasAll()){
            echo json_encode($json);
         }else{
            echo json_encode(false);
         }
      break;

      case "enfermedades":
         if($json = $m->getEnfermedadesAll()){
            echo json_encode($json);
         }else{
            echo json_encode(false);
         }
      break;

   }

}

if(isset($_POST["idDelete"])){

   switch ($_POST["envatra"]) {
      case 'enfermedades':
            if($m->eliminarEnfermedad($_POST["idDelete"])){
               echo json_encode(true);
            }
      break;

      case 'vacunas':
         if($m->eliminarVacuna($_POST["idDelete"])){
            echo json_encode(true);
         }
      break;

      case 'tratamientos':
         if($m->eliminarTratamiento($_POST["idDelete"])){
            echo json_encode(true);
         }
      break;
   }

}
 

?>