<?php 

    class envatraController{

        //*************************************************************INICIO TRATAMIENTOS***************************************************************
        //***********************************************************************************************************************************************
        //***********************************************************************************************************************************************

        public function tratamientos(){

            try {

               
                require('../app/templates/tratamientos.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }

        public function NuevoTratamiento(){

            try {

               if(isset($_POST["nombreTratamiento"])){

                $m = new modelEnvatra();

                $datos["nombre"] = recoge("nombreTratamiento");

                if(!$m->getNombreTratamiento($datos["nombre"])){

                    if($m->insertarTratamiento($datos)){
                        header("Location:index.php?ctl=tratamientos&exito=insertar");
                    }else{
                        $params["mensaje"] = "Error al insertar";
                    }
                    
                }else{
                    $params["mensaje"] = "Ya existe un tratamiento con ese nombre";
                    
                }

               }
               
               $params["tratamientos"] = $m->getTratamientosAll();
               require('../app/templates/tratamientos.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }   
        
        public function modificartratamiento(){

            try {

                if(isset($_POST["modNombreTratamiento"])){

                    $m = new modelEnvatra();

                    $nombreRep = false;
    
                    $datos["nombre"] = recoge("modNombreTratamiento");
                    $datos["id"] = $_POST["idTratamiento"];

                    $tratamiento = $m->getTratamientoPorId($datos["id"]);

                    $nombre = $tratamiento["tratamiento"];

                    if($m->getNombreTratamiento( $datos["nombre"])){

                        $nombreRep = true;

                    }
    
                    if(!$nombreRep){
    
                        if($m->modTratamiento($datos)){
                            header("Location:index.php?ctl=tratamientos&exito=modificar");
                        }else{
                            $params["mensaje"] = "Error al modificar";
                        }
                        
                    }else{
                        $params["mensaje"] = "Ya existe un tratamiento con ese nombre";
                        
                    }
    
                   }
                   
                   $params["tratamientos"] = $m->getTratamientosAll();
                    
               
                
                   require('../app/templates/tratamientos.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }

        //*************************************************************FIN TRATAMIENTOS***************************************************************
        //***********************************************************************************************************************************************
        //***********************************************************************************************************************************************

        //*************************************************************INICIO ENFERMEDADES***************************************************************
        //***********************************************************************************************************************************************
        //***********************************************************************************************************************************************
        
        public function enfermedades(){

            try {

                
                require('../app/templates/enfermedades.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }

        public function nuevaEnfermedad(){

            try {

               if(isset($_POST["nombreEnfermedad"])){

                $m = new modelEnvatra();

                $datos["nombre"] = recoge("nombreEnfermedad");

                if(!$m->getNombreEnfermedad($datos["nombre"])){

                    if($m->insertarEnfermedad($datos)){
                        header("Location:index.php?ctl=enfermedades&exito=insertar");
                    }else{
                        $params["mensaje"] = "Error al insertar";
                    }
                    
                }else{
                    $params["mensaje"] = "Ya existe una enfermedad con ese nombre";
                    
                }

               }
               
               $params["tratamientos"] = $m->getEnfermedadesAll();
               require('../app/templates/enfermedades.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }   

        public function modificarEnfermedad(){

            try {

                if(isset($_POST["modNombreEnfermedad"])){

                    $m = new modelEnvatra();

                    $nombreRep = false;
    
                    $datos["nombre"] = recoge("modNombreEnfermedad");
                    $datos["id"] = $_POST["idEnfermedad"];

                    

                    if($m->getNombreEnfermedad( $datos["nombre"])){

                        $nombreRep = true;

                    }
    
                    if(!$nombreRep){
    
                        if($m->modEnfermedad($datos)){
                            header("Location:index.php?ctl=enfermedades&exito=modificar");
                        }else{
                            $params["mensaje"] = "Error al modificar";
                        }
                        
                    }else{
                        $params["mensaje"] = "Ya existe una enfermedad con ese nombre";
                        
                    }
    
                   }
                   
                   $params["tratamientos"] = $m->getEnfermedadesAll();
                    
               
                
                   require('../app/templates/enfermedades.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }



         //*************************************************************FIN ENFERMEDADES***************************************************************
        //***********************************************************************************************************************************************
        //***********************************************************************************************************************************************

         //*************************************************************INICIO VACUNAS***************************************************************
        //***********************************************************************************************************************************************
        //***********************************************************************************************************************************************

        public function vacunas(){

            try {

                
                require('../app/templates/vacunas.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }

        public function nuevaVacuna(){

            try {

               if(isset($_POST["nombreVacuna"])){

                $m = new modelEnvatra();

                $datos["nombre"] = recoge("nombreVacuna");

                if(!$m->getNombreVacuna($datos["nombre"])){

                    if($m->insertarVacuna($datos)){
                        header("Location:index.php?ctl=vacunas&exito=insertar");
                    }else{
                        $params["mensaje"] = "Error al insertar";
                    }
                    
                }else{
                    $params["mensaje"] = "Ya existe una vacuna con ese nombre";
                    
                }

               }
               
               $params["vacunas"] = $m->getVacunasAll();
               require('../app/templates/vacunas.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }   

        public function modificarVacuna(){

            try {

                if(isset($_POST["modNombreVacuna"])){

                    $m = new modelEnvatra();

                    $nombreRep = false;
    
                    $datos["nombre"] = recoge("modNombreVacuna");
                    $datos["id"] = $_POST["idVacuna"];

                    

                    if($m->getNombreVacuna( $datos["nombre"])){

                        $nombreRep = true;

                    }
    
                    if(!$nombreRep){
    
                        if($m->modVacuna($datos)){
                            header("Location:index.php?ctl=vacunas&exito=modificar");
                        }else{
                            $params["mensaje"] = "Error al modificar";
                        }
                        
                    }else{
                        $params["mensaje"] = "Ya existe una vacuna con ese nombre";
                        
                    }
    
                   }
                   
                   $params["vacunas"] = $m->getVacunasAll();
                    
               
                
                   require('../app/templates/vacunas.php');
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }


        }

         //*************************************************************FIN VACUNAS***************************************************************
        //***********************************************************************************************************************************************
        //***********************************************************************************************************************************************
       
    }

?>