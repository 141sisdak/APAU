<?php
require('../app/libs/utils.php');
require('../app/libs/Validacion.php');
require('../app/email.php');

//Email
//require ('../app/phpMailerFiles/Exception.php');
//require ('../app/phpMailerFiles/PHPMailer.php');
//require ('../app/phpMailerFiles/SMTP.php');



class loginController{
    
    public function login()
    {
        try {
            
            $params = array(
                'usuario' => '',
                'password' => ''
            );
            //Si se ha pulsado sobre el boton enviar y se ha enviado el usuario y el password
            if (isset($_POST["enviar"]) && isset($_POST["usuario"]) && isset($_POST["password"])) {
                
                $datos = array();
                
                //Llamamos a la funcion recoge que sanitiza los datos de entrada
                $datos["usuario"]  = recoge("usuario");
                $datos["password"] = recoge("password");
                
                //Creamos un nuevo objeto validacion para poder usar sus funciones
                $validacion = new Validacion();
                
                $regla = array(
                    array(
                        'name' => 'usuario',
                        'regla' => 'no-empty,usuario'
                    ),
                    array(
                        'name' => 'password',
                        //se llama a password 2 para que nos deje meter una contraseña de 3 caracteres.
                        'regla' => 'no-empty,password2'
                    )
                );
                //pasamos a validar los datos
                $validaciones = $validacion->rules($regla, $datos);
                
                //Si no ha habido ningun error procedemos a la validacion del login
                if ($validaciones === true) {

                    $m = new Model();
                    //validaLogin devuelve true si en la consulta hay un resultado distinto de 0

                    

                    if ($resultado = $m->validaLogin($datos["usuario"], $datos["password"])) {

                        if($m->comprobarPermitido($resultado["id"])){
                              
                        $_SESSION["usuario"] = $resultado["usuario"];
                        $_SESSION["rol"]     = $resultado["rol"];
                        $_SESSION["id"] = $resultado["id"];
                        $_SESSION["telefono"] = $resultado["telefono"];
                        $_SESSION["email"] = $resultado["email"];
                        
                        //Si ha ido todo bien redireccionamos a la pagina de inicio
                        header("Location: index.php?ctl=inicio");
                        }else{
                            $params["mensaje"] = "El administrador no te ha concicido permiso de acceso";
                        }
                      
                    }else{
                        header("Location: index.php?ctl=login&falloAut=true");
                    } 
                }
                
            }

            $params["login"] = true;
            //Cargamos la plnatilla login.php
            require('../app/templates/login.php');
            
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

    public function logout(){

        session_destroy();
        session_unset();
        header("Location:index.php?ctl=login");

    }

    public function nuevoUsuario(){

     
            $m = new modelUsuario();
            
            $datos = array();
            
            $datos["usuario"]  = recoge("nombreUsuario");
            $datos["pass1"]    = recoge("pass1");
            $datos["pass2"]    = recoge("pass2");
            $datos["rol"]      =1;     
            $datos["telefono"] = recoge("telefono");
            $datos["email"]    = recoge("email");
            
            $regla = array(
                array(
                    'name' => 'usuario',
                    'regla' => 'letras, noEmpty'
                ),
                array(
                    'name' => 'pass1',
                    'regla' => 'password2, noEmpty'
                ),
                array(
                    'name' => 'pass2',
                    'regla' => 'password2, noEmpty'
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

            $passRep = validaPassRep($datos["pass1"], $datos["pass2"]);
            
            $validacionNuevoUsuario = new Validacion();
            
            $valiaciones = $validacionNuevoUsuario->rules($regla, $datos);

            if(!$m->getNombreUsuario($datos["usuario"])){

                if ($valiaciones === true && $passRep == true) {

                    email::enviarCorreo("alexdaw1920@gmail.com", "Petición de registro",
                    "Mensaje para el administrador: El usuario " . $_POST["nombreUsuario"] . " ha solicitado registrarse en la aplicación
                    \n http://localhost/AUPAU/web/index.php");

                    $m->insertarUsuario($datos);

                }
                } else {
                    $params["mensaje"] = "El nombre de usuario introducido ya existe";
                   
                }
                header("Location:index.php?ctl=login");
    }

    public function recordarUsuPass(){

        $m = new modelUsuario();
            
        $datos = array();
        
        $datos["emailRec"]  = recoge("emailRec");

        $regla = array(
            array(
                'name' => 'emailRec',
                'regla' => 'email, noEmpty'
            ),

        );

        $validacionEmailRec = new Validacion();
            
        $valiaciones = $validacionEmailRec->rules($regla, $datos);

        if($valiaciones === true){

            $usuPass = $m->getUsuPassPorEmail($datos["emailRec"]);

            email::enviarCorreo($datos["emailRec"], "Recuperacion de usuario y contraseña", "Usuario: " . $usuPass["usuario"] . "\nContraseña: " . $usuPass["password"]);

        }

        header("Location:index.php?ctl=login");

    }
    
  

}
?>