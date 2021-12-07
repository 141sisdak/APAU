<?php
require_once  dirname(__DIR__) . '\Config.php';



class Model extends PDO
{

    protected $conexion;

    public function __construct()
    {
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function validaLogin($usuario, $password){
        $select = $this->conexion->prepare("SELECT id, usuario, rol, telefono, email FROM usuarios WHERE usuario = :usuario AND password = :pass");

        $select->bindValue(":usuario",$usuario);
        $select->bindValue(":pass", $password);

        $select->execute();

        $num_reg = $select->rowCount();

        if($num_reg ==0){
            return false;
        }else{
            return $select->fetch();
        }

    }
    
    public function comprobarPermitido($id){

        $select = $this->conexion->query("SELECT permitido FROM usuarios WHERE id = $id AND permitido = 1");

        $select->execute();

        if($select->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }


    //Estas funciones son para mostrar el resultado en el dashborad
    public function getTotalRescates(){

        $select = $this->conexion->query("SELECT id FROM `ficha_animal` WHERE activo = 1 ");

        $select->execute();

        return $select->rowCount();
    }
    public function getTotalGatos(){

        $select = $this->conexion->query("SELECT SUM(importe) as total FROM `cuentas` WHERE activo = 1 and pagado = 0");
       

        return $select->fetch(PDO::FETCH_ASSOC);

    }

    public function getTotalSocios(){
        $select = $this->conexion->query("SELECT id FROM `socios` WHERE activo = 1 ");

        $select->execute();

        return $select->rowCount();
    }

    public function getTotalDonaciones(){

        $select = $this->conexion->query("SELECT SUM(importe) as total FROM `donaciones` WHERE activo = 1");
       

        return $select->fetch(PDO::FETCH_ASSOC);

    }

    

    
  
   
}
?>
  