$(function () {

    // I - Datatable

    $.fn.dataTable.moment('DD/MM/YYYY');

    var tablaUsuarios = $("#tablaUsuarios").DataTable({

        dom: "<'row filtrosUsuarios'<'col-sm-12 col-md-2 'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",


        "language": {
            "lengthMenu": "Registos por página _MENU_ ",
            "search": "Buscar:",
            "zeroRecords": "No se han obtenido registros",
            "info": "Total registros: _TOTAL_",
            "infoEmpty": "No hay registros",
            "thousands": " ",
            "infoFiltered": "(de un total de _MAX_ registros)",
            "paginate": {
                "first": "Primera",
                "last": "Última",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        'info': true,
        "ajax": {
            "method": "GET",
            "url": "../app/Ajax/usuariosAjax.php",
            "dataSrc": ""

        },
        "columns": [
            { "data": "id" },
            { "data": "usuario" },
            { "data": "permitido" },
            { "data": "rol" },
            { "data": "fecha_alta" },
            { "data": "telefono" },
            { "data": "email" },
            null,
            null,
            { "data": "permitido",
            "render": function (data, type, row) {
                if(data==="0"){
                    
                        return '<button type="button" class="btn_icono_tabla btnPermitir"><img src="../web/css/imagenes/icono_si.png" style="margin-top: 10px;"></button>';
                    }else{
                        return '<div></div>';
                    }
                }
            },
        ],
        "initComplete": function (settings, json) {

            $("input:checkbox[name=cbxSinPermiso]").on("change", function () {



                var noPermitidos = $('input:checkbox[name=cbxSinPermiso]:checked').map(function () {
        
                    return this.value;
        
                }).get().join('|');
        
                console.log(this.value);
        
                tablaUsuarios.column(9).search(noPermitidos, true, false, false).draw();
        
            });

            $("#tablaUsuarios tbody").children().each(function () {
                if ($(this).find("td:nth-child(3)").text() == "0") {

                    $(this).css("color", "red");

                } 

            });

            $('.btnPermitir').click(function () {


                $('#modalMensajes').find(".mensaje").remove();

                var permitido = $(this).parent().parent().find("td:nth-child(3)").text();
                var usuario = $(this).parent().parent().find("td:nth-child(2)").text();
                var idUsuario = $(this).parent().parent().find("td:first").text();
                var email = $(this).parent().parent().find("td:nth-child(7)").text();
                var btnPermitir = $(this);
                var fila = $(this).parent().parent();
                if (permitido == "0") {

                    $.ajax({
                        type: "POST",
                        url: "../app/Ajax/usuariosAjax.php",
                        cache: false,
                        data: {

                            permitirUsuario: idUsuario, emailUsuario: email, nombreUsuario: usuario
                        },
                        success: function (respuesta) {
                            if (respuesta) {
                                $(btnPermitir).prop("disabled", true);
                                $(fila).css("color", "#838383");
                                $('#modalMensajes').find(".cab-item-filtros").text("Se le ha concedido acceso a " + usuario);
                                $('#modalMensajes').modal("show")
                                $(btnPermitir).remove();

                            }
                        }
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        if (console && console.log) {
                            $('#modalMensajes').find(".cab-item-filtros").text("ERROR: No se ha podido realizar la acción de permitir el acceso.");
                            $('#modalMensajes').modal("show")
                            console.log("La solicitud a fallado: " + errorThrown);
                            console.log(textStatus);
                            console.warn(jqXHR.responseText);
                        }
                    });

                }

            });
            //Evento del boton OK de la ventana modal de mensaje
            $('.btnOkMensaje').click(function () {
                $("#modalMensajes").modal("hide");

            });



        },
        "columnDefs": [
            {
                "targets": -3,
                "data": null,
                "defaultContent": ' <button type="button" class="btn_icono_tabla btnModUsuario" data-toggle="modal"  data-target="#modficarUsuario"><img src="../web/css/imagenes/icono_modificar_tabla.png"/></button>',
                "orderable": false
            },
            {
                "targets": -2,
                "data": null,
                "defaultContent": '<button type="button" class="btn_icono_tabla btnEliminarRegistro usuarios" ><img src="../web/css/imagenes/icono_borrar_tabla.png"/></button>',
                "orderable": false
            },

            {
                "targets": 0,
                "data": "id",
                "searchable": false,
                "className": "idOculto"
            },
            {
                "targets": 2,
                "data": "permitido",
                "className": "idOculto"
            },

            {
                "targets": [3, 5, 6,9],
                "orderable": false

            },
            {

                "render": function (data, type, row) {
                    return moment(data).format("DD/MM/YYYY");
                },
                "targets": 4
            },



        ]
    });



    $('#fechaAltaDesde, #fechaAltaHasta').change(function () {

        tablaUsuarios.draw();
    });

    $('#busquedaUsuarios').on('keyup change clear', function () {
        tablaUsuarios.search(this.value).draw();
    });


   


    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {

            if (settings.nTable.id !== 'tablaUsuarios') {
                return true;
            }

            var min = new Date($("#fechaAltaDesde").val()).getTime() - 86400000;

            var max = new Date($("#fechaAltaHasta").val()).getTime();

            var fecha = data[4];

            var fechaSpliteada = fecha.split("/");

            var fechaTabla = new Date(fechaSpliteada[2], (fechaSpliteada[1] - 1), fechaSpliteada[0]).getTime();

            if (isNaN(min) && isNaN(max) ||
                isNaN(max) && min <= fechaTabla ||
                isNaN(min) && max >= fechaTabla ||
                min <= fechaTabla && max >= fechaTabla) {
                return true;
            }
            return false;
        }
    );

    // F - Datatable

    // I - Validacion del formulario de nuevo usuario********************************
    $('#btnNuevoUsuario').click(function (e) {

        eliminarErrorresInputsForm($('#formNuevoUsuario'));

        comprobarNombreRep($("#nombreUsuario"));

        comprobarObligatorios($("#formNuevoUsuario").find(".obligatorio"));

        comprobarPasswordS($('#pass1'), $("#pass2"));

        validarTelf($("#telefono"));

        validarEmail($("#email"));


        setTimeout(function () {
            if ($(".errorValidacion").length > 0) {
            } else {

                $('#formNuevoUsuario').submit();
            }
        }, 1000);
    });

    // F - Validacion del formulario de nuevo usuario********************************


    // I - Validacion y procesamiento del modal de modificacion de usuario********************************


    tablaUsuarios.on("click", ".btnModUsuario", function () {

        $(".errorValidacion").remove();

        var nombre = $(this).parent().parent().find("td:nth-child(2)").text();

        var modal = $(document).find("#formModUsuario");

        $.ajax({
            type: "get",
            url: "../app/Ajax/usuariosAjax.php",
            dataType: 'json',
            cache: false,
            data: {
                nombreMod: nombre
            },
            success: function (response) {
                if (response) {
                    $(modal).find($("#idUsuario").val(response.id));
                    $(modal).find($("#modNombreUsuario").val(response.usuario));
                    $(modal).find($("#modRolesSelect").val(response.rol));
                    $(modal).find($("#modTelefono").val(response.telefono));
                    $(modal).find($("#modEmail").val(response.email));
                    $(modal).find($("#idUsuario").val(response.id));

                    //Nos guardamos el nombre para saber si se ha modificado en el modal de modificacion
                    localStorage.setItem("nombreAnterior", response.usuario);
                    $('#mensModificado').prop("hidden", false);


                }
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });
    });

    $('#btnModUsuario').click(function (e) {

        $(".errorValidacion").remove();

        if (localStorage.getItem("nombreAnterior") != $("#modNombreUsuario").val()) {
            comprobarNombreRep($("#modNombreUsuario"));
        }

        comprobarObligatorios($('#formModUsuario').find(".obligatorio"));

        validarTelf($("#modTelefono"));

        validarEmail($("#modEmail"));


        setTimeout(function () {

            if ($(".errorValidacion").length > 0) {
                e.stopPropagation();

            } else {
                e.stopPropagation();
                $('#formModUsuario').submit();

            }
        }, 1000);

    });

    $('#btnRecordar').click(function (e) {
        e.preventDefault();

        $('#modalRecordar').modal("show");
    })




});