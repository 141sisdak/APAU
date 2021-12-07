<?php 

require_once  dirname(__DIR__) . '\Config.php';

class modelEnvatra extends Model{

protected $conexion;

public function __contruct(){

    parent::__construct();


    }
/*
*********************************************************INICIO TRATAMIENTOS***********************************************************************
***************************************************************************************************************************************************
***************************************************************************************************************************************************

*/
public function getTratamientosAll(){

    $select = $this->conexion->query("SELECT * FROM tratamientos WHERE activo = 1");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}


public function getNombreTratamiento($nombre){

    $select = $this->conexion->query("SELECT tratamiento FROM tratamientos WHERE tratamiento = '$nombre'");

    return $select->fetch(PDO::FETCH_ASSOC);


}

public function insertarTratamiento($datos){

    $insert = $this->conexion->prepare("INSERT INTO tratamientos (tratamiento) VALUES (:nombre)");

    $insert->bindValue(":nombre", $datos["nombre"]);

    return $insert->execute();

}

public function getTratamientoPorId($id){

    $select = $this->conexion->query("SELECT tratamiento FROM tratamientos WHERE id = $id");

    return $select->fetch(PDO::FETCH_ASSOC);

}

public function modTratamiento($datos){

    $update = $this->conexion->prepare("UPDATE tratamientos SET tratamiento = :nombre WHERE id = :id");

    $update->bindValue(":nombre", $datos["nombre"]);
    $update->bindValue(":id", $datos["id"]);

    return $update->execute();

}

public function eliminarTratamiento($id){

    $update = $this->conexion->query("UPDATE tratamientos SET activo = 0 WHERE id = $id");

    return $update->execute();

}

/*
*********************************************************FIN TRATAMIENTOS***********************************************************************
***************************************************************************************************************************************************
***************************************************************************************************************************************************

*/

/*
*********************************************************INICIO ENFERMEDADES***********************************************************************
***************************************************************************************************************************************************
***************************************************************************************************************************************************

*/

public function getEnfermedadesAll(){

    $select = $this->conexion->query("SELECT * FROM enfermedades WHERE activo = 1 ORDER BY enfermedad");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function getNombreEnfermedad($nombre){

    $select = $this->conexion->query("SELECT enfermedad FROM enfermedades WHERE enfermedad = '$nombre'");

    return $select->fetch(PDO::FETCH_ASSOC);

}

public function insertarEnfermedad($datos){


    $insert = $this->conexion->prepare("INSERT INTO enfermedades (enfermedad) VALUES (:nombre)");

    $insert->bindValue(":nombre", $datos["nombre"]);

    return $insert->execute();
}

public function getEnfermedadPorId($id){

    $select = $this->conexion->query("SELECT enfermedad FROM enfermedades WHERE id = $id");

    return $select->fetch(PDO::FETCH_ASSOC);

}

public function modEnfermedad($datos){

    $update = $this->conexion->prepare("UPDATE enfermedades SET enfermedad = :nombre WHERE id = :id");

    $update->bindValue(":nombre", $datos["nombre"]);
    $update->bindValue(":id", $datos["id"]);

    return $update->execute();

}

public function eliminarEnfermedad($id){

    $update = $this->conexion->query("UPDATE enfermedades SET activo = 0 WHERE id = $id");

    return $update->execute();

}

/*
*********************************************************FIN ENFERMEADES***********************************************************************
***************************************************************************************************************************************************
***************************************************************************************************************************************************

*/

/*
*********************************************************INICIO VACUNAS***********************************************************************
***************************************************************************************************************************************************
***************************************************************************************************************************************************

*/
public function getVacunasAll(){

    $select = $this->conexion->query("SELECT * FROM vacunas WHERE activo = 1 ORDER BY nombre");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function getNombreVacuna($nombre){

    $select = $this->conexion->query("SELECT nombre FROM vacunas WHERE nombre = '$nombre'");

    return $select->fetch(PDO::FETCH_ASSOC);

}

public function insertarVacuna($datos){


    $insert = $this->conexion->prepare("INSERT INTO vacunas (nombre) VALUES (:nombre)");

    $insert->bindValue(":nombre", $datos["nombre"]);

    return $insert->execute();
}

public function getVacunaPorId($id){

    $select = $this->conexion->query("SELECT nombre FROM vacunas WHERE id = $id");

    return $select->fetch(PDO::FETCH_ASSOC);

}

public function modVacuna($datos){

    $update = $this->conexion->prepare("UPDATE vacunas SET nombre = :nombre WHERE id = :id");

    $update->bindValue(":nombre", $datos["nombre"]);
    $update->bindValue(":id", $datos["id"]);

    return $update->execute();

}

public function eliminarVacuna($id){

    $update = $this->conexion->query("UPDATE enfermedades SET activo = 0 WHERE id = $id");

    return $update->execute();

}
/*
*********************************************************FIN VACUNAS***********************************************************************
***************************************************************************************************************************************************
***************************************************************************************************************************************************

*/
}

?>