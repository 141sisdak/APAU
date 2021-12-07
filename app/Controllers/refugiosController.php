<?php 

    class refugiosController{

        public function refugios(){

            try {

                $m = new modelRefugios();

                $params = array();

                $params["refugios"] = $m->getRefugiosAll();

                
                require('../app/templates/refugios.php');
                
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


        public function nuevoRefugio(){

            try {

                $m = new modelRefugios();

               $nombreRep = false;

                $datos = array();

                $datos["nombre"] = recoge("nombreRefugio");

                

                if($m->getRefugioPorNombre($datos["nombre"])){
                    $nombreRep = true;
                }

                $regla = array(
                    array(
                        'name' => 'nombre',
                        'regla' => 'noEmpty'
                    ),
                  
                );

                $validacionNuevoRefugio = new Validacion();
            
                $valiaciones = $validacionNuevoRefugio->rules($regla, $datos);
    
                if ($valiaciones === true && $nombreRep == false) {

                    $params["refugios"] = $m->getRefugiosAll();

                    $m->insertarNuevoRefugio($datos);
                    header("Location:index.php?ctl=refugios&exito=insertar");

                }else{
                    $params["mensaje"] = "Error en la validación de datos";
                    $params["refugios"] = $m->getRefugiosAll();
                }

                
                require('../app/templates/refugios.php');
                
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

        public function modRefugio(){

            try {

                $m = new modelRefugios();

               $nombreRep = false;

                $datos = array();

                $datos["nombre"] = recoge("modNombreRefugio");
                $datos["idRefugio"] = $_POST["idRefugio"];

                

                if($m->getRefugioPorNombre($datos["nombre"])){
                    $nombreRep = true;
                }

                $regla = array(
                    array(
                        'name' => 'nombre',
                        'regla' => 'noEmpty'
                    ),
                  
                );

                $validacionModRefugio = new Validacion();
            
                $valiaciones = $validacionModRefugio->rules($regla, $datos);
    
                if ($valiaciones === true && $nombreRep == false) {

                    $params["refugios"] = $m->getRefugiosAll();

                    $m->modificarRefugio($datos);
                    header("Location:index.php?ctl=refugios&exito=modificar");

                }else{
                    $params["mensaje"] = "Error en la validación de datos";
                    $params["refugios"] = $m->getRefugiosAll();
                }

                
                require('../app/templates/refugios.php');
                
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

    }

?>