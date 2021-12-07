
<div class="modal" id="modal_confirmacion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Confirmación</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Estás segur@?</p>
        <img class="imgDialogoConf" src="../web/css/imagenes/imagen_modal_confirmacion.png" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" id="btnEliminar" class="btnDialogo_Aceptar">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--I modal mensajes-->

<div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <span class="titulo-modal">Mensaje</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="cab-item-filtros"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btnOkMensaje">OK</button>
      </div>
    </div>
  </div>
</div>
<!--F modal mensajes-->

<!--I - Modal editar perfil usuario-->

<!--Se valida en val_forms.js-->

<div class="modal fade" id="modalEditarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="titulo-modal">Editar perfil</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php?ctl=modPerfil" method="post" name="formModPerfil" id="formModPerfil">

        <div class="form-group">
            <label for="telfMod">Teléfono</label>
            <input type="text" class="form-control" id="telfMod" name="telfMod" value="<?php echo $_SESSION["telefono"] ?>">
        </div>

        <div class="form-group">
            <label for="emailMod">Email</label>
            <input type="text" class="form-control" id="emailMod" name="emailMod" value="<?php echo $_SESSION["email"] ?>">
        </div>

        <div class="form-group">
            
            <input type="text" class="form-control" style="display: none;" name="modnav" value="modnav">
            <input type="text" class="form-control" style="display: none;" name="actual" id="actual">
            
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnEnviarModPerfil" class="btnDialogo_Aceptar">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal editar perfil usuario-->


<!--I - Modal editar perfil usuario-->
<!--Se valida en val_forms.js-->

<div class="modal fade" id="modalEditarPass" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="titulo-modal">Cambiar contraseña</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php?ctl=modPass" method="POST" name="formModPass" id="formModPass">

        <div class="form-group">
            <label for="passAct">Contraseña actual</label>
            <input type="text" class="form-control obligatorio" id="passAct" name="passAct">
        </div>

        <div class="form-group">
            <label for="passMod1">Nueva contraseña</label>
            <input type="text" class="form-control obligatorio" id="passMod1" name="passMod1">
        </div>

        <div class="form-group">
            <label for="passMod2">Repite la contraseña nueva</label>
            <input type="text" class="form-control obligatorio" id="passMod2" name="passMod2">
        </div>

        <input type="text" class="form-control" style="display: none;" name="modnavCont" value="modnavCont">
            <input type="text" class="form-control" style="display: none;" name="actualCont" id="actualCont">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnEnviarModPass" class="btnDialogo_Aceptar">Aceptar</button>
        <button type="button" class="btnDialogo_Cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!--F - Modal editar perfil usuario-->




