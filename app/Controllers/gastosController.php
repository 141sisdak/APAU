<?php 



class gastosController{

  /*
    *****************************************************************INICIO GASTOS USUARIO NORMAL***************************************************************************
    *********************************************************************************************************************************************************************
    *********************************************************************************************************************************************************************
    */

    public function gastos(){

        $m = new modelGastos();

        try {
          
          $params["gastosUsuario"] = $m->getUsuariosGastos();
          if(!$params["gastos"] = $m->getGastosAll()){
            $params["mensaje"] = "No existen gastos";
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
        
        require('../app/templates/gastos.php');

    }

  public function nuevoGasto(){

      $m = new modelGastos();

            
      try {
          
        if(isset($_POST["concepto"]) && isset($_POST["importe"])){

          $datos["idUsuario"] = $_SESSION["id"];
          $datos["concepto"] = recoge("concepto");
          $datos["importe"] = recoge("importe");
          $datos["comentario"] = recoge("comentario");

          $regla = array(
            array(
                'name' => 'importe',
                'regla' => 'noEmpty,numeric'
            ),
          
        );

        $validacionNuevoGasto = new Validacion();
    
        $validaciones = $validacionNuevoGasto->rules($regla, $datos);

        if($validaciones === true){
          if(!$m->insertarGasto($datos)){
            $params["mensaje"] = "Error al insertar";
          }else{
            header("Location:index.php?ctl=gastos&exito=insertar");
          }
        }else{
          $params["mensaje"] = "Error en validaciones";
        }


        }else{
          $params["mensaje"] = "Campos obligatorios no rellenados";
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

      if(!$params["gastos"] = $m->getGastosAll()){
        $params["mensaje"] = "No existen gastos";
      }
      
      require('../app/templates/gastos.php'); 

    }

    /*
    *****************************************************************FIN GASTOS USUARIO NORMAL***************************************************************************
    *********************************************************************************************************************************************************************
    *********************************************************************************************************************************************************************
    */
    
    /*
    *****************************************************************INICIO GASTOS PANEL DE CONTROL***************************************************************************
    *********************************************************************************************************************************************************************
    *********************************************************************************************************************************************************************
    */

    public function gastospC(){

      $m = new modelGastos();
    
      try {
        
        $params["usuarios"] = $m->getUsuariosAll();
        
        if(!$params["gastos"] = $m->getGastosAll()){
          $params["mensaje"] = "No existen gastos";
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
      
      require('../app/templates/gastosPc.php');

  }


  public function modificarGasto(){

    $m = new modelGastos();
    
    try {


      if(isset($_POST["conceptoMod"]) && isset($_POST["importeMod"])){

        $datos["usu"] = $_POST["selUsu"];
        $datos["idGasto"] = $_POST["idGastoMod"];
        $datos["concepto"] = recoge("conceptoMod");
        $datos["importe"] = recoge("importeMod");
        $datos["comentario"] = recoge("comentarioMod");

        $regla = array(
          array(
              'name' => 'importe',
              'regla' => 'noEmpty,numeric'
          ),
        
      );

      $validacionModGasto = new Validacion();
  
      $validaciones = $validacionModGasto->rules($regla, $datos);

      if($validaciones === true){
        if(!$m->modGasto($datos)){
          $params["mensaje"] = "Error al modificar el gasto";
        }else{
          header("Location:index.php?ctl=gastosPc&exito=modificar");
        }
      }else{
        $params["mensaje"] = "Error en validaciones";
      }


      }else{
        $params["mensaje"] = "Campos obligatorios no rellenados";
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
    
    require('../app/templates/gastosPc.php');

  }

    /*
    *****************************************************************FIN GASTOS PANEL DE CONTROL***************************************************************************
    *********************************************************************************************************************************************************************
    *********************************************************************************************************************************************************************
    */


    }



?>