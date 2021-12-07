<?php 

class rescateController{

    //Esta funcion carga los datos completos del rescate y los muestra en su correspondiente template
    public function verAnimal()
    {
        if (isset($_GET["id"])) {
            
            $params = array(
                'ficha' => array(),
                'enfermedades' => array(),
                'vacunas' => array(),
                'tratamientos' => array()
            );
            
            try {
                
                $m = new modelRescate();
                //La funcion setear nulos pone el texto "Sin datos" a los rescates que tiene algun campo vacio
                $params["ficha"] = setearNulos($m->getAnimal($_GET["id"]));
                
                if (!$params["enfermedades"] = $m->getEnfermedadesPorId($_GET["id"])) {
                    $params["enfermedades"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["tratamientos"] = $m->getTratamientosPorId($_GET["id"])) {
                    $params["tratamientos"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["vacunas"] = $m->getVacunasPorId($_GET["id"])) {
                    $params["vacunas"][0]["tipo"] = "Sin datos";
                }
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }
           
            require('../app/templates/fichaAnimal.php');
           
            
        }
    }
    
   
    
    public function rescate()
    {
        $m = new modelRescate();
        
        $params = array();

       
        
        try {

            $params["enfermedades"] = $m->getEnfermedades();
            $params["vacunas"] = $m->getVacunas();
            $params["tratamientos"] = $m->getTratamientos();
            $params["localidades"] = $m->getLocalidades();
            $params["refugios"] = $m->getRefugios();
            $params["tamanyos"] = $m->getTamanyos();
            $params["especies"] = $m->getEspecies();
            $params["adoptantes"] = $m->getAdoptantes();
            $params["enfermedades"] = $m->getEnfermedades();
            $params["vacunas"] = $m->getVacunas();
            $params["tratamientos"] = $m->getTratamientos();
          
            
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }
        
        require('../app/templates/rescate.php');
    }
    
   
    
    
    public function nuevoRescate(){

        $adoptanteOK = true;

            $m = new modelRescate();

            $datos = array();

            $datos["nombre"]  = !empty($_POST["nNombre"]) ? recoge("nNombre") : "Por definir";
            $datos["fechaNac"] = !empty($_POST["nFechaNac"]) ? $_POST["nFechaNac"] : null;
            $datos["fechaIng"] = !empty( $_POST["nFechaIng"]) ?  $_POST["nFechaIng"] : null;
            $datos["fechaDesp"] = !empty( $_POST["nUlt_desp"]) ?  $_POST["nUlt_desp"]: null;            
            $datos["localidad"] = !empty($_POST["nSelLocalidad"]) ? $_POST["nSelLocalidad"] : 253; 
            $datos["esterilizado"] = !empty($_POST["nCkEsterilizado"]) ? "si" : "no"; 
            $datos["estadoAdop"] = isset($_POST["nChAdoptado"]) ? "adoptado" : "no adoptado";
            $datos["numChip"] = !empty($_POST["nNumchip"]) ? recoge("nNumchip") : null;             
            $datos["refugio"] = !empty($_POST["nSelRefugio"]) ? $_POST["nSelRefugio"] : 3;
            $datos["tamanyo"] = !empty($_POST["nSelTamanyo"]) ? $_POST["nSelTamanyo"] : 5;
            $datos["sexo"] = !empty($_POST["nRadioSexo"]) ? $_POST["nRadioSexo"] : "Por definir";
            $datos["especie"] = $_POST["nSelEspecie"];
            //Se pone Mestizo por defecto
            $datos["raza"] = isset($_POST["nSelRaza"]) ? $_POST["nSelRaza"] : 251;
            $datos["descripcion"] = recoge("nDescripcion");
            $datos["comentarios"] = recoge("nComentarios");
            $datos["registrador"] = $_SESSION["id"];

            if(isset($_POST["nSelAdoptante"])){
                $datos["adoptante"] = $_POST["nSelAdoptante"];
            }else{
                //Bloque que se dispara si se ha rellenado el "formulario de adoptante"
                if($_POST["nombreAdop"]!="" && $_POST["apellidosAdop"]=!""){

                    $datosAdop = array();
    
                    $datosAdop["nombreAdop"] = empty($_POST["nombreAdop"]) ? recoge("nombreAdop") :null;
                    $datosAdop["apellidosAdop"] = empty($_POST["apellidosAdop"]) ?recoge("apellidosAdop") : null;
                    $datosAdop["telf1Adop"]= isset($_POST["telf1Adop"]) ? recoge("telf1Adop") : null;
                    $datosAdop["telf2Adop"] = isset($_POST["telf2Adop"]) ? recoge("telf2Adop") : null;
                    $datosAdop["comentariosAdop"] = isset($_POST["comentariosAdop"]) ? recoge("comentariosAdop") : null;
                    $datosAdop["emailAdop"] =  isset($_POST["emailAdop"]) ? recoge("emailAdop") : null;
                    $datosAdop["direccionAdop"] = isset($_POST["direccionAdop"]) ? recoge("direccionAdop") : null;
                    $datosAdop["provinciaAdop"] = isset($_POST["provinciaAdop"]) ? recoge("provinciaAdop") : null;
                    $datosAdop["selLocalidadAdop"] = isset($_POST["selLocalidadAdop"]) ? $_POST["selLocalidadAdop"] : null;
                    $datosAdop["dniAdop"] = isset($_POST["dniAdop"]) ? recoge("dniAdop") : null;
                    $datosAdop["numMascotasAdop"] = isset($_POST["numMascotasAdop"]) ? recoge("numMascotasAdop") : null;

                    $regla = array(
                        array(
                            'name'=> 'nombreAdop',
                            'regla'=>'letras'
                        ),
                        array(
                            'name'=> 'apellidosAdop',
                            'regla'=>'letras'
                        ),
                        array(
                            'name'=> 'telf1Adop',
                            'regla'=>'numeric, telefono'
                        ),
                        array(
                            'name'=> 'telf2Adop',
                            'regla'=>'numeric, telefono'
                        ),
                        array(
                            'name'=> 'emailAdop',
                            'regla'=>'email'
                        ),
                        array(
                            'name'=> 'dniAdop',
                            'regla'=>'dni'
                        ),
                        array(
                            'name'=> 'numMascotasAdop',
                            'regla'=>'numeric'
                        )
                       
                    );

                     $validacionNuevoAdoptante = new Validacion();
                     $validaciones = $validacionNuevoAdoptante->rules($regla, $datosAdop);
    
                     if ($validaciones === true) {
    
                        if($m->insertarAdoptante($datosAdop)){
                            //Tendremos que recuperar el adopntante introducido
                          $id = $m->getUltimoAdoptanteId();
                            $datos["adoptante"] = $id["id"];
                            
                        }else{
                            $adoptanteOK = false;
                        }
    
                     }else{
                        $adoptanteOK = false;
                     }
                }else{
                    $datos["adoptante"] = 34;
                }
            }
           
            $regla = array(
              
                array(
                    'name' => 'numChip',
                    'regla' => 'numeric,chip'
                )
               
            );
       
            $validacionNuevoRescate = new Validacion();
            $validaciones = $validacionNuevoRescate->rules($regla, $datos);
                    
                    if ($validaciones === true && $adoptanteOK == true) {
                       
                        
                        $id = $m->obtenerUltimoIdRescate($datos["especie"]);
                        $UltId = (int)substr($id["id"],2);
                        $UltId++;
                        switch ($datos["especie"]) {
                           
                            case '1':
                                $id="P-".$UltId;
                                break;
                            case '2':
                                $id="G-".$UltId;
                                break;
                            case '3':
                                $id="R-".$UltId;
                                break;
                        }
                        $datos["id"]= $id;

                        if($_FILES["fotoSubida"]["name"]!=""){

                            $subirFoto = true;
                            
    
                            if($_FILES["fotoSubida"]["size"]>2000000){
                                $params["mensFoto"] = "El tamaño de la imagen supera 2MB";
                                $subirFoto = false;
                            }
                            if (!($_FILES["fotoSubida"]["type"] =="image/jpeg" OR $_FILES["fotoSubida"]["type"] =="image/gif" OR $_FILES["fotoSubida"]["type"] =="image/jpg")){
                                $params["mensFoto"] = "Solo se pueden subir archivos GIF o JPEG";
                                $subirFoto = false;
                            }
    
                            if($subirFoto==true){
                                $nombreFoto = $_FILES["fotoSubida"]["name"];
                                $add = "../web/uploads/". $datos['id'] ."_". $nombreFoto;
    
                                if(move_uploaded_file($_FILES["fotoSubida"]["tmp_name"], $add)){
                                    $datos["path_foto"] = $add;
                                    $params["mensFoto"] = "Imagen subida con éxito";
                                }else{
                                    $params["mensFoto"] = "Error al subir la imagen";
                                }
                            }
    
                         }else{
                             $datos["path_foto"] = "Sin datos";
                         }

                        $m->insertarRescate($datos);
                        
                        if(isset($_POST["nSelEnfermedades"])){
                            $enfermedades = array();
                            foreach($_POST["nSelEnfermedades"] as $enfermedad){
                             array_push($enfermedades, $enfermedad);
                            }
                            $m->insertarEnfermedadesAnimal($datos["id"], $enfermedades);
                        }
                        if(isset($_POST["nSelVacunas"])){
                         $vacunas = array();
                         foreach($_POST["nSelVacunas"] as $vacuna){
                          array_push($vacunas, $vacuna);
                         }
                         $m->insertarVacunasAnimal($datos["id"], $vacunas);
                     }
             
                     if(isset($_POST["nSelTratamientos"])){
                         $tratamientos = array();
                         foreach($_POST["nSelTratamientos"] as $tratamiento){
                          array_push($tratamientos, $tratamiento);
                         }
                         $m->insertarTratamientosAnimal($datos["id"], $tratamientos);
                     }

                        header("Location:index.php?ctl=rescate&exito=insertar");
                    }else{
                        header("Location:index.php?ctl=rescate&mensaje=Error en la insercion del adoptante");
                    }

       
    }

    public function modificarRescate(){
        
        if (isset($_GET["id"])) {

            $m = new modelRescate();
            
            $params = array(
                'ficha' => array(),
                'enfermedades' => array(),
                'vacunas' => array(),
                'tratamientos' => array()
            );

            $params["tamanyos"] = $m->getTamanyos();
            $params["localidades"] = $m->getLocalidades();
            $params["refugios"] = $m->getRefugios();
            
            $params["especies"] = $m->getEspecies();

            $params["adoptantes"] = $m->getAdoptantes();

            
            
            $params["ficha"] = setearNulos($m->getAnimal($_GET["id"]));

            $params["razas"] = $m->getRazasPorEspecie($params["ficha"]["especieId"]);
            
            if (!$params["enfermedades"] = $m->getEnfermedadesPorId($_GET["id"])) {
                $params["enfermedades"][0]["tipo"] = "Sin datos";
            }
            
            if (!$params["tratamientos"] = $m->getTratamientosPorId($_GET["id"])) {
                $params["tratamientos"][0]["tipo"] = "Sin datos";
            }
            
            if (!$params["vacunas"] = $m->getVacunasPorId($_GET["id"])) {
                $params["vacunas"][0]["tipo"] = "Sin datos";
            }
            
            try {

                if(isset($_POST["modificar"])){

                $datos = array();

                $datos["id"] = $_GET["id"];
                $datos["fechaNac"] = !empty($_POST["fechaNacMod"]) ? $_POST["fechaNacMod"] : null;
                $datos["fechaIng"] = !empty( $_POST["fechaIngMod"]) ?  $_POST["fechaIngMod"] : null;
                $datos["fechaDesp"] = !empty( $_POST["fechaUltMod"]) ?  $_POST["fechaUltMod"]: null;  
                $datos["nombre"] = setearSindatos($_POST["nombre"], "nombre");
                $datos["tamanyo"] = $_POST["mSelTamanyo"];
                $datos["localidad"] = $_POST["selLocalidad"];
                $datos["sexo"] = $_POST["radioSexo"];
                $datos["estadoAdop"] = $_POST["radioAdoptado"];
                $datos["selectAdoptante"] = $_POST["selectAdoptante"];
                $datos["especie"] = $_POST["modSelEspecie"];
                $datos["raza"] = $_POST["modSelRaza"];
                $datos["numchip"] = setearSindatos($_POST["numChip"], "numChip");
                $datos["esterilizado"] = $_POST["ckEsterilizado"];               
                $datos["refugio"] = $_POST["selRefugio"];
                $datos["comentarios"] = setearSindatos($_POST["modComentarios"], 'modComentarios');
                $datos["descripcion"] = setearSindatos($_POST["modDescripcion"], 'modDescripcion'); 
                $params["ficha"] = $m->getAnimal($_GET["id"]);
                
                if($_FILES["fotoSubidaMod"]["name"]!=""){
                    //Si ese animal ya tiene foto subida
                    if($params["ficha"]["path_foto"]!="Sin datos" || $params["ficha"]["path_foto"]!="" ){

                        $fotos = scandir('../web/uploads/');

                        foreach ($fotos as $foto => $valor) {
                            $letra = substr($valor,0,4);
                            if($letra==$_GET["id"]){
                                $path = '../web/uploads/' . $valor;
                                unlink($path);
                                break;
                                
                                
                            }
                        }

                        $subirFoto = true;
                            
    
                        if($_FILES["fotoSubidaMod"]["size"]>2000000){
                            $params["mensFoto"] = "El tamaño de la imagen supera 2MB";
                            $subirFoto = false;
                        }
                        if (!($_FILES["fotoSubidaMod"]["type"] =="image/jpeg" OR $_FILES["fotoSubida"]["type"] =="image/gif" OR $_FILES["fotoSubida"]["type"] =="image/jpg")){
                            $params["mensFoto"] = "Solo se pueden subir archivos GIF o JPEG";
                            $subirFoto = false;
                        }

                        if($subirFoto==true){
                            $nombreFoto = $_FILES["fotoSubidaMod"]["name"];
                            $add = "../web/uploads/". $datos['id'] ."_". $nombreFoto;

                            if(move_uploaded_file($_FILES["fotoSubidaMod"]["tmp_name"], $add)){
                                $datos["path_foto"] = $add;
                               
                            }else{
                                $params["mensFoto"] = "Error al subir la imagen";
                            }
                        }
                         
                    }else{
                        $datos["path_foto"] = "Sin datos";
                    }
                           
                        
                }else{
                    $datos["path_foto"] = $params["ficha"]["path_foto"];
                }

                $validacionNuevoRescate = new Validacion();
        
                $regla = array(
                    array(
                        'name' => 'nombre',
                        'regla' => 'letras'
                    ),
                   
                    array(
                        'name' => 'numchip',
                        'regla' => 'numeric,chip'
                    )
                );
                    
                    $validaciones = $validacionNuevoRescate->rules($regla, $datos);
                    
                            if ($validaciones === true) {
                                if(!$m->updateRescate($datos)){
                                    $params["mensError"] = "¡Fallo en la modificación del rescate!";
                                }else{
                                    header("Location:index.php?ctl=modificarRescate&id=" .$_GET["id"] . "&exito=modificar");
                                }
                            }

                }
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }
            
            require('../app/templates/modRescate.php');
            
        }
    }

    public function eliminarRescate(){
        if(isset($_GET["id"])){

            $m = new modelRescate();

            if($m->eliminarRescate($_GET["id"])){
                $params["mensaje"] = "Rescate eliminado con éxito";
            }
            
            require('../app/templates/rescate.php');
        }
    }
}
