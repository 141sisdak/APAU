<?php
// web/index.php
// carga del modelo y los controladores
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/Models/Model.php';

//Controladores
require_once __DIR__ . '/../app/Controllers/loginController.php';
require_once __DIR__ . '/../app/Controllers/inicioController.php';
require_once __DIR__ . '/../app/Controllers/rescateController.php';
require_once __DIR__ . '/../app/Controllers/pcController.php';
require_once __DIR__ . '/../app/Controllers/usuariosController.php';
require_once __DIR__ . '/../app/Controllers/adoptanteController.php';
require_once __DIR__ . '/../app/Controllers/refugiosController.php';
require_once __DIR__ . '/../app/Controllers/envatraController.php';
require_once __DIR__ . '/../app/Controllers/gastosController.php';
require_once __DIR__ . '/../app/Controllers/sociosController.php';
require_once __DIR__ . '/../app/Controllers/donacionesController.php';

//Modelos
require_once __DIR__ . '/../app/Models/modelRescate.php';
require_once __DIR__ . '/../app/Models/modelUsuario.php';
require_once __DIR__ . '/../app/Models/modelAdoptante.php';
require_once __DIR__ . '/../app/Models/modelRefugios.php';
require_once __DIR__ . '/../app/Models/modelEnvatra.php';
require_once __DIR__ . '/../app/Models/modelGastos.php';
require_once __DIR__ . '/../app/Models/modelSocios.php';
require_once __DIR__ . '/../app/Models/modelDonaciones.php';

//PHPMailer

require_once __DIR__ . '/../app/email.php';

