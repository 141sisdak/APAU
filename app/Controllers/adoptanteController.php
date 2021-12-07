<?php 



class adoptanteController{

    public function adoptante(){

        $m = new modelAdoptante();

      $params["localidades"] = $m->getLocalidades();
        
      require('../app/templates/adoptante.php');

    }

    public function nuevoAdoptante(){

        if(isset($_POST["nombreAdop"]) && isset($_POST["apellidosAdop"])){

            $datos = array();

            $datos["nombre"] = recoge("nombreAdop");
            $datos["apellidos"] = recoge("apellidosAdop");
            $datos["telefono1"] = recoge("telf1Adop");
            $datos["telefono2"] = recoge("telf2Adop");
            $datos["comentarios"] = recoge("comentariosAdop");
            $datos["email"] = recoge("emailAdop");
            $datos["direccion"] = recoge("direccionAdop");
            $datos["provincia"] = recoge("provinciaAdop");
            $datos["localidad"] = $_POST["selLocalidadAdop"];
            $datos["dniAdop"] = recoge("dniAdop");
            $datos["num_mascotas"] = recoge("numMascotasAdop");

            $regla = array(
                array(
                    'name'=> 'nombre',
                    'regla'=>'letras'
                ),
                array(
                    'name'=> 'apellidos',
                    'regla'=>'apellidos'
                ),
                array(
                    'name'=> 'telefono1',
                    'regla'=>'numeric, telefono'
                ),
                array(
                    'name'=> 'telefono2',
                    'regla'=>'numeric, telefono'
                ),
                array(
                    'name'=> 'email',
                    'regla'=>'email'
                ),
                array(
                    'name'=> 'dniAdop',
                    'regla'=>'dni'
                ),
                array(
                    'name'=> 'num_mascotas',
                    'regla'=>'numeric'
                )
               
            );

             $validacionNuevoAdoptante = new Validacion();
             $validaciones = $validacionNuevoAdoptante->rules($regla, $datos);

             if ($validaciones === true) {

                setearANull($datos);

                $m = new modelAdoptante();
                if(!$m->nuevoAdoptante($datos)){
                    $params["mensaje"] = "Error al insertar";
                }else{
                    header("Location:index.php?ctl=adoptante&exito=insertar");
                  
                }
             }else{
                $params["mensaje"] = "Error al insertar";
             }

        }

        require('../app/templates/adoptante.php');

    }

    public function modificarAdoptante(){

        if(isset($_POST["nombreModAdop"]) && isset($_POST["apellidosModAdop"])){

            $m = new modelAdoptante();

            $dniModificado = false;

            $datos = array();
            $datos["idAdoptante"] = recoge("idAdoptante");
            $datos["nombre"] = recoge("nombreModAdop");
            $datos["apellidos"] = recoge("apellidosModAdop");
            $datos["telefono1"] = recoge("telf1ModAdop");
            $datos["telefono2"] = recoge("telf2ModAdop");
            $datos["comentarios"] = recoge("comentariosModAdop");
            $datos["email"] = recoge("emailModAdop");
            $datos["direccion"] = recoge("direccionModAdop");
            $datos["provincia"] = recoge("provinciaModAdop");
            $datos["localidad"] = $_POST["selLocalidadModAdop"];
            $datos["dniAdop"] = recoge("dniModAdop");
            $datos["num_mascotas"] = recoge("numMascotasModAdop");

            $adoptante = $m->getAdoptantePorId($datos["idAdoptante"]);

            $dniAnterior = $adoptante["dni"];

            if($dniAnterior != $datos["dniAdop"]){
                $dniModificado = true;
            }

            $regla = array(
                array(
                    'name'=> 'nombre',
                    'regla'=>'letras'
                ),
                array(
                    'name'=> 'apellidos',
                    'regla'=>'apellidos'
                ),
                array(
                    'name'=> 'telefono1',
                    'regla'=>'numeric, telefono'
                ),
                array(
                    'name'=> 'telefono2',
                    'regla'=>'numeric, telefono'
                ),
                array(
                    'name'=> 'email',
                    'regla'=>'email'
                ),
                array(
                    'name'=> 'dniAdop',
                    'regla'=>'dni'
                ),
                array(
                    'name'=> 'num_mascotas',
                    'regla'=>'numeric'
                )
               
            );

            
            $validacionModAdoptante = new Validacion();
            $validaciones = $validacionModAdoptante->rules($regla, $datos);

            if ($validaciones === true) {

                if($dniModificado && !$m->getAdoptantePorDni($datos["dniAdop"])){
                    setearANull($datos);
                    if($m->modificarAdoptante($datos)){
                        header("Location:index.php?ctl=adoptante&exito=modificar");
                    }else{
                        $params["adoptante"] = $m->getAdoptantes();
                        $params["localidades"]= $m->getLocalidades();
                        $params["mensaje"] = "Fallo en la insercion";
                        setearNulosTabla($params["adoptante"]);
                    }
                }else{
                       if($dniModificado && $m->getAdoptantePorDni($datos["dniAdop"])){
                        $params["adoptante"] = $m->getAdoptantes();
                        $params["localidades"]= $m->getLocalidades();
                        $params["mensaje"] = "Error al modificar, el DNI ya existe";
                        setearNulosTabla($params["adoptante"]);
                       }
                       if(!$dniModificado){
                        $m->modificarAdoptante($datos);
                        header("Location:index.php?ctl=adoptante&exito=modificar");
                       }
                }

             
            }else{
                $params["adoptante"] = $m->getAdoptantes();
                $params["localidades"]= $m->getLocalidades();
                setearNulosTabla($params["adoptante"]);
               $params["mensaje"] = "Datos introducidos incorrectos";
            }
        }
    

    }

}

?>