<?php 

require_once  dirname(__DIR__) . '\Config.php';

class modelDonaciones extends Model{

protected $conexion;

public function __contruct(){

    parent::__construct();


    }

    public function getDonacionesAll(){

      //$select = $this->conexion->query("SELECT id, nombre, apellidos, fecha, importe FROM donaciones WHERE activo = 1");
      $select = $this->conexion->query("SELECT id, nombre, apellidos, DATE_FORMAT(fecha, '%d-%m-%Y') fecha, importe FROM donaciones WHERE activo = 1");
      

      return $select->fetchAll(PDO::FETCH_ASSOC);

    }
   

    public function insertarDonacion($datos){

        $insert = $this->conexion->prepare("INSERT INTO donaciones 
        (nombre, apellidos, fecha, importe) 
        VALUES (:nombre, :apellidos, :fecha, :importe)");

        $insert->bindValue(":nombre", $datos["nombre"]);
        $insert->bindValue(":apellidos", $datos["apellidosDonacion"]);
        $insert->bindValue(":fecha", $datos["fecha"]);
        $insert->bindValue(":importe", $datos["importe"]);

        return $insert->execute();


    }

    public function getDonacionePorId($id){

      $select = $this->conexion->query("SELECT * FROM donaciones WHERE id = $id");

      return $select->fetch(PDO::FETCH_ASSOC);

    }

    public function modDonacion($datos){

      try{

        $update = $this->conexion->prepare("UPDATE donaciones 
        SET nombre = :nombre, apellidos = :apellidos, fecha = :fecha, importe = :importe 
        WHERE id = :id");
  
        $update->bindValue(":nombre", $datos["nombre"]);
        $update->bindValue(":apellidos", $datos["apellidosDonacion"]);
        $update->bindValue(":fecha", $datos["fecha"]);
        $update->bindValue(":importe", $datos["importe"]);
        $update->bindValue(":id", $datos["idDonacion"]);
  
        return $update->execute();

      } catch (PDOException $e) {
       
    }
    catch (Error $e) {
        error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
    //header('Location: index.php?ctl=error');
    }catch(Exception $e){
      error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
      //header('Location: index.php?ctl=error');
    }
    }

    public function eliminarDonacion($id){

      $update = $this->conexion->query("UPDATE donaciones SET activo = 0 WHERE id = $id");

      return $update->execute();

    }

}


?>