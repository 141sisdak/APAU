<?php 

require_once  dirname(__DIR__) . '\Config.php';

class modelGastos extends Model{

protected $conexion;

public function __contruct(){

    parent::__construct();


    }

public function getGastosAll(){

    $select = $this->conexion->query("SELECT C.id, C.concepto, U.usuario as usuario, C.importe, C.pagado, C.activo
     FROM cuentas C 
     INNER JOIN usuarios U
     ON C.usuario = U.id
     WHERE C.activo = 1");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function getComentarioPorId($id){

    $select = $this->conexion->query("SELECT comentario FROM cuentas WHERE id = $id");


    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function pagarGasto($id){

    $update = $this->conexion->query("UPDATE cuentas SET pagado = 1 WHERE id = $id");

    return $update->execute();

}

public function insertarGasto($datos){

    $insert = $this->conexion->prepare("INSERT INTO cuentas (concepto, usuario, importe, comentario)
    VALUES (:concepto, :usuario, :importe, :comentario)");

    $insert->bindValue(":concepto", $datos["concepto"]);
    $insert->bindValue(":usuario", $datos["idUsuario"]);
    $insert->bindValue(":importe", $datos["importe"]);
    $insert->bindValue(":concepto", $datos["concepto"]);
    $insert->bindValue(":comentario", $datos["comentario"]);

    return $insert->execute();

}
//Devuelve un array con los gastos totales de cada usuario
public function getUsuariosGastos(){

    $select = $this->conexion->query("SELECT U.usuario as usu, sum(C.importe) as importe 
    FROM cuentas C 
    INNER JOIN usuarios U
    ON C.usuario = U.id
    WHERE C.pagado =0 and C.activo =1 
    GROUP BY C.usuario");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function getGastoPorId($id){

    $select = $this->conexion->query("SELECT  C.id, C.concepto, C.usuario, C.importe, C.comentario
    FROM cuentas C
    WHERE C.id = $id");

    return $select->fetch(PDO::FETCH_ASSOC);

}

public function getUsuariosAll(){

    $select = $this->conexion->query("SELECT id, usuario FROM usuarios");

    return $select->fetchAll(PDO::FETCH_ASSOC);

}

public function modGasto($datos){

    $update = $this->conexion->prepare("UPDATE cuentas 
    SET concepto = :concepto, usuario = :usuario, importe = :importe, comentario = :comentario 
    WHERE id = :id");

    $update->bindValue(":concepto", $datos["concepto"]);
    $update->bindValue(":usuario", $datos["usu"]);
    $update->bindValue(":importe", $datos["importe"]);
    $update->bindValue(":comentario", $datos["comentario"]);
    $update->bindValue(":id", $datos["idGasto"]);

    return $update->execute();

}

public function eliminarGasto($id){

    $delete = $this->conexion->query("UPDATE cuentas SET activo = 0 WHERE id = $id");

    return $delete->execute();

}

public function deshacerPago($id){

    $update = $this->conexion->query("UPDATE cuentas SET pagado = 0 WHERE id = $id");;

    return $update->execute();

}


}