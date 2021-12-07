
<?php 

require_once  dirname(__DIR__) . '\Config.php';

class modelRescate extends Model{

protected $conexion;

public function __contruct(){

    parent::__construct();


    }

    public function getRescatesAll(){
        
        $select = $this->conexion->query(
            "SELECT 
            F.id, 
            F.nombre, 
            F.fechaNac,
            F.fechaIngreso,
            F.estadoAdop, 
            F.esterilizado, 
            F.numchip, 
            F.ult_despa,
            E.nombre as especie, 
            T.tamanyo,
            RA.nombre as raza, 
            L.localidad, 
            R.nombre as refugio,
            U.usuario as registrador
            FROM ficha_animal F 
            INNER JOIN especie E ON F.especie = E.id 
            INNER JOIN tamanyos T ON F.tamanyo = T.id 
            INNER JOIN localidades L ON F.localidad = L.id 
            INNER JOIN refugios R ON F.refugio = R.id 
            INNER JOIN raza RA ON F.especie = RA.id 
            INNER JOIN usuarios U on F.registrador = U.id
            WHERE F.activo = 1"
        );
         
         return $select->fetchAll(PDO::FETCH_ASSOC);
         
 
     }

     //Funcion que devuleve la cantidad total de rescates para el paginador
   
//Obtiene las enfermedades del animal por el id del rescate
    public function getEnfermedadesPorId($id){
        $select = $this->conexion->query("SELECT E.enfermedad as tipo, E.id
        FROM enfermedades_animal A INNER JOIN enfermedades E 
        ON A.id_enfermedad = E.id 
        WHERE A.id_animal='".$id."'");

        $select->execute();

        $numRows = $select->rowCount();

        if($numRows>0){
            return $select->fetchAll();
        }else{
            return false;
        }

       
    }
//Obtiene las vacunas del animal por el id del rescate
    public function getVacunasPorId($id){
        $select = $this->conexion->query("SELECT V.nombre AS tipo, V.id
        FROM vacunas_animal A 
        INNER JOIN vacunas V 
        ON A.id_vacuna = V.id WHERE 
        A.id_animal='".$id."'");

        $select->execute();

        $numRows = $select->rowCount();

        if($numRows>0){
            return $select->fetchAll();
        }else{
            return false;
        }
    }
//Obtiene los tratamientos del animal por el id del rescate
    public function getTratamientosPorId($id){
        $select = $this->conexion->query("SELECT T.tratamiento AS tipo, T.id
        FROM tratamientos_animal A
        INNER JOIN tratamientos T
        ON A.id_tratamiento = T.id
        WHERE A.id_animal ='".$id."'");

        $select->execute();

        $numRows = $select->rowCount();

        if($numRows>0){
            return $select->fetchAll();
        }else{
            return false;
        }
    }
//Devuelve el animal del rescate por id
    public function getAnimal($id){
        $select = $this->conexion->query("SELECT 
        F.path_foto,
        F.id,
        F.nombre,
        F.fechaNac,       
        F.fechaIngreso,
        F.estadoAdop,
        F.esterilizado,
        F.numchip,
        F.sexo,
        F.descripcion,
        F.comentarios,
        F.ult_despa,
        E.nombre as especie,
        F.especie as especieId,        
        T.tamanyo,
        L.localidad,
        R.nombre as refugio,
        RA.nombre as raza,
        F.adoptante,
        A.nombre as nomAdop,
        A.apellidos as apeAdop
       
        FROM 
        ficha_animal F 
        INNER JOIN especie E ON F.especie = E.id 
        INNER JOIN tamanyos T ON F.tamanyo = T.id
        INNER JOIN localidades L ON  F.localidad = L.id
        INNER JOIN refugios R ON F.refugio = R.id
        INNER JOIN raza RA ON F.raza = RA.id
        INNER JOIN adoptante A ON F.adoptante = A.id
        WHERE F.id = '".$id."'");

        $select->execute();

        return $select->fetch();
    }
//Obtiene los tamanyos
    public function getTamanyos(){

        $select = $this->conexion->query("SELECT * FROM tamanyos");

        $select->execute();

        return $select->fetchAll(PDO::FETCH_ASSOC);

    }
//Obtiene las localidades
    public function getLocalidades(){

        $select = $this->conexion->query("SELECT * FROM localidades");

        $select->execute();

        return $select->fetchAll(PDO::FETCH_ASSOC);

    }

//Obtiene lista de adoptantes
    public function getAdoptantes(){

        $select = $this->conexion->query("SELECT id, nombre, apellidos FROM adoptante WHERE activo = 1 ORDER BY nombre");

        $select->execute();

        return $select->fetchAll(PDO::FETCH_ASSOC);

    }
//Obtiene las especies
   public function getEspecies(){

    $select = $this->conexion->query("SELECT * FROM especie");

    $select->execute();

    return $select->fetchAll(PDO::FETCH_ASSOC);
   }

//Obtiene las razas
   public function getRazas(){

    $select = $this->conexion->query("SELECT * FROM raza");

    $select->execute();

    return $select->fetchAll(PDO::FETCH_ASSOC);
   }
//Obtiene las reszas por especie
   public function getRazasPorEspecie($idEspecie){

  

    $select = $this->conexion->query("SELECT * FROM raza WHERE especie = $idEspecie AND id <> 1 order by nombre");

  

    return $select->fetchAll(PDO::FETCH_ASSOC);

   }
//Obtiene los refugios
   public function getRefugios(){

    $select = $this->conexion->query("SELECT * FROM refugios WHERE activo = 1");

    $select->execute();

    return $select->fetchAll(PDO::FETCH_ASSOC);
   }
//Inserta un nuevo rescaste
   public function insertarRescate($datos){

    try{
        $insert= $this->conexion->prepare("INSERT INTO ficha_animal 
        (id, comentarios, descripcion, especie, estadoAdop, localidad,adoptante,fechaIngreso, fechaNac, ult_despa, esterilizado, nombre, numchip, raza, refugio, tamanyo, sexo, activo, path_foto, registrador) 
        VALUES (:id,:comentarios,:descripcion,:especie,:estadoAdop,:localidad,:adoptante,:fechaIngreso,:fechaNac,:ult_despa,:esterilizado,:nombre,:numchip,:raza,:refugio,:tamanyo,:sexo,:activo, :path_foto, :registrador )");
 
        $insert->bindValue(":id",$datos["id"]);
        $insert->bindValue(":comentarios",$datos["comentarios"]);
        $insert->bindValue(":descripcion",$datos["descripcion"]);      
        $insert->bindValue(":especie",$datos["especie"]);
        $insert->bindValue(":estadoAdop",$datos["estadoAdop"]);
        $insert->bindValue(":localidad",$datos["localidad"]);
        $insert->bindValue(":adoptante",$datos["adoptante"]);
        $insert->bindValue(":fechaIngreso",$datos["fechaIng"]);
        $insert->bindValue(":fechaNac",$datos["fechaNac"]);
        $insert->bindValue(":ult_despa",$datos["fechaDesp"]);
        $insert->bindValue(":esterilizado",$datos["esterilizado"]);
        $insert->bindValue(":nombre",$datos["nombre"]);
        $insert->bindValue(":numchip",$datos["numChip"]);
        $insert->bindValue(":raza",$datos["raza"]);
        $insert->bindValue(":refugio",$datos["refugio"]);
        $insert->bindValue(":tamanyo",$datos["tamanyo"]);
        $insert->bindValue(":sexo",$datos["sexo"]);
        $insert->bindValue(":activo","1");
        $insert->bindValue(":path_foto",$datos["path_foto"]);
        $insert->bindValue(":registrador",$datos["registrador"]);
         
 
        $insert->execute();
    }catch(PDOException $e){
        error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
    }

     
   }
//Esta funcion devuelve el ultimo id del rescate para saber cual es el id del proximo
   function obtenerUltimoIdRescate($especie){
        $select = $this->conexion->query("SELECT id
         FROM ficha_animal 
         WHERE especie = $especie 
         ORDER BY SUBSTRING(id, 1, 2), CAST(SUBSTRING(id, 3, LENGTH(id)) AS UNSIGNED) DESC 
         LIMIT 1");
        $select->execute();
        return $select->fetch(PDO::FETCH_ASSOC);
   }
//Obtiene la lista de enfermedaddes
   function getEnfermedades(){
       $select = $this->conexion->query("SELECT * FROM enfermedades WHERE activo = 1");
       $select->execute();
       return $select->fetchAll(PDO::FETCH_ASSOC);

   }
//Obtiene todos los tratamientos
   function getTratamientos(){
    $select = $this->conexion->query("SELECT * FROM tratamientos WHERE activo = 1");
    $select->execute();
    return $select->fetchAll(PDO::FETCH_ASSOC);

}

//Obitene todas las vacunas
    function getVacunas(){
        $select = $this->conexion->query("SELECT * FROM vacunas WHERE activo = 1");
    $select->execute();
    return $select->fetchAll(PDO::FETCH_ASSOC);
    }
   
    function insertarEnfermedadesAnimal($id, $enfermedades){
                
        foreach($enfermedades as $enfermedad){
            $query = "INSERT INTO enfermedades_animal (id_animal, id_enfermedad) VALUES ('$id','$enfermedad')";
            $insert = $this->conexion->query($query);

        }
    }
    
    //Inserta un array de vacunas segun el id del rescate pasado
    function insertarVacunasAnimal($id, $vacunas){
        foreach($vacunas as $vacuna){
            $insert = $this->conexion->query("INSERT INTO vacunas_animal (id_animal, id_vacuna) VALUES ('$id','$vacuna')");
            
        }
    }
    //Inserta un array de tratamientos segun el id del rescate pasado
    function insertarTratamientosAnimal($id, $tratamientos){
                
        foreach($tratamientos as $tramiento){
            $insert = $this->conexion->query("INSERT INTO tratamientos_animal (id_animal, id_tratamiento) VALUES ('$id','$tramiento')");
        }
        
    }
//Elimina un array de envatras(enfermedades, vacunas o tratamientos)
    function eliminarEnvatra($id, $envatras, $tipo){
        foreach($envatras as $envatra){
            $sql = "DELETE FROM";
            switch ($tipo) {
                case 'enfermedades':
                    $sql .=" enfermedades_animal WHERE id_animal = '$id' AND id_enfermedad = $envatra";
                    break;
                
                case 'vacunas':
                    $sql .=" vacunas_animal WHERE id_animal = '$id' AND id_vacuna = $envatra";
                    break;

                case 'tratamientos':
                    $sql .=" tratamientos_animal WHERE id_animal = '$id' AND id_tratamiento = $envatra";
                    break;

            }
            $delete = $this->conexion->query($sql);

            $delete->execute();
        }
    }
//Funcion que actualiza datos del rescate
    function updateRescate($datos){
        $update = $this->conexion->prepare('UPDATE ficha_animal
         SET nombre = :nombre,
         fechaNac = :fechaNac,
         tamanyo = :tamanyo,
         localidad = :localidad,
         sexo = :sexo,         
         fechaIngreso = :fechaIngreso,
         estadoAdop = :estadoAdop,
         ult_despa = :ult_despa,
         adoptante = :adoptante,
         especie = :especie,
         raza = :raza,
         esterilizado = :esterilizado,
         numchip = :numchip,
         refugio = :refugio,
         comentarios = :comentarios,
         descripcion = :descripcion,
         path_foto=:path_foto
        WHERE id = :id');

         $update -> bindValue(":nombre", $datos["nombre"]);
         $update -> bindValue(":fechaNac", $datos["fechaNac"]);
         $update -> bindValue(":tamanyo", $datos["tamanyo"]);
         $update -> bindValue(":localidad", $datos["localidad"]);
         $update -> bindValue(":sexo", $datos["sexo"]);         
         $update -> bindValue(":fechaIngreso", $datos["fechaIng"]);
         $update -> bindValue(":estadoAdop", $datos["estadoAdop"]);
         $update -> bindValue(":ult_despa", $datos["fechaDesp"]);
         $update -> bindValue(":adoptante", $datos["selectAdoptante"]);
         $update -> bindValue(":especie", $datos["especie"]);
         $update -> bindValue(":raza", $datos["raza"]);
         $update -> bindValue(":esterilizado", $datos["esterilizado"]);
         $update -> bindValue(":refugio", $datos["refugio"]);
         $update -> bindValue(":numchip", $datos["numchip"]);
         $update -> bindValue(":comentarios", $datos["comentarios"]);
         $update -> bindValue(":descripcion", $datos["descripcion"]);
         $update -> bindValue(":id", $datos["id"]);
         $update -> bindValue(":path_foto", $datos["path_foto"]);

         return $update->execute();


    }
//Para eliminar un rescate seteamos el campo activo a 0
    function eliminarRescate($id){
        return $this->conexion->query("UPDATE ficha_animal SET activo = 0 WHERE id = '$id'");
    }//Invalid parameter number: parameter was not defined

    //Inserta adoptante
    function insertarAdoptante($datos){

        try{
            $insert = $this->conexion->prepare("INSERT INTO adoptante 
            (nombre, apellidos, telefono1, telefono2, comentarios, email, direccion, provincia, localidad, dni, num_mascotas)
            VALUES (:nombre, :apellidos, :telefono1, :telefono2, :comentarios, :email, :direccion, :provincia, :localidad, :dni, :num_mascotas)");
    
            $insert->bindValue(":nombre",$datos["nombreAdop"]);
            $insert->bindValue(":apellidos",$datos["apellidosAdop"]);
            $insert->bindValue(":telefono1",$datos["telf1Adop"]);
            $insert->bindValue(":telefono2",$datos["telf2Adop"]);
            $insert->bindValue(":comentarios", $datos["comentariosAdop"]);
            $insert->bindValue(":email",$datos["emailAdop"]);
            $insert->bindValue(":direccion",$datos["direccionAdop"]);
            $insert->bindValue(":provincia",$datos["provinciaAdop"]);
            $insert->bindValue(":localidad",$datos["selLocalidadAdop"]);
            $insert->bindValue(":dni",$datos["dniAdop"]);
            $insert->bindValue(":num_mascotas",$datos["numMascotasAdop"]);
           
            return $insert->execute();
        }catch(PDOException $Exception){
            
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $Exception->getMessage() . PHP_EOL, 3, "logException.txt");
        }
    }

    function getUltimoAdoptanteId(){

        $select = $this->conexion->query("SELECT id FROM adoptante ORDER BY id DESC LIMIT 1");

        return $select->fetch(PDO::FETCH_ASSOC);

    }

  

    
  

}

?>