session_start();
//Si todavía no se ha iniciado sesión inicializamos la variable sesion(rol) a 0 para que pueda acceder a login y registro
if(!isset($_SESSION["usuario"])){
    $_SESSION["rol"] = 0;
}
/*
//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo']) ) {
    
    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 900;//15min
    
    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
    
    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $inactivo)
    {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();
        //Redirigimos pagina.
        header("Location: index.php?ctl=login");
        
        exit();
    }
} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
*/
// enrutamiento
$map = array(
    
    'inicio' => array(
        'controller' => 'inicioController',
        'action' => 'inicio',
        'nivel' =>1
    ),
    'login'=>array(
        'controller'=>'loginController',
        'action'=>'login',
        'nivel'=> 0
    ),
    'recordarUsuPass'=>array(
        'controller'=>'loginController',
        'action'=>'recordarUsuPass',
        'nivel'=> 0
    ),
    

    'modPerfil'=>array(
        'controller'=>'usuariosController',
        'action'=>'modPerfil',
        'nivel'=> 1
    ),
    'modPass'=>array(
        'controller'=>'usuariosController',
        'action'=>'modPass',
        'nivel'=> "1"
    ),
   
    
    'logout'=>array(
        'controller'=>'loginController',
        'action'=>'logout',
        'nivel'=> 0
    ),
    'rescate'=>array(
        'controller'=>'rescateController',
        'action'=>'rescate',
        'nivel'=> 1
    ),
    'verAnimal'=>array(
        'controller'=>'rescateController',
        'action'=>'verAnimal',
        'nivel'=> 1
    ),
    
    'nuevoRescate'=>array(
        'controller'=>'rescateController',
        'action'=>'nuevoRescate',
        'nivel'=> 1
    ),
    'modificarRescate'=>array(
        'controller'=>'rescateController',
        'action'=>'modificarRescate',
        'nivel'=> 1
    ),
    'eliminarRescate'=>array(
        'controller'=>'rescateController',
        'action'=>'eliminarRescate',
        'nivel'=> 1
    ), 
    'panelControl'=>array(
        'controller'=>'pcController',
        'action'=>'panelControl',
        'nivel'=> 2
    ),
    'usuarios'=>array(
        'controller'=>'usuariosController',
        'action'=>'usuarios',
        'nivel'=> 2
    ),
    'nuevoUsuario'=>array(
        'controller'=>'loginController',
        'action'=>'nuevoUsuario',
        'nivel'=> 0
    ),
    'modUsuario'=>array(
        'controller'=>'usuariosController',
        'action'=>'modUsuario',
        'nivel'=> 2
    ),
    'adoptante'=>array(
        'controller'=>'adoptanteController',
        'action'=>'adoptante',
        'nivel'=> 2
    ), 
    'nuevoAdoptante'=>array(
        'controller'=>'adoptanteController',
        'action'=>'nuevoAdoptante',
        'nivel'=> 2
    ),
    'modAdoptante'=>array(
        'controller'=>'adoptanteController',
        'action'=>'modificarAdoptante',
        'nivel'=> 2
    ),
    'refugios'=>array(
        'controller'=>'refugiosController',
        'action'=>'refugios',
        'nivel'=> 2
    ),
    'nuevoRefugio'=>array(
        'controller'=>'refugiosController',
        'action'=>'nuevoRefugio',
        'nivel'=> 2
    ),
    'modificarRefugio'=>array(
        'controller'=>'refugiosController',
        'action'=>'modRefugio',
        'nivel'=> 2
    ),
    'tratamientos'=>array(
        'controller'=>'envatraController',
        'action'=>'tratamientos',
        'nivel'=> 2
    ),
    'nuevoTratamiento'=>array(
        'controller'=>'envatraController',
        'action'=>'nuevoTratamiento',
        'nivel'=> 2
    ),
    'modificarTratamiento'=>array(
        'controller'=>'envatraController',
        'action'=>'modificarTratamiento',
        'nivel'=> 2
    ),
    'enfermedades'=>array(
        'controller'=>'envatraController',
        'action'=>'enfermedades',
        'nivel'=> 2
    ),
    'modificarEnfermedad'=>array(
        'controller'=>'envatraController',
        'action'=>'modificarEnfermedad',
        'nivel'=> 2
    ),
    'nuevaEnfermedad'=>array(
        'controller'=>'envatraController',
        'action'=>'nuevaEnfermedad',
        'nivel'=> 2
    ),
    'vacunas'=>array(
        'controller'=>'envatraController',
        'action'=>'vacunas',
        'nivel'=> 2
    ),
    'nuevaVacuna'=>array(
        'controller'=>'envatraController',
        'action'=>'nuevaVacuna',
        'nivel'=> 2
    ),
    'modificarVacuna'=>array(
        'controller'=>'envatraController',
        'action'=>'modificarVacuna',
        'nivel'=> 2
    ),
    'gastos'=>array(
        'controller'=>'gastosController',
        'action'=>'gastos',
        'nivel'=> 1
    ),
    'nuevoGasto'=>array(
        'controller'=>'gastosController',
        'action'=>'nuevoGasto',
        'nivel'=> 2
    ),
    'gastosPc'=>array(
        'controller'=>'gastosController',
        'action'=>'gastosPc',
        'nivel'=> 2
    ),
    'modificarGasto'=>array(
        'controller'=>'gastosController',
        'action'=>'modificarGasto',
        'nivel'=> 2
    ),
    'socios'=>array(
        'controller'=>'sociosController',
        'action'=>'socios',
        'nivel'=> 1
    ),
    'nuevoSocio'=>array(
        'controller'=>'sociosController',
        'action'=>'nuevoSocio',
        'nivel'=> 1
    ),
    'modificarSocio'=>array(
        'controller'=>'sociosController',
        'action'=>'modificarSocio',
        'nivel'=> 1
    ),
    'donaciones'=>array(
        'controller'=>'donacionesController',
        'action'=>'donaciones',
        'nivel'=> 1
    ),
    'nuevaDonacion'=>array(
        'controller'=>'donacionesController',
        'action'=>'nuevaDonacion',
        'nivel'=> 2
    ),
    'modificarDonacion'=>array(
        'controller'=>'donacionesController',
        'action'=>'modificarDonacion',
        'nivel'=> 2
    )
);
// Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {
        //página a la que el usuario ha intentado acceder en caso de que no exista
        header('HTTP/1.0 404 Not Found');
        error_log("El usuario " .$_SESSION["usuario"] . " ha intentado acceder a ". $_GET['ctl']. " el " . date("d-m-Y") . PHP_EOL, 3, "errores_no_valido.txt");
        include __DIR__ . '/../app/templates/404.php';
        exit;

        
          
    }
} else {
    $ruta = 'login';
}
$controlador = $map[$ruta];


if (method_exists($controlador['controller'], $controlador['action']) && $controlador["nivel"]<=$_SESSION["rol"]) {
    
    call_user_func(array(
        new $controlador['controller'](),
        $controlador['action']
        
    ));
} else {
    //Si el usuario no tiene permiso para acceder a la páquina guardamos el registro en un archivo con su nombre,
    //la fecha y la página tanto si ha iniciado sesión como si no.
    if($_SESSION["rol"]<$controlador["nivel"]){
       
        header("Status: 403 Forbidden");
        include __DIR__ . '/../app/templates/403.php';
        error_log("El usuario " .$_SESSION["usuario"] . " ha intentado acceder a ". $_GET['ctl']. " el " . date("d-m-Y") . PHP_EOL, 3, "errores_acceso.txt");
        exit;
       
        
    }
    
}
?>