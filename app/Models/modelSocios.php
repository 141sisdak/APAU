<?php 

class modelSocios extends Model{

    protected $conexion;

public function __contruct(){

    parent::__construct();


    }


    public function getSociosAll(){

        $select = $this->conexion->query("SELECT * FROM socios WHERE activo = 1");

        return $select->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertarSocio($datos){

        $insert = $this->conexion->prepare("INSERT INTO socios 
        (nombre, apellidos, email, telefono, direccion, num_cuenta, aportacion, pago)
        VALUES (:nombre, :apellidos, :email, :telefono, :direccion, :num_cuenta, :aportacion, :pago)");

        $insert->bindValue(":nombre", $datos["nombreSocio"]);
        $insert->bindValue(":apellidos", $datos["apellidosSocio"]);
        $insert->bindValue(":email", $datos["emailSocio"]);
        $insert->bindValue(":telefono", $datos["telefonoSocio"]);
        $insert->bindValue(":direccion", $datos["direccionSocio"]);
        $insert->bindValue(":num_cuenta", $datos["num_cuentaSocio"]);
        $insert->bindValue(":aportacion", $datos["aportacionSocio"]);
        $insert->bindValue(":pago", $datos["selPago"]);

        return $insert->execute();

    }

    public function modSocio($datos){

        $update = $this->conexion->prepare("UPDATE socios 
        SET nombre = :nombre,
        apellidos = :apellidos,
        email = :email,
        telefono = :telefono,
        direccion = :direccion,
        num_cuenta = :num_cuenta,
        aportacion = :aportacion,
        pago = :pago
        WHERE id = :id");

        $update->bindValue(":nombre", $datos["nombreSocioMod"]);
        $update->bindValue(":apellidos", $datos["apellidosSocioMod"]);
        $update->bindValue(":email", $datos["emailSocioMod"]);
        $update->bindValue(":telefono", $datos["telefonoSocioMod"]);
        $update->bindValue(":direccion", $datos["direccionSocioMod"]);
        $update->bindValue(":num_cuenta", $datos["num_cuentaSocioMod"]);
        $update->bindValue(":aportacion", $datos["aportacionSocioMod"]);
        $update->bindValue(":pago", $datos["selPagoMod"]);
        $update->bindValue(":id", $datos["idSocio"]);

        return $update->execute();

    }

    public function getSocioPorId($id){

        $select = $this->conexion->query("SELECT * FROM socios WHERE id = $id");

        return $select->fetch(PDO::FETCH_ASSOC);

    }

    public function eliminarSocio($id){

        $update = $this->conexion->query("UPDATE socios  SET activo = 0 WHERE id = $id");

        return $update->execute();

    }

}

?>