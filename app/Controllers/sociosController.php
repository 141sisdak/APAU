<?php 

class sociosController{

    public function socios(){

        $m = new modelSocios();

          
        try {
            
          
            if($params["socios"] = $m->getSociosAll()){
                
                setearNulosTabla($params["socios"]);
                
            }else{
                $params["mensaje"] = "No existen socios";
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
        
        require('../app/templates/socios.php');

    }

    public function nuevoSocio(){

        $m = new modelSocios();

          
        try {
            
          if(isset($_POST["nombreSocio"])){
              
            $datos["nombreSocio"] = recoge("nombreSocio");
            $datos["apellidosSocio"] = recoge("apellidosSocio");
            $datos["emailSocio"] = recoge("emailSocio");
            $datos["telefonoSocio"] = recoge("telefonoSocio");
            $datos["direccionSocio"] = recoge("direccionSocio");
            $datos["num_cuentaSocio"] = recoge("num_cuentaSocio");
            $datos["aportacionSocio"] = recoge("aportacionSocio");
            $datos["selPago"] = $_POST["selPago"];
            

            $regla = array(
                array(
                    'name'=> 'nombreSocio',
                    'regla'=>'noEmpty,letras'
                ),
                array(
                    'name'=> 'apellidosSocio',
                    'regla'=>'apellidos'
                ),
                array(
                    'name'=> 'emailSocio',
                    'regla'=>'email'
                ),
                array(
                    'name'=> 'telefonoSocio',
                    'regla'=>'numeric, telefono'
                ),
                array(
                    'name'=> 'num_cuentaSocio',
                    'regla'=>'numCuenta'
                ),
                array(
                    'name'=> 'aportacionSocio',
                    'regla'=>'numeric'
                ),
               
            );

             $validacionNuevoSocio = new Validacion();
             $validaciones = $validacionNuevoSocio->rules($regla, $datos);

             if ($validaciones === true) {

                if($m->insertarSocio($datos)){
                    header("Location:index.php?ctl=socios&exito=insertar");
                }else{
                    $params["mensaje"] = "Error en la inserción";
                }
             }else{
                 $params["menasje"] = "Error en las validaciones";
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

        if($params["socios"] = $m->getSociosAll()){
                
            setearNulosTabla($params["socios"]);
            
        }else{
            $params["mensaje"] = "No existen socios";
        }
        
        require('../app/templates/socios.php');

    }

    public function modificarSocio(){

        $m = new modelSocios();

          
        try {
            
          if(isset($_POST["nombreSocioMod"])){
              
            $datos["nombreSocioMod"] = recoge("nombreSocioMod");
            $datos["apellidosSocioMod"] = recoge("apellidosSocioMod");
            $datos["emailSocioMod"] = recoge("emailSocioMod");
            $datos["telefonoSocioMod"] = recoge("telefonoSocioMod");
            $datos["direccionSocioMod"] = recoge("direccionSocioMod");
            $datos["num_cuentaSocioMod"] = recoge("num_cuentaSocioMod");
            $datos["aportacionSocioMod"] = recoge("aportacionSocioMod");
            $datos["selPagoMod"] = $_POST["selPagoMod"];
            $datos["idSocio"] = $_POST["idSocio"];
            

            $regla = array(
                array(
                    'name'=> 'nombreSocioMod',
                    'regla'=>'noEmpty,letras'
                ),
                array(
                    'name'=> 'apellidosSocioMod',
                    'regla'=>'apellidos'
                ),
                array(
                    'name'=> 'emailSocioMod',
                    'regla'=>'email'
                ),
                array(
                    'name'=> 'telefonoSocioMod',
                    'regla'=>'numeric, telefono'
                ),
                array(
                    'name'=> 'num_cuentaSocioMod',
                    'regla'=>'numCuenta'
                ),
                array(
                    'name'=> 'aportacionSocioMod',
                    'regla'=>'numeric'
                ),
               
            );

             $validacionModSocio = new Validacion();
             $validaciones = $validacionModSocio->rules($regla, $datos);

             if ($validaciones === true) {

                if($m->modSocio($datos)){
                    header("Location:index.php?ctl=socios&exito=modificar");
                }else{
                    $params["mensaje"] = "Error en la modificación";
                }
             }else{
                 $params["menasje"] = "Error en las validaciones";
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

        if($params["socios"] = $m->getSociosAll()){
                
            setearNulosTabla($params["socios"]);
            
        }else{
            $params["mensaje"] = "No existen socios";
        }
        
        require('../app/templates/socios.php');

    }


}

?>