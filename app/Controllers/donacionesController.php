<?php 

class donacionesController{


    public function donaciones(){

        $m = new modelDonaciones();

          
        try {
            
          
            if($params["donaciones"] = $m->getDonacionesAll()){
               
                setearNulosTabla($params["donaciones"]);
                
            }else{
                $params["mensaje"] = "No existen adoptantes";
            }
            
            
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }
        
        require('../app/templates/donaciones.php');


    }

    public function nuevaDonacion(){

        $m = new modelDonaciones();

          
        try {
            
          if(isset($_POST["importe"]) && isset($_POST["nombre"])){

            $datos = array();

            $datos["nombre"] = recoge("nombre");
            $datos["apellidosDonacion"] = recoge("apellidos");
            if(isset($_POST["fecha"]) && $_POST["fecha"] !=""){
                $datos["fecha"] = recoge("fecha");
            }else{
                $datos["fecha"] = date("Y-m-d");
            }
           
            $datos["importe"] = recoge("importe");
            
            $regla = array(
                array(
                    'name' => 'nombre',
                    'regla' => 'letras, noEmpty'
                ),
                array(
                    'name' => 'apellidosDonacion',
                    'regla' => 'apellidos'
                ),
                array(
                    'name' => 'fecha',
                    'regla' => 'fechaSuperior'
                ),
                array(
                    'name' => 'importe',
                    'regla' => 'numeric'
                )

                );

                $validacionNuevDonacion = new Validacion();
            
                $valiaciones = $validacionNuevDonacion->rules($regla, $datos);

                if($valiaciones === true){

                    if($m->insertarDonacion($datos)){
                        header("Location: index.php?ctl=donaciones&exito=insertar");
                    }else{
                        $params["mensaje"] = "Error al insertar";
                    }

                }else{
                    $params["mensaje"] = "Fallo en la validación";
                }

          }
            
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }

        if($params["donaciones"] = $m->getDonacionesAll()){
               
            setearNulosTabla($params["donaciones"]);
            
        }else{
            $params["mensaje"] = "No existen adoptantes";
        }
        
        require('../app/templates/adoptante.php');

    }

    public function modificarDonacion(){

        $m = new modelDonaciones();

          
        try {
            
          if(isset($_POST["nombreDonacionMod"]) && isset($_POST["importeDonacionMod"])){

            $datos = array();

            $datos["nombre"] = recoge("nombreDonacionMod");
            $datos["apellidosDonacion"] = recoge("apellidosDonacionMod");
            if(isset($_POST["fechaDonacionMod"]) && $_POST["fechaDonacionMod"] !=""){
                $datos["fecha"] = recoge("fechaDonacionMod");
            }else{
                $datos["fecha"] = date("Y-m-d");
            }
           
            $datos["importe"] = recoge("importeDonacionMod");
            $datos["idDonacion"] = recoge("idDonacion");
            
            $regla = array(
                array(
                    'name' => 'nombre',
                    'regla' => 'letras, noEmpty'
                ),
                array(
                    'name' => 'apellidosDonacion',
                    'regla' => 'apellidos'
                ),
                array(
                    'name' => 'fecha',
                    'regla' => 'fechaSuperior'
                ),
                array(
                    'name' => 'importe',
                    'regla' => 'numeric'
                )

                );

                $validacionModDonacion = new Validacion();
            
                $valiaciones = $validacionModDonacion->rules($regla, $datos);

                if($valiaciones === true){

                    if($m->modDonacion($datos)){
                        header("Location: index.php?ctl=donaciones&exito=modificar");
                    }else{
                        $params["mensaje"] = "Error al modificar";
                    }

                }else{
                    $params["mensaje"] = "Fallo en la validación";
                }

          }else{
            $params["mensaje"] = "Faltan datos obligatorios";
          }
            
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }

        if($params["donaciones"] = $m->getDonacionesAll()){
               
            setearNulosTabla($params["donaciones"]);
            
        }else{
            $params["mensaje"] = "No existen adoptantes";
        }
        
        require('../app/templates/adoptante.php');

    }


}

?>