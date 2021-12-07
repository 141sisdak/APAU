
<?php ob_start() ?>


<?php
if(isset($validacion->mensaje)){
    if (is_object ($validacion)){
        foreach ($validacion->mensaje as $errores) {
            foreach ($errores as $error)?>
            <b><span style="color: red;"><?php echo $error?></span></b><br>
            <?php 
    }}
    
}
?>
 <div class="bg">
    	<div class="principal_login slide-in-top">
		<img id="logo"src="../web/css/imagenes/logo_login.png"></img>
    	<span id="letra_logo">APAU</span>
    	<span id="desc_logo">Asociación Protectora de Animales de Utiel</span>
      <span id="saludo">¡Bienvenido!</span>
      
      <?php if (isset($_GET["falloAut"]) && $_GET["falloAut"] == "true") :?>
		<p id="badLogin">Usuario y/o contraseña incorrectos</p>
<?php endif; ?>
    	<form name="formLogin" action="index.php?ctl=login" method="post" id="formLogin">
        
		<?php if(isset($params['mensaje'])) :?>
			<span id="falloAutenticacion"><?php echo $params['mensaje'] ?></span>
		<?php endif; ?>
			<span id="usuVacio" >*El campo no puede estar vacío</span>
			
			<input class="input_login" type="text" name="usuario" id="usuario" autofocus placeholder="Usuario">
			
			

			<span id="passVacio">*El campo no puede estar vacío</span>
      <input  class="input_login" type="password" name="password" id="password" placeholder="Contraseña">
      
      <a href="#" id="btnRecordar"  data-toggle="modal" data-target="#modalRecordar">He olvidado mi usuario/contrseña</a>
			
			<button type="submit" class="btn btn-primary"name="enviar" id="enviar">Entrar</button>
		</form>

    <button type="button" class="btn nuevo" id="btnNuevaDonacion" data-toggle="modal" data-target="#nuevoUsuario">Registrarse</button>
    
    

      </div>
      



    </div>

	<!--I - Modal nuevo usuario****************************************************************************************************************************-->

<div class="modal fade" id="nuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Nuevo usuario</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="index.php?ctl=nuevoUsuario" id="formNuevoUsuario" name="formNuevoUsuario" method="POST">

            <div class="form-group">
                <label for="lblNombreUsuario">Nombre de usuario(*)</label>
                <input type="text" class="form-control obligatorio" id="nombreUsuario" name="nombreUsuario">        
            </div>

            <div class="form-group">
                <label for="lblPass1">Contraseña(*)</label>
                <input type="text" class="form-control obligatorio" id="pass1" name="pass1">        
            </div>

            <div class="form-group">
                <label for="lblPass2">Repite contraseña(*)</label>
                <input type="text" class="form-control obligatorio" id="pass2" name="pass2">        
            </div>

           

            <div class="form-group">
                <label for="lblTelf">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">        
            </div>

            <div class="form-group">
                <label for="lblEmail">Email(*)</label>
                <input type="email" class="form-control obligatorio" id="email" name="email">        
            </div>

            <div id="mens_conf_usu_reg">
              <p id="mens_conf_usu_reg_text">Atención! Deberás esperar a que el administrador te de permiso de acceso. (Se te enviará email de confirmación)</p>
            </div>

            

            
        </form>
      </div>
      <div class="modal-footer">
        
        <button class="btnDialogo_Aceptar" type="button" name="btnNuevoUsuario" id="btnNuevoUsuario">Crear</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal nuevo usuario****************************************************************************************************************************-->

<!--I - Modal recordar usu/pass****************************************************************************************************************************-->

<div class="modal fade" id="modalRecordar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="titulo-modal">Recordar usuario/contraseña</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="index.php?ctl=recordarUsuPass" id="formRecordar" name="formRecordar" method="POST">

        <div class="form-group">
            <label for="emailRec">Email</label>
           
            <input type="text" class="form-control obligatorio" id="emailRec" name="emailRec">  
            <span class="aclaratorio" >(*)Se enviarán tus datos al email introducido</span><br><br>   
             
        </div>

      </form>
      </div>
      <div class="modal-footer">

        <button type="button" class="btnDialogo_Aceptar" id="btnEnviarRec" name="btnEnviarRec">Enviar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- F - Modal recordar usu/pass****************************************************************************************************************************-->

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>


