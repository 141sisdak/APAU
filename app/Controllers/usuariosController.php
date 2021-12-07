
<?php

class usuariosController
{
        
    public function usuarios()
    {   
        try {
            
            $m = new modelUsuario();
            
            $params["usuarios"] = $m->getUsuarios();
            setearNulosTabla($params["usuarios"]);
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }
        
        require('../app/templates/usuarios.php');
        
        
    }
    
   

    public function modUsuario(){
        //No ve el $_POST del boton de enviar
        //if(isset($_POST["btnModUsuario"])){

            $nombreUsuModificado = false;
            
            $m = new modelUsuario();

            $datos = array();
            
            $datos["usuario"]  = recoge("modNombreUsuario");

            $usuario = $m->getUsuarioPorId($_POST["idUsuario"]);

            $nombreAnterior = $usuario["usuario"];

            if($nombreAnterior != $datos["usuario"]){
                
               $nombreUsuModificado = true;
            }
           
            $datos["rol"]      = $_POST["modRolesSelect"];
            $datos["telefono"] = recoge("modTelefono");
            $datos["email"]    = recoge("modEmail");
            $datos["idUsuario"] = $_POST["idUsuario"];
            
            $regla = array(
                array(
                    'name' => 'usuario',
                    'regla' => 'letras, noEmpty'
                ),
                array(
                    'name' => 'telefono',
                    'regla' => 'telefono'
                ),
                array(
                    'name' => 'email',
                    'regla' => 'email'
                )
            );

            
            $validacionModUsuario = new Validacion();
            
            $valiaciones = $validacionModUsuario->rules($regla, $datos);

            if ($valiaciones === true) {
                //Se ha cambiado el nombre de usuario y dicho nombre NO esta ya en la bd
                if($nombreUsuModificado && !$m->getNombreUsuario($datos["usuario"]) || !$nombreUsuModificado){
                    setearANull($datos);
                    if ($m->modificarUsuario($datos)) {
                       
                        header("Location:index.php?ctl=usuarios&exito=modificar");
                    }
                    
                } else {
                    //Se ha modificado el nombre de usuario y dicho nombre SI existe en la bd
                    if($nombreUsuModificado && $m->getNombreUsuario($datos["usuario"])){
                        $params["usuarios"] = $m->getUsuarios();
                        setearNulosTabla($params["usuarios"]);
                        $params["mensaje"] = "Error al modificar, el usuario ya existe";
                    }
                   
                }
            }else{
                $params["usuarios"] = $m->getUsuarios();
                setearNulosTabla($params["usuarios"]);
                $params["mensaje"] = "Error al modificar, datos inválidos";
                }

        //}

        require('../app/templates/usuarios.php');

    }

    public function modPerfil(){

      
        $m = new modelUsuario();

        $params["usuarios"] = $m->getUsuarios();
        setearNulosTabla($params["usuarios"]);

        $datos = array();
        
        $datos["email"]  = recoge("emailMod");
        $datos["telefono"]  = recoge("telfMod");
        
        $regla = array(
          
            array(
                'name' => 'telefono',
                'regla' => 'telefono'
            ),
            array(
                'name' => 'email',
                'regla' => 'email'
            )
        );

        
        $validacionModUsuario = new Validacion();
        
        $valiaciones = $validacionModUsuario->rules($regla, $datos);

        if($valiaciones ===true){

            if($m->modPerfil($_SESSION["id"], $datos["email"], $datos["telefono"])){
                $_SESSION["email"] = $datos["email"];
                $_SESSION["telefono"] = $datos["telefono"];
                $params["mensaje"] = "¡Éxito en la modificación!";
                
            }

        }

        if(isset($_POST["modnav"])){
            $ctlIndex = strpos($_POST["actual"],"=");
            $ctl = substr($_POST["actual"], $ctlIndex);
            header("Location:index.php?ctl". $ctl . "&modPerf=perf");
        }else

        require('../app/templates/usuarios.php');
    }

    public function modPass(){

        $m = new modelUsuario();

        $datos = array();
        
        $datos["passAct"]  = recoge("passAct");
        $datos["passMod1"]  = recoge("passMod1");
        $datos["passMod2"]  = recoge("passMod2");
        
        $regla = array(
          
            array(
                'name' => 'passAct',
                'regla' => 'noEmpty, password2'
            ),
            array(
                'name' => 'passMod1',
                'regla' => 'noEmpty, password2'
            ),
            array(
                'name' => 'passMod2',
                'regla' => 'noEmpty, password2'
            )
        );

        
        $validacionModUsuario = new Validacion();
        
        $valiaciones = $validacionModUsuario->rules($regla, $datos);

        if($valiaciones ===true && $m->getPass($_SESSION["id"],$datos["passAct"])==true){

            if($m->updatePass($_SESSION["id"], $datos["passMod1"])){

                $params["mensaje"] = "¡Contraseña cambiada con éxito!";

            }

        }else{
            $params["mensajeError"] = "Se ha producido un error en el proceso, porfavor revisa los datos introducidos";
        }

        if(isset($_POST["modnavCont"])){
            $ctlIndex = strpos($_POST["actualCont"],"=");
            $ctl = substr($_POST["actualCont"], $ctlIndex);
            header("Location:index.php?ctl". $ctl . "&modPerf=pass");
        }else

        require('../app/templates/usuarios.php');

    }
    
}

    


?>

