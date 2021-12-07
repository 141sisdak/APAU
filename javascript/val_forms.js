$(function () {
    $("#actual").val(window.location.href);
    $("#actualCont").val(window.location.href);

    // I - VALIDACION LOGIN*************************************************************************
    $("#formLogin").submit(function (event) {
        //Reseteamos cualquier estilo de fallos anteriores
        $("#usuVacio").css("display", "none");
        $("#passVacio").css("display", "none");
      

        if (!validacionLogin()) {
            event.preventDefault();
           
        }
    });

    
    // F - VALIDACION LOGIN*************************************************************************

    // I - VALIDACION EMAIL (modal recordar)*************************************************************************

    $('#btnEnviarRec').click(function(){
        eliminarErrorresInputsForm($('#formRecordar'));        
        comprobarObligatorios($("#formRecordar").find(".obligatorio"));
        validarEmail($('#emailRec'));
        comprobarEmailExistente($('#emailRec'));

        setTimeout(function(){
            $('#formRecordar').submit();
        },1000);

      

    });

    // F - VALIDACION EMAIL (modal recordar)*************************************************************************

    // I - VALIDACION MOD PERFIL*************************************************************************

    $('#btnEnviarModPerfil').click(function(){

        eliminarErrorresInputsForm($('#formModPerfil'));

        validarEmail($('#emailMod'));
        validarTelf($('#telfMod'));

        if(!$(".errorValidacion").length){
            $('#formModPerfil').submit();
          }

    });
    
    // F - VALIDACION MOD PERFIL*************************************************************************

     // I - VALIDACION MOD PASS*************************************************************************

     $('#btnEnviarModPass').click(function(){

        eliminarErrorresInputsForm($('#formModPass'));

        comprobarObligatorios($("#formModPass").find(".obligatorio"));

        if(!$(".errorValidacion").length){
            validaPass($("#passAct"));
            comprobarPasswordS($(passMod1), $(passMod2));
        }
        setTimeout(function(){
            if(!$(".errorValidacion").length){
              $('#formModPass').submit();
            }
        },1300);
        

     })

      // F - VALIDACION MOD PASS*************************************************************************

    // I - VALIDACION NUEVO RESCATE*************************************************************************

    //Ocultamos el formulario 
    $("#formAdotante").toggle();

    //Funcion que muestra el "formulario" del adoptante en el modal del nuevo rescate. 
    //Ademas oculta el select del adoptatne    
    $('#adopNuevoDesplegable').click(function (event) {
        eliminarErrorresInputsForm($('#formAdotante'));
        $("#formAdotante").slideToggle();
        $("#nSelAdoptante").toggle();
        $('#nSelAdoptante').val(0);

       
    });
 
    //Boton de envio de formulario del nuevo adoptante
    $("#btnEnviarNuevoRescate").click(function (event) {
        event.preventDefault();

        //reseteamos posible error del select de especie para que no se repita en el proximo intento
        if($(".selectObligatorio").next().hasClass("errorValidacion")){
            $(".selectObligatorio").siblings().remove();
            $(".selectObligatorio").css("border", "1px solid #CCC")
        }
       

      validarSelectObligatorio($(".selectObligatorio"));

      if($("#formAdotante").css("display")!="none"){

        eliminarErrorresInputsForm($("#formAdotante"));
            
        var obligatorios = $("#formAdotante .obligatorio");        
        comprobarObligatorios(obligatorios);
        
        validarTelf($("#telf1Adop"));
        validarTelf($("#telf2Adop"));
        validarDni($("#dniAdop"));
        validarEmail($("#emailAdop"));

    }

    if($(".errorValidacion").length==0){
        $('#formNuevoRescate').submit();
    }
        
    });

    $(".selectObligatorio").change(function(){
        $(this).css("border", "1px solid #ced4da");
        $(this).parent().find(".errorValidacion").remove();
    
    });

    $("#formNuevoRescate").find("input[type='date']").change(function(){
     
        
        eliminarErrorresInputs($(this))
        validarFechaSuperior($(this));
    });

    $("#nNumChip").blur(function(){
        eliminarErrorresInputs($(this))
        if($(this).val()!=""){
            validarNumChip($(this));
        }
    });

    //I - Validacion nuevo adoptante (modal)

    

    //F - Validacion nuevo adoptante (modal)

    

   

    // F - VALIDACION NUEVO RESCATE*************************************************************************


    $("#nSelEspecie, #modSelEspecie").change(function (e) {

        idEspecie = $(this).val();
      

        $("#nSelRaza, #modSelRaza").empty();
        rellenarRazas(idEspecie, $(this));

    });
    /**Mediante peticcion Ajax rellenamos el select de razas */
    function rellenarRazas(idEspecie, select) {

        var selectEspecie = $(select).prop("id");
        var $selRaza;

        if (selectEspecie == "nSelRaza") {
            $selRaza = $("#nSelRaza");
        } else {
            selectEspecie = $("#modSelRaza");
        }

        

        $.getJSON("../app/Ajax/rescatesAjax.php", { especie: idEspecie })
            .done(function (data) {
                
                //Insertamos el valor para mestizo segun la especie que se ha seleccionado previamente
                var mestizo = "";
                if (idEspecie == "1") {
                    mestizo = 1;
                } else {
                    mestizo = 207;
                }
                    //En funcion de la especie seleccionada pondremos el valor de mestizo
                $("#nSelRaza, #modSelRaza").append(
                    $('<option>', {
                        'value': mestizo,
                        'text': 'Mestizo'
                    })
                    
                ).append(
                   
                    $('<option>', {
                        'text': '_____________',
                        'disabled':true
                    })

                )
                if (data.length > 0) {

                  
                    for (var i = 0; i < data.length; i++) {
                      
                        $("#nSelRaza, #modSelRaza").append(
                            $('<option>', {
                                'value': data[i].id,
                                'text': data[i].nombre
                            })
                        )
                    }

                    $("#nSelRaza, #modSelRaza").removeAttr("disabled");
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + errorThrown);
                    console.warn(jqXHR.responseText);
                }
            });
    }


    $('body').on('init.dt', function (e, ctx) {
        

        $("table").on("click", ".btnEliminarRegistro",  function () {
            

            $('#modal_confirmacion').modal("show");

            var clase = "";

            var urlAjax = "";

            var id = $(this).parent().parent().find("td:first-child").text();

            var fila = $(this).parent().parent().index();


            var clases = $(this).attr("class").split(" ");

            if (clases.length == 4) {
                clase = clases[3];
            } else {
                clase = clases[2];
            }

            switch (clase) {
                case "tratamientos":
                case "enfermedades":
                case "vacunas":
                    urlAjax = "../app/Ajax/envatraAjax.php"
                    break;
                case "usuarios":
                    urlAjax = "../app/Ajax/usuariosAjax.php"
                    break;
                case "adoptante":
                    urlAjax = "../app/Ajax/adoptanteAjax.php"
                    break;
                case "refugios":
                    urlAjax = "../app/Ajax/refugiosAjax.php"
                    break;
                case "gastos":
                    urlAjax = "../app/Ajax/gastosAjax.php"
                    break;
                case "socios":
                    urlAjax = "../app/Ajax/sociosAjax.php"
                    break;
                case "donaciones":
                    urlAjax = "../app/Ajax/donacionesAjax.php"

            }

            console.log(urlAjax);

            localStorage.setItem("clase", clase);
            localStorage.setItem("urlAjax", urlAjax);
            localStorage.setItem("id", id);
            localStorage.setItem("fila", fila);
        });

    });

    $('#btnEliminar').click(function () {
        console.log(localStorage);

        $.ajax({
            type: "POST",
            url: localStorage.getItem("urlAjax"),
            cache: false,
            data: {
                idDelete: localStorage.getItem("id"), envatra: localStorage.getItem("clase")
            },
            success: function (response) {

                $("table tr:eq(" + (parseInt(localStorage.getItem("fila")) + 1) + ")").remove();
                $('#modal_confirmacion').modal("hide");
                if($(".mensajeConfirmacion").length>0){
                    $(".mensajeConfirmacion").css("display", "none");
                }
                $(".mensajeConfirmacionAjax").show().css("display", "flex");
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);

            }
        });

    });

    $('.btn_cerrarConfirmacion').click(function(){
        $(this).parent().css("display", "none");
    })




});
