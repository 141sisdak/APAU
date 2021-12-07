<?php 

require_once  dirname(__DIR__) . '\Config.php';

class modelAdoptante extends Model{

protected $conexion;

public function __contruct(){

    parent::__construct();


    }

public function getAdoptantes(){

    $select = $this->conexion->query("SELECT A.id, A.nombre, A.apellidos, A.telefono1, A.telefono2, A.email, A.direccion, A.provincia, L.localidad as localidad, A.dni, A.num_mascotas 
    FROM adoptante A
    INNER JOIN localidades L
    ON A.localidad = L.id
    WHERE activo = 1");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function getLocalidades(){

    $select = $this->conexion->query("SELECT * FROM localidades");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function nuevoAdoptante($datos){

    $insert = $this->conexion->prepare("INSERT INTO adoptante 
            (nombre, apellidos, telefono1, telefono2, comentarios, email, direccion, provincia, localidad, dni, num_mascotas)
            VALUES (:nombre, :apellidos, :telefono1, :telefono2, :comentarios, :email, :direccion, :provincia, :localidad, :dni, :num_mascotas)");
    
            $insert->bindValue(":nombre",$datos["nombre"]);
            $insert->bindValue(":apellidos",$datos["apellidos"]);
            $insert->bindValue(":telefono1",$datos["telefono1"]);
            $insert->bindValue(":telefono2",$datos["telefono2"]);
            $insert->bindValue(":comentarios", $datos["comentarios"]);
            $insert->bindValue(":email",$datos["email"]);
            $insert->bindValue(":direccion",$datos["direccion"]);
            $insert->bindValue(":provincia",$datos["provincia"]);
            $insert->bindValue(":localidad",$datos["localidad"]);
            $insert->bindValue(":dni",$datos["dniAdop"]);
            $insert->bindValue(":num_mascotas",$datos["num_mascotas"]);
           
            return $insert->execute();

}

public function getAdoptantePorId($id){

   $select = $this->conexion->query("SELECT * FROM adoptante WHERE id = $id");

   return $select->fetch(PDO::FETCH_ASSOC);

}

public function getAdoptantePorDni($dni){

    $select = $this->conexion->query("SELECT dni FROM adoptante WHERE dni = '$dni'");

   return $select->fetch(PDO::FETCH_ASSOC);

}

public function modificarAdoptante($datos){

    $insert = $this->conexion->prepare("UPDATE adoptante 
    SET nombre =:nombre, 
    apellidos = :apellidos,
    telefono1 = :telefono1,
    telefono2 = :telefono2,
    comentarios = :comentarios,
    email = :email,
    direccion = :direccion,
    provincia = :provincia,
    localidad = :localidad,
    dni = :dni,
    num_mascotas = :num_mascotas
    WHERE id = :id");

    $insert->bindValue(":id", $datos["idAdoptante"]);
    $insert->bindValue(":nombre", $datos["nombre"]);
    $insert->bindValue(":apellidos", $datos["apellidos"]);
    $insert->bindValue(":telefono1", $datos["telefono1"]);
    $insert->bindValue(":telefono2", $datos["telefono2"]);
    $insert->bindValue(":comentarios", $datos["comentarios"]);
    $insert->bindValue(":email", $datos["email"]);
    $insert->bindValue(":direccion", $datos["direccion"]);
    $insert->bindValue(":provincia", $datos["provincia"]);
    $insert->bindValue(":localidad", $datos["localidad"]);
    $insert->bindValue(":dni", $datos["dniAdop"]);
    $insert->bindValue(":num_mascotas", $datos["num_mascotas"]);
    $insert->bindValue(":apellidos", $datos["apellidos"]);


    return $insert->execute();


}

public function eliminarAdoptante($id){

    $delete = $this->conexion->query("UPDATE adoptante SET activo = 0 WHERE id = $id");

    return $delete->execute();

}





}