<?php

// Aqui pondremos las funciones de validación de los campos

//SIN ACENTOS??????????????????????


function recoge($var)
{
    if (isset($_REQUEST[$var]))
        $tmp = strip_tags(sinEspacios($_REQUEST[$var]));
    else
        $tmp = "";

    return $tmp;
}

function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}

function enviaEmail(){
    $cuerpo="Bienvenido al sistema";
    $from = "alexdaw@gmail.com";
    $to = "alejandroherpal@gmail.com";
    $subject = "Bienvenido!";
    $message = $cuerpo;
    $headers= "From:" . $from;
    mail($to,$subject,$message, $headers);
}

//Funcion que busca valores null en el array y cambia el valor de la clave a "Sin datos"
function setearNulos($params){
    
    foreach ($params as $key=>&$valor) {
        if($valor==null){
            $valor = "Sin datos";
        }
    }

    return $params;
}

function setearNulosTabla(&$params){

    foreach($params as &$campo){
        foreach($campo as &$valor){
         if($valor==null){
           $valor = "Sin datos";
         }
        
        }
       }

    return $params;

}

function validarFechas($desde, $hasta){
    $ok = true;
    $actual = time();
    if(strtotime($hasta)>($actual)){
        $ok = false;
    }
    if(strtotime($desde)>strtotime($hasta)){
        $ok = false;
    }

    return $ok;
}

 function setearSindatos($dato, $campo){

    if($dato=="Sin datos"){
        $dato = null;
    }else{
        $dato = recoge($campo);
    }

    return $dato;
 }
//Funcion que calcula la edad a partir de la fecha de nacimiento
 function setearEdad($fechaNac){
    $fecha_nacimiento = new DateTime($fechaNac);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nacimiento);

    if($edad->y == 0){
        if($edad->m == 1){
            return $edad->m . " mes";
        }else{
            return $edad->m. " meses";
        }
        
    }else{
        if($edad->y == 1){
            return $edad->y . " año";
        }else{
            return $edad->y . " años";
        }
      
    }
   }

   function setearANull(&$datos){

    foreach($datos as &$dato){
        if($dato == ""){
            $dato = null;
        }
    }

}

   function validaPassRep($pass1, $pass2){

    $ok = true;

    if($pass1!=$pass2){
        $ok = false;
    }

    return $ok;

   }
  
 


?>