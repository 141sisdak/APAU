$(function () {
    
    
    // I - Datatable
   

    $.fn.dataTable.moment( 'D/M/YYYY' );



    var tablaRescates = $("#tablaRescates").DataTable({
        
        dom: "<'row filtrosRescates'<'col-sm-3 'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",


        "language": {
            
            "decimal":        "",
    "emptyTable":     "No existen registros",
    "info":           "Total registros: _TOTAL_",
    "infoEmpty":      "",
    "infoFiltered":   "(de un total de _MAX_ registros)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Resultados por página _MENU_",
    "loadingRecords": "Cargando...",
    "processing":     "Processing...",
    "zeroRecords":    "No se han encontrado registros",
    "paginate": {
        "first":      "Primera",
        "last":       "Última",
        "next":       "Siguiente",
        "previous":   "Anterior"
    }


        },
        'info': true,
        "ajax": {
            "method": "GET",
            "url": "../app/Ajax/rescatesAjax.php",
            "dataSrc": "",
            "data": {
                getRescates: "getRescates"
            }
        },
        "initComplete": function (settings, json) {

            $(".filtrosRescates").append(
                $('<div>', {
                    "class": "button-group dropdown"
                }).append(
                    $('<button>', {
                        "type":"button",
                        "class":"dropCampos dropdown-toggle",
                        "data-toggle":"dropdown"
                    }).append(
                        $('<span>',{
                            "class":"glyphicon glyphicon-cog"
                        })
                    ).append(
                        $('<span>',{
                            "class":"caret",
                            "text":"Mostrar/Ocultar campos"
                        })
                    )
                ).append(
                    $('<ul>',{
                        "class":"dropdown-menu listaDrop",
                        "id":"listaCampos"
                    })
                )             
            );

    crearListaPersCampos();

    $("#btnTodos").click(function () {
        $("#listaCampos input[type='checkbox']:not(:checked)")
            .each(function () {
                $(this).prop("checked", true).trigger("change");
            })
    })

    $("#listaCampos input[type='checkbox']").change(function () {
        var indice = $("table tr:first").find("th:contains(" + $(this).val() + ")").index();

        $("table tr:first").find("th:contains(" + $(this).val() + ")").toggle();
        $("table td:nth-child(" + (indice + 1) + ")").toggle();


    });


           
            var page = window.location.href;
            var part = page.split("=");
            part = part[1];
            

            
            $('.dropdownMenuAcciones').click(function(){
              
                var id_animal = $(this).parent().parent().parent().children(":first-child").text();
                var fila = $(this).parent().parent().parent().index();

                window.localStorage.setItem("idResc", id_animal);
                window.localStorage.setItem("fila", fila);
             
            })

           $(".dropdownMenuAcciones ~ div").find("a:contains('Eliminar')").on("click", function(){
            console.log( $(".dropdownMenuAcciones ~ div").find("a:contains('Eliminar')"));
            $('#modal_confirmacion').modal("show");
           });

           $('#btnEliminar').click(function(){

            var fila = localStorage.getItem("fila");
            var idRescate = localStorage.getItem("idResc");

            $.ajax({
                type: "POST",
                url: "../app/Ajax/rescatesAjax.php",
                dataType: 'json',
                cache: false,
                data: {
                    eliminarRescate: idRescate
                },
                success: function(response) {
                    $(".mensajeConfirmacionAjax").show().css("display", "flex");
                  $("table tr:eq(" +(fila+1) + ")").remove();
                    $('#modal_confirmacion').modal("hide");
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + errorThrown);
                    console.warn(jqXHR.responseText);
                }
            }); 
            
           })

            
            //Construimos los selects

            this.api().columns([8, 9, 10, 11, 12,13]).every(function () {
                var column = this;
                var select = $('<br><br><select class="selects_tabla_rescates"><option value="">Todos</option></select>')
                    .appendTo($(column.header()))
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });

            });

         

            $("input:checkbox[name=adoptado]").on("change", function(){

                var adoptados = $('input:checkbox[name=adoptado]:checked').map(function(){
                    
                    return  this.value;
                    
                }).get().join('|');
            
                tablaRescates.column(4).search(adoptados,true,false,false).draw();

            });

            $("input:checkbox[name=esterilizado]").on("change", function(){

                var esterilizados = $('input:checkbox[name=esterilizado]:checked').map(function(){
                    
                    return  this.value;
                    
                }).get().join('|');
            
                tablaRescates.column(5).search(esterilizados,true,false,false).draw();

            });

          


            $('#fechaDesdeNac, #fechaHastaNac').change(function () {

                tablaRescates.draw();
            });

            $('#fechaDesdeIng, #fechaHastaIng').change(function () {

                tablaRescates.draw();
            });

            $('#fechaDesdeDesp, #fechaHastaDesp').change(function () {

                tablaRescates.draw();
            });

            $("#btnResetFiltros").on("click", function () {

                tablaRescates.search('').columns().search('').draw();
                $(":radio").prop("checked", false);
                $(":input").val("");
            });

            $(".peticion").on("click", function () {
              
                var envatras = new Array();
                //Obtenemos el id del animal subiendo hasta el tr y seleccionando el primer td
                //****Sería mejor usar parents().find()??****************** */
                var id_animal = $(this).parent().parent().parent().children(":first-child").text();
                
                

                window.localStorage.setItem("idResc", id_animal);

                //Obetenemos el tipo de consulta, en este caso es de enferemdades
                //*Span crea un espacio por defecto al final del texto, por eso hacemos el trim
                var tipo = $(this).text().toLowerCase().trim();
                

                //Obtenemos el div que contiene el desplegable para hacerle el append
                var menu = $(this).parent().find(".dropdown-menu");
                

                //Si no lo vaciamos en cada llamada, se van sumando en cada click
                $(menu).empty();

                //Hacemos la peticion pasando el id y el tipo de peticion obtenidos anteiormente
                $.getJSON("../app/Ajax/rescatesAjax.php", { idAnimal: id_animal, tipoPeticion: tipo })
                    //En caso de éxito creamos un bucle que mostrará el tipo de peticion (enfermedades, vacunas o tratamientos) que tenga asignadas
                    //ese animal
                    .done(function (data) {

                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                $(menu).append(

                                    $('<div>', {
                                        'class': 'dropdown-item verEnvatras',
                                        'text': data[i].tipo
                                    })
                                );
                                envatras.push(data[i].tipo)
                            }
                            //Guardamos en el localstorage los envatras que tiene el animal rescatado
                            localStorage.setItem("envatrasResc", envatras);
                           
                            //Creamos el divider
                            crearDividerLink(id_animal, tipo, menu);
                            //Si no tiene, lo mostramos al usuario
                        } else {
                            $(menu).append(

                                $('<div>', {
                                    'class': 'dropdown-item verEnvatras',
                                    'text': 'Sin ' + tipo
                                })
                            );

                            crearDividerLink(id_animal, tipo, menu);
                        }

                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        if (console && console.log) {
                            console.log("La solicitud a fallado: " + errorThrown);
                            console.warn(jqXHR.responseText);
                        }
                    });
            });
        },
        "columns": [
            { "data": "id"},
            { "data": "nombre" },
            { "data": "fechaNac" },
            { "data": "fechaIngreso" },
            { "data": "estadoAdop",
            "render": function (data, type, row) {
                if(data==="adoptado"){
                        return '<img src="../web/css/imagenes/icono_si.png"/>';
                    }else{
                        return '<img src="../web/css/imagenes/icono_no.png"/>';
                    }
                }
            },
            { "data": "esterilizado",
            "render": function (data, type, row) {
                if(data==="si"){
                        return '<img src="../web/css/imagenes/icono_si.png"/>';
                    }else{
                        return '<img src="../web/css/imagenes/icono_no.png"/>';
                    }
                } 
            },
            { "data": "numchip" },
            { "data": "ult_despa" },
            { "data": "especie" },
            { "data": "raza" },
            { "data": "tamanyo" },
            { "data": "localidad" },
            { "data": "refugio" },
            { "data": "registrador" },
            null,
            null,
            null,
            null
        ],
        
        "columnDefs": [
            {
                "targets": -4,
                "render": function (data, type, row, meta) {
                    var dropdownAcciones = '<div class="dropdown">' +
                        '<button class="drop_tabla_rescates dropdownMenuAcciones" type="button" id="dropdownMenuAcciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        '<img src="../web/css/imagenes/rueda-dentada.png" alt="configuracion"/>' +
                        '<img src="../web/css/imagenes/flecha_dropdown.png" alt="">'+
                        '</button>' +
                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuAcciones">' +
                        '<a class="dropdown-item" href="index.php?ctl=verAnimal&id=' + row.id + '">Ver ficha rescate</a>' +
                        '<a class="dropdown-item" href="index.php?ctl=modificarRescate&id=' + row.id + '">Modificar rescate</a>' +                        
                        '<a class="dropdown-item" href="#">Eliminar rescate</a>' +
                        '</div>' +
                        '</div>'
                    dropdownAcciones = $($.parseHTML(dropdownAcciones));

                    return dropdownAcciones.prop("outerHTML");
                },


                "orderable": false
            },
            {
       "targets": -3,
                "render": function (data, type, row, meta) {
                    var dropdownEnfermedades = '<div class="dropdown">' +
                        '<button class="drop_tabla_rescates dropdownMenuEnfermedades peticion" type="button" id="dropdownMenuEnfermedades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        '<img src="../web/css/imagenes/icono_enfermedades_tabla.png" alt="">'+
                        '<span class="texto_drop_tabla">Enfermedades</span>'+
                        ' <img src="../web/css/imagenes/flecha_dropdown.png" alt=""></img>'+
                        '</button>' +
                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuEnfermedades">' +
                        '</div>' +
                        '</div>'
                    dropdownEnfermedades = $($.parseHTML(dropdownEnfermedades));

                    return dropdownEnfermedades.prop("outerHTML");
                },


                "orderable": false
            },

            {
      "targets": -2,
                "data": null,
                "defaultContent": '<div class="dropdown">'+
                '<button class="drop_tabla_rescates dropdownVacunas peticion" type="button" data-toggle="dropdown">'+
                '<img src="../web/css/imagenes/icono_vacunas_tabla.png" alt=""/>'+
                '<span class="texto_drop_tabla">Vacunas</span>'+
                ' <img src="../web/css/imagenes/flecha_dropdown.png" alt=""/>'+
                '</button>'+
                '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
                '</div>'+
                '</div>',
                "orderable": false
            },
            {
         "targets": -1,
                "data": null,
                "defaultContent": '<div class="dropdown">'+
                '<button class="drop_tabla_rescates dropdownTratamientos peticion" type="button" data-toggle="dropdown">'+
                '<img src="../web/css/imagenes/icono_tratamientos_tabla.png" alt=""/>'+
                ' <span class="texto_drop_tabla">Tratamientos</span>'+
                ' <img src="../web/css/imagenes/flecha_dropdown.png" alt=""/>'+
                '</button>'+
                '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
                '</div>'+
                '</div>',
                "orderable": false
            },
          
            {
                "targets": [1, 2, 3, 4, 5, 6, 7],
                "data": null,
                "defaultContent": "Por definir"
            },
            {
                "targets": [0, 4, 5, 6, 8, 9, 10, 11, 12,13],
                "orderable": false
            },
            {

                "render": function (data, type, row) {
                   
                    if(data == null){
                        return "Por definir";
                    }
                    return moment(data).format("DD/MM/YYYY");
                },
                "targets": [2, 3, 7]
            },
        ]
    });

   

    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {

            if (settings.nTable.id !== 'tablaRescates') {
                return true;
            }

            if ($("#fechaDesdeIng").val() != "" || $("#fechaHastaIng").val() != "") {



                var min = new Date($("#fechaDesdeIng").val()).getTime() - 86400000;

                var max = new Date($("#fechaHastaIng").val()).getTime();

                var fecha = data[3];

                var fechaSpliteada = fecha.split("/");

                var fechaTabla = new Date(fechaSpliteada[2], (fechaSpliteada[1] - 1), fechaSpliteada[0]).getTime();

                if (isNaN(min) && isNaN(max) ||
                    isNaN(max) && min <= fechaTabla ||
                    isNaN(min) && max >= fechaTabla ||
                    min <= fechaTabla && max >= fechaTabla) {
                    return true;
                }

            } else if ($("#fechaDesdeNac").val() != "" || $("#fechaHastaNac").val() != "") {
                var min = new Date($("#fechaDesdeNac").val()).getTime() - 86400000;

                var max = new Date($("#fechaHastaNac").val()).getTime();

                var fecha = data[2];

                var fechaSpliteada = fecha.split("/");

                var fechaTabla = new Date(fechaSpliteada[2], (fechaSpliteada[1] - 1), fechaSpliteada[0]).getTime();

                if (isNaN(min) && isNaN(max) ||
                    isNaN(max) && min <= fechaTabla ||
                    isNaN(min) && max >= fechaTabla ||
                    min <= fechaTabla && max >= fechaTabla) {
                    return true;
                }
            } else if ($("#fechaDesdeDesp").val() != "" || $("#fechaHastaDesp").val() != "") {
                var min = new Date($("#fechaDesdeDesp").val()).getTime() - 86400000;

                var max = new Date($("#fechaHastaDesp").val()).getTime();

                var fecha = data[7];

                var fechaSpliteada = fecha.split("/");

                var fechaTabla = new Date(fechaSpliteada[2], (fechaSpliteada[1] - 1), fechaSpliteada[0]).getTime();

                if (isNaN(min) && isNaN(max) ||
                    isNaN(max) && min <= fechaTabla ||
                    isNaN(min) && max >= fechaTabla ||
                    min <= fechaTabla && max >= fechaTabla) {
                    return true;
                }
            }

            else {
                return true;
            }


            return false;
        }
    );

    $('#busquedaResacate').on('keyup change', function(){
        tablaRescates.search($(this).val()).draw() ;
  });


    // F - Datatable


    function crearListaPersCampos() {

        var tds = $("table tr:first").children();

       tds = $.grep(tds, function(value){
           return $(value).text()!=""
       })
       

        $.each(tds, function (indexInArray, valor) {

            $('#listaCampos').append(
                $("<li>", { "text": $(valor).text() }).prepend(
                    $("<input>", {
                        'type': 'checkbox',
                        'value': $(valor).text()
                    }).attr("checked", true)
                )
            )
        });
        $('#listaCampos').append(
            $('<div>', {
                'class': 'dropdown-divider'
            })

        ).append(
            $('<button>', {
                'class': 'btn btn-primary',
                'name': 'btnListaCampos',
                'text': 'Todos',
                'id': 'btnTodos'
            })
        )
    }
    //Funcion que setea los checkbox sin check
   
    /**Esta funcion busca las enfermedes, vacunas y tratamientos de cada animal y relaiza una peticion Ajax para rellenar el dropdown.
     * Además, crea un divider y un enlace para asignar una de las anteriores mencionadas
     */

    //Para evitar repetir codigo creamos una funcion quey añade un divider y  un link para asignar uno nuevo a ese animal

    function crearDividerLink(id, tipoPeticion, menu) {
        $(menu).append(
            $('<div>', {
                'class': 'dropdown-divider'
            })
        );

        $(menu).append(
            $('<span>', {
                'class': 'dropdown-item asignarEnvatra ' + tipoPeticion,
                'text': "Asignar " + tipoPeticion,
                'data-toggle':"modal",
                'data-target':"#asignar_" + tipoPeticion

            })
        );
    }

    $("#asignar_vacunas, #asignar_enfermedades, #asignar_tratamientos").on('shown.bs.modal', function () {

        var envatras1 = localStorage.getItem("envatrasResc");

        envatras1 = envatras1.split(",");

        $(this).find("option").each(function(){
            var option = $(this);

            $(envatras1).each(function(){
               if($(option).text() == this){
                   $(option).prop('disabled', 'disabled');
               }
            });
            
       });

    });

    //Asignar envatra desde tabla rescates
    $(".btn_asignarEnvatra").click(function(){
        
        var id = localStorage.getItem("idResc")
        var envatra = $(this).parent().find("h5").text();
        var opcionesSelec ="";
        
        switch (envatra) {
            case "ins_enf":
                opcionesSelec = $("#multi_enfermedades").val();

              
               
                break;
            case "ins_vac":
                opcionesSelec = $("#multi_vacunas").val();
                break;
            case "ins_trat":
                opcionesSelec = $("#multi_tratamientos").val();
                break;
        }
      
        $.ajax({
            type: "post",
            url: "../app/Ajax/rescatesAjax.php",
            dataType: 'text',
            data: { ins_envatra: envatra, idRescate: id, select: JSON.stringify(opcionesSelec) },
            success: function (response) {
                location.reload();
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });
    });

  

    //Modificacion de enfermedades, vacunas y tratamientos (modRescate.php)
    $(".envatra input").change(function () {
        
      
        if ($(this).parent().parent().find("input").is(":checked")) {
           

            $(this).parent().parent().siblings("span").find("button").prop("disabled", false);
        } else {
            $(this).parent().parent().siblings("span").find("button").prop("disabled", true);
           
        }
    });

    $(".btnEliminar").click(function () {
        var id = $('#id_rescate').text();
        console.log( $(this).parent().siblings(".envatra").find("input:checkbox:checked"));

        var checked = new Array();
        $(this).parent().siblings(".envatra").find("input:checkbox:checked").each(function () {
            checked.push($(this).val());
        });
        var envatra = $(this).parent().text().toLowerCase().trim();

        



        $.ajax({
            type: "post",
            url: "../app/Ajax/rescatesAjax.php",
            dataType: 'text',
            data: { 'checked': JSON.stringify(checked), id_resc: id, envatra_tipo: envatra },
            success: function (response) {
                location.reload();
            }
        })
 
    });

    $('#enfermedadesModal,#vacunasModal, #tratamientosModal').on('shown.bs.modal', function () {

        //Obtener todas las enfermedades de la ESPECIE
        var especie = $('#enfermedadesModal').attr("aria-labelledby");
        var envatra = $(this);
        var peticion = "";
        var tipo = "";

        //Eliminamos el select anterior para que no lo vuelva a cargar
        $(this).find("select").remove();

        switch ($(this).attr("id")) {
            case "enfermedadesModal":
                peticion = "enfermedades";
                tipo = "enfermedad";
                break;
            case "vacunasModal":
                peticion = "vacunas";
                tipo = "nombre"

                break;
            case "tratamientosModal":
                peticion = "tratamientos";
                tipo = "tratamiento"
                break;
        }

        envatras = new Array();
        var id_animal = $("#id_rescate").text();
        //Hacemos una petición ajax para obtener las enfermedades del animal
        $.getJSON("../app/Ajax/rescatesAjax.php", { idAnimal: id_animal, tipoPeticion: peticion })

            .done(function (datos) {

                if (datos.length > 0) {
                    for (var i = 0; i < datos.length; i++) {
                        envatras.push(datos[i].id);
                    }
                }

            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + errorThrown);
                    console.warn(jqXHR.responseText);
                }
            });

        //Hacemos una peticion ajax para obtener todas las enfermedades
        $.ajax({
            type: "get",
            url: "../app/Ajax/rescatesAjax.php",
            dataType: 'json',
            data: { getEnvatra: peticion },
            success: function (response) {
                var respuesta = response;

                //Eliminamos las enfermedades que ya tiene el animal para que el usuario no las pueda volver a seleccionar
                for (var i = 0; i < respuesta.length; i++) {
                    if ($.inArray(respuesta[i]["id"], envatras) != -1) {
                        respuesta.splice(i, 1);
                        i--;

                    }

                }

                //Añadimos el select con las options correspondientes 
                $(envatra).find(".modal-body").prepend(

                    $("<select>", {
                        'name': 'asignarEnvatras[]',
                    }).attr("multiple", "multiple")
                );
                for (let i = 0; i < response.length; i++) {
                    $("select").append(
                        $("<option>", {
                            'value': response[i]["id"],
                            'text': response[i][tipo]
                        })
                    )
                }
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });

    });
    $('.btnAceptar').click(function () {
        var id = $('#id_rescate').text();
        var opcionesSelec = $(this).parent().parent().find("select").val();
        var envatra = $(this).attr("id");


        $.ajax({
            type: "post",
            url: "../app/Ajax/rescatesAjax.php",
            dataType: 'text',
            data: { ins_envatra: envatra, idRescate: id, select: JSON.stringify(opcionesSelec) },
            success: function (response) {
                location.reload();
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });
    });




});