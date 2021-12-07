<?php 

require_once  dirname(__DIR__) . '\Config.php';

class modelUsuario extends Model{

protected $conexion;

public function __contruct(){

    parent::__construct();


    }

    public function getUsuarios(){

        $select = $this->conexion->query("SELECT U.id, usuario, permitido, fecha_alta, fecha_baja, telefono, email, activo, R.rol as rol FROM usuarios U INNER JOIN roles R ON U.rol = R.id WHERE activo = 1 ORDER BY usuario");

        return $select->fetchAll(PDO::FETCH_ASSOC);

    }

    
    public function insertarUsuario($datos){

        $hoy = date("Y-m-d", time());
        
        $insert = $this->conexion->prepare("INSERT INTO usuarios (usuario, password, rol, fecha_alta, telefono, email) VALUES (:usuario, :password, :rol, :fecha_alta, :telefono, :email)");

        $insert->bindValue(":usuario", $datos["usuario"]);
        $insert->bindValue(":password", $datos["pass1"]);
        $insert->bindValue(":rol", $datos["rol"]);
        $insert->bindValue(":fecha_alta", $hoy);
        $insert->bindValue(":telefono", $datos["telefono"]);
        $insert->bindValue(":email", $datos["email"]);

        return $insert->execute();
    }


    public function  getNombreUsuario($nombreNuevo){

        $select = $this->conexion->prepare("SELECT usuario FROM usuarios WHERE usuario = :usuario");

        $select->bindValue(":usuario", $nombreNuevo);

        $select->execute();

        return $select->fetch(PDO::FETCH_ASSOC);

    }

    public function getUsuarioPorNombre($nombre){

        $select = $this->conexion->query("SELECT * FROM usuarios WHERE usuario = '$nombre'");

        return $select->fetch(PDO::FETCH_ASSOC);

    }

    public function getUsuarioPorId($id){

        $select = $this->conexion->query("SELECT * FROM usuarios WHERE id = $id");

        return $select->fetch(PDO::FETCH_ASSOC);

    }
    
    public function modificarUsuario($datos){

        $insert = $this->conexion->prepare("UPDATE usuarios SET usuario=:usuario, rol=:rol, telefono=:telefono, email=:email WHERE id = :idUsuario");

        $insert->bindValue(":usuario", $datos["usuario"]);
        $insert->bindValue(":rol", $datos["rol"]);
        $insert->bindValue(":telefono", $datos["telefono"]);
        $insert->bindValue(":email", $datos["email"]);
        $insert->bindValue(":idUsuario", $datos["idUsuario"]);

        return $insert->execute();

    }

    public function eliminarUsuario($id){

        $hoy = date("Y-m-d", time());

        $delete = $this->conexion->query("UPDATE usuarios SET activo = 0, fecha_baja= '$hoy' WHERE id = '$id'");

        return $delete->execute();

    }

    public function permitirUsuario($id){

        $update = $this->conexion->query("UPDATE usuarios SET permitido = 1 WHERE id = $id");
        return $update->execute();

    }

    public function getEmail($email){

        $select = $this->conexion->prepare("SELECT email FROM usuarios WHERE email= :email");

        $select->bindValue(":email", $email);

        $select->execute();

        if($select->rowCount()==0){
            return false;
        }else{
            return true;
        }
    }

    public function getUsuPassPorEmail($email){

        $select = $this->conexion->prepare("SELECT usuario, password FROM usuarios WHERE email = :email");

        $select->bindValue(":email", $email);

        $select->execute();

        return $select->fetch(PDO::FETCH_ASSOC);

    }

    public function modPerfil($id, $email, $telefono){

        $update = $this->conexion->prepare("UPDATE usuarios SET email = :email, telefono = :telefno WHERE id = :id");

        $update->bindValue(":email", $email);
        $update->bindValue(":telefno", $telefono);
        $update->bindValue(":id", $id);

        return $update->execute();
    }

    public function getPass($id, $pass){

        $select = $this->conexion->query("SELECT password FROM usuarios WHERE id = $id AND password = $pass");

        $select->execute();

        if($select->rowCount()==0){
            return false;
        }else{
            return true;
        }

    }

    public function updatePass($id, $pass){

        $update = $this->conexion->prepare("UPDATE usuarios SET password = :pass WHERE id = :id");

        $update->bindValue(":pass", $pass);
        $update->bindValue(":id", $id);

       return $update->execute();

    }

 

}

?>