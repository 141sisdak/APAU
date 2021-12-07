<?php 

require_once  dirname(__DIR__) . '\Config.php';

class modelRefugios extends Model{

protected $conexion;

public function __contruct(){

    parent::__construct();


    }

public function getRefugiosAll(){

    $select = $this->conexion->query("SELECT * FROM refugios WHERE activo = 1 and nombre not in(SELECT nombre from refugios where nombre = 'Por definir')");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function getNombreRefugio($nombreNuevo){

    $select = $this->conexion->prepare("SELECT nombre FROM refugios WHERE nombre = :nombre");

    $select->bindValue(":nombre", $nombreNuevo);

    $select->execute();

    return $select->fetch(PDO::FETCH_ASSOC);

}


public function insertarNuevoRefugio($datos){

    $insert = $this->conexion->prepare("INSERT INTO refugios (nombre) VALUES (:nombre)");

    $insert->bindValue(":nombre", $datos["nombre"]);

    return $insert->execute();

}

public function getRefugioPorNombre($nombre){

    $select = $this->conexion->prepare("SELECT nombre FROM refugios WHERE nombre =:nombre");

    $select->bindValue(":nombre", $nombre);

    $select->execute();

    $numRows = $select->rowCount();

    if($numRows>0){
        return true;
    }else{
        return false;
    }

}

public function modificarRefugio($datos){

    $update = $this->conexion->prepare("UPDATE refugios SET nombre = :nombre WHERE id = :idRefugio");

    $update->bindValue(":nombre", $datos["nombre"]);
    $update->bindValue(":idRefugio", $datos["idRefugio"]);

    return $update->execute();

}

public function eliminarRefugio($id){

    $delete = $this->conexion->prepare("UPDATE refugios SET activo = 0 WHERE id = :id");

    $delete->bindValue(":id", $id);

    return $delete->execute();

}


}

?>