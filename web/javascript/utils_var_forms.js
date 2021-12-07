function validacionLogin() {

    var correcto = false;

    var usuario = $("#usuario").val();
    var regexpUsu = /^[\w]{0,30}$/;

    var password = $("#password").val();
    //var regexpPasword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,8}$/;
    var regexpPasword = /^\d{3}$/;

    var usuarioOK = validaUsuario(usuario, regexpUsu);
    var passwordOK = validaPassword(password, regexpPasword);

    if (usuarioOK && passwordOK) {
        correcto = true;
    }


    return correcto;
}

function validaPass(pass){
    if(!/^\d{3}$/.test($(pass).val())){
        insertarTextoError($(pass), "Valores introducidos incorrectos");
    }else{
        $.ajax({
            type: "get",
            url: "../app/Ajax/usuariosAjax.php",
            cache: false,
            data: {
                getPass: $(pass).val()
            },
            success: function (response) {
                if (response) {
                   return true;
                }else{
                    insertarTextoError($(pass), "Contraseña incorrecta");
                }
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
    
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });
        
    }
}

function validaUsuario(usuario, regexp) {

    correcto = true;

    if (usuario == "") {
      
        $("#usuVacio").css("visibility", "visible").show();
     
        correcto = false;
    }
    else if (!regexp.test(usuario)) {
        $("#usuario").css("border", "1px solid red");
        $("#usuIncorrecto").css("hidden", false);
        correcto = false;
    }

    return correcto;
}

function validaPassword(password, regexpPasword) {

    correcto = true;

    if (password == "") {
     
        $("#passVacio").css("visibility", "visible").show();;
        correcto = false;
    }
    else if (!regexpPasword.test(password)) {
        $("#password").css("border", "1px solid red");
        $("#passIncorrecto").css("hidden", false);
        correcto = false;
    }
    return correcto;
}

function comprobarEmailExistente(email){
    
    $.ajax({
        type: "get",
        url: "../app/Ajax/usuariosAjax.php",
        cache: false,
        data: {
            email: $(email).val()
        },
        success: function (response) {
            if (response) {
               return true;
            }else{
                insertarTextoError($(email), "El email introducido no existe");
            }
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {

        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });
}

function comprobarObligatorios(obligatorios) {

    $(obligatorios).each(function () {

        if ($(this).val() == "") {
            

            insertarTextoError($(this), "Campo obligatorio");
        }
    });
}

function insertarTextoError(campo, texto) {
    $(campo).parent().append(
        $("<span>", {
            "class": "errorValidacion",
            "text": texto
        }).show()

    ).append($("<br>"))

    $(campo).parent().find("input, select").css("border" , "1px solid #FD7A7C");
}

function comprobarNombreRep(nombre) {

    $.ajax({
        type: "get",
        url: "../app/Ajax/usuariosAjax.php",
        dataType: 'json',
        cache: false,
        data: {
            nombreNuevo: $(nombre).val()
        },
        success: function (response) {
            if (response) {

                insertarTextoError($(nombre), "El usuario ya existe");
            }
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });
}

function comprobarNombreRefugioRep(nombreRefugio) {

    $.ajax({
        type: "get",
        url: "../app/Ajax/refugiosAjax.php",
        dataType: 'json',
        cache: false,
        data: {
            nombreNuevo: $(nombreRefugio).val()
        },
        success: function (response) {
            if (response) {

                insertarTextoError($(nombreRefugio), "Ya existe un refugio con ese nombre");
            }
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });

}


function comprobarDniRep(dni) {

    $.ajax({
        type: "get",
        url: "../app/Ajax/adoptanteAjax.php",
        dataType: 'json',
        cache: false,
        data: {
            dniNuevo: $(dni).val()
        },
        success: function (response) {
            if (response) {

                insertarTextoError($(dni), "Ya existe un adoptante con ese DNI");
            }
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });
}

function comprobarPasswordS(pass1, pass2) {

    if ($(pass1).val() != $(pass2).val()) {

        insertarTextoError($(pass2), "Las contraseñas no coinciden");
        insertarTextoError($(pass1), "Las contraseñas no coinciden");

    }

}

function validarTelf(campo) {

    if ($(campo).val() != "") {

        var regexp = /^[0-9]{9}$/;

        if (!regexp.test($(campo).val())) {
            insertarTextoError(campo, "Teléfono mal introducido");
        }

    }
}

function validaEspecie(opcionSeleccionada) {
    var ok = true;
    if (opcionSeleccionada == 0) {
        $("#nSelEspecie").parent().append(
            $('<span>', {
                'class': 'errorValidacion',
                'text': 'Debes seleccionar la especie'
            }).css("display", "block")
        );

        ok = false;
    }

    return ok;
}

function validarNumChip(num) {

    var error = false;

    if (num.val().substring(0, 3) != "941") {
       
        $(num).parent().append(
            $("<span>", {
                "class": "errorValidacion",
                "text": "El nº de chip debe empezar por 941..."
            }).css("display", "block")
        )

        error = true;



    } else if (!num.val().match(/^\d{15}$/)) {
        $(num).parent().append(
            $("<span>", {
                "class": "errorValidacion",
                "text": "En nº debe contener al menos 15 dígitos"
            }).css("display", "block")
        )

        error = true;

    }

    if(error){
        $(num).css("border", "1px solid #FD7A7C")
    }
}

function validarEmail(campo) {

    if ($(campo).val() != "") {

        var regexp = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

        if (!regexp.test($(campo).val())) {
            insertarTextoError(campo, "Email incorrecto");
        }
    }
}

function comprobarRol(select) {

    if ($(select).children("option:selected").val() == 0) {
        insertarTextoError($(select), "Debes seleccionar un rol");
    }

}

function validarSoloLetras(campo) {

    if ($(campo).val() != "") {

        var regexp = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;

        if (!regexp.test($(campo).val())) {
            insertarTextoError(campo, "Sólo se admiten letras");
        }
    }

}

function validarObligatorio(campo) {
    if ($(campo).val() == "") {
        insertarTextoError(campo, "Campo obligatorio");
    }
}

function validarDni(campo) {

    if ($(campo).val() != "") {

        var regexp = /^\d{8}[a-zA-Z]$/;

        if (!regexp.test($(campo).val())) {
            insertarTextoError(campo, "Debe ser 8 números y una letra");
        } else {
            var letraDNI = $(campo).val().substring(8, 9).toUpperCase();
            var numDNI = parseInt($(campo).val().substring(0, 8));

            //Se calcula la letra correspondiente al número
            var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
            var letraCorrecta = letras[numDNI % 23];
            if (letraDNI != letraCorrecta) {
                insertarTextoError(campo, "La letra introducida no es correcta, revísala");
            }
        }
    }
}

function comprobarNombreTratamientoRep(nombre) {

    $.ajax({
        type: "get",
        url: "../app/Ajax/envatraAjax.php",
        cache: false,
        data: {
            nuevoTratamiento: $(nombre).val()
        },
        success: function (response) {
            if (response) {
                insertarTextoError($(nombre), "Ya existe un tratamiento con ese nombre");
            }


        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });

}

function comprobarNombreEnfermedadRep(nombre) {

    $.ajax({
        type: "get",
        url: "../app/Ajax/envatraAjax.php",
        cache: false,
        data: {
            nuevaEnfermedad: $(nombre).val()
        },
        success: function (response) {
            if (response) {
                insertarTextoError($(nombre), "Ya existe una enfermedad con ese nombre");
            }


        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });
}

function comprobarNombreVacunaRep(nombre) {

    $.ajax({
        type: "get",
        url: "../app/Ajax/envatraAjax.php",
        cache: false,
        data: {
            nuevaVacuna: $(nombre).val()
        },
        success: function (response) {
            if (response) {
                insertarTextoError($(nombre), "Ya existe una vacuna con ese nombre");
            }


        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });
}

function validarDecimal(campo) {

    if ((!$(campo).val().match(/^[0-9]{1,3}(\.[0-9][0-9]){0,2}$/))) {
        insertarTextoError(campo, 'Formato correcto "000.00"');

    }
}

function validarNumCuenta(numCuenta) {

    if (!$(numCuenta).val().match(/^(ES)(\d\d)\s(\d\d\d\d)\s(\d\d\d\d)\s(\d\d\d\d)\s(\d\d\d\d)$/)) {

        insertarTextoError(numCuenta, "Error el número de cuenta, revísalo");

    }

}

function validarFechaSuperior(fecha) {

    if($(fecha).val!=""){

    var fechaActual = new Date();

    var fechaIntroducida = new Date($(fecha).val());

    if (fechaIntroducida > fechaActual) {
        insertarTextoError(fecha, 'La fecha introducida no puede ser superior a a la actual');
    }

}

}

function eliminarErrorresInputs(campo){
    $(campo).css("border", "1px solid #ced4da");
    $(campo).parent().find(".errorValidacion").remove();
}

function eliminarErrorresInputsForm(form){
    $(form).find("input").css("border", "1px solid #CCC");
    $(form).find("select").css("border" ,"1px solid #CCC");
    $(form).find(".errorValidacion").remove();
}

function validarSelectObligatorio(select){
    
    if($(select).val()==null){
        $(select).css("border", "1px solid #FD7A7C");
        insertarTextoError(select, "Debes seleccionar una espacie")
    }
}










