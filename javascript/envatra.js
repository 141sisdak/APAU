$(function(){

    //*********************************************INICIO*******TRATAMIENTOS**************************************************************
    //************************************************************************************************************************************
    //************************************************************************************************************************************

     // I - Datatable

     var tablaTratamientos = $("#tablaTratamientos").DataTable({
      
        dom:"<'row filtrosTratamientos'<'col-sm-12 col-md-2 'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      
      
        "language": {
            "lengthMenu": "Registos por página _MENU_ ",
            "search":         "Buscar:",
            "zeroRecords": "Cargando",
            "info": "Total registros: _TOTAL_",
            "infoEmpty": "No hay registros",
            "thousands": " ",
            "infoFiltered": "(de un total de _MAX_ registros)",
            "paginate": {
                "first":      "Primera",
                "last":       "Última",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        'info': true,
            "ajax":{
                "method": "GET",
                "url":"../app/Ajax/envatraAjax.php",
                "dataSrc": "",
                "data":{
                    getEnvatra:"tratamientos"
                }
            
            },
            "columns":[
                {"data":"id"},
                {"data":"tratamiento"},
                null,
                null
            ],
            "columnDefs":[
                {
                  "targets": -2,
                  "data":null,
                  "defaultContent":'<button type="button" class="btn_icono_tabla btnModTratamiento" data-toggle="modal"  data-target="#modficarTratamiento"><img src="../web/css/imagenes/icono_modificar_tabla.png"/></button>',
                  "orderable":false
                },
                {
                    "targets": -1,
                    "data":null,
                    "defaultContent":'<button type="button" class="btn_icono_tabla btnEliminarRegistro tratamientos"><img src="../web/css/imagenes/icono_borrar_tabla.png"/></button>',
                    "orderable":false
                },
                {
                    "targets":0,
                    "data":"id",
                    "searchable": false,
                    "className":"idOculto"
                }
                ]
    });

    

        $('#busquedaTratamiento').on('keyup change clear', function() {
            tablaTratamientos.search(this.value).draw();
           });
        

        // F - Datatable

    //I - Nuevo tratamiento

    $('#btnNuevoTratamiento').click(function(){

        $('.errorValidacion').remove();

    });

    $('#enviarNuevoTratamiento').click(function(e){

        $('.errorValidacion').remove();

        comprobarObligatorios($(".obligatorio"));

        if($('#nombreTratamiento').val()!=""){
            comprobarNombreTratamientoRep($("#nombreTratamiento"));
        }

        setTimeout(function() {
        
            if ($(".errorValidacion").length > 0) {

                e.stopPropagation();
                
              
            } else {
               
               console.log('se enviaria');
                
                $('#formNuevoTratamiento').submit();
              
            }
        }, 1000);

    });

     //F- Nuevo tratamiento

    //I- Modificacion tratamiento 

    tablaTratamientos.on("click", ".btnModTratamiento", function(){

        $('.errorValidacion').remove();

        var idTratamiento = $(this).parent().parent().find("td:first-child").text();
        var nombreTratamiento =$(this).parent().parent().children("td:nth-child(2)").text();

        $('#idTratamiento').val(idTratamiento);
        $('#modNombreTratamiento').val(nombreTratamiento);

    });

    $('#btnEnviarModTratamiento').click(function(e){

        $('.errorValidacion').remove();

        comprobarObligatorios($(".modObligatorio"));

        if($('#modNombreTratamiento').val()!=""){
            comprobarNombreTratamientoRep($("#modNombreTratamiento"));
        }

        setTimeout(function() {
        
            if ($(".errorValidacion").length > 0) {

                e.stopPropagation();
                             
            } else {
                
               $('#formModTratamiento').submit();
              
            }
        }, 1000);

    });

    //F- Modificacion tratamiento 

    //I- Eliminacion tratamiento 
    
    tablaTratamientos.on("click", ".btnEliminarTratamiento", function(){

        var id = $(this).parent().parent().children("td:first-child").text();
        var fila = $(this).parent().parent();

        $.ajax({
            type: "POST",
            url: "../app/Ajax/envatraAjax.php",
            cache: false,
            data: {
                idTratamientoDelete: id
            },
            success: function() {
                   $(fila).remove();
                   $('#mensEliminado').prop("hidden", false);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });

    });

    //F- Eliminacion tratamiento 

     //*********************************************FIN*******TRATAMIENTOS**************************************************************
    //************************************************************************************************************************************
    //************************************************************************************************************************************

   //*********************************************INICIO*******ENFERMEDADES**************************************************************
    //************************************************************************************************************************************
    //************************************************************************************************************************************

    // I - Datatable

    var tablaEnfermedades = $("#tablaEnfermedades").DataTable({
      
        dom:"<'row filtrosEnfermedades'<'col-sm-12 col-md-2 'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      
      
        "language": {
            "lengthMenu": "Registos por página _MENU_ ",
            "search":         "Buscar:",
            "zeroRecords": "Cargando",
            "info": "Total registros: _TOTAL_",
            "infoEmpty": "No hay registros",
            "thousands": " ",
            "infoFiltered": "(de un total de _MAX_ registros)",
            "paginate": {
                "first":      "Primera",
                "last":       "Última",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        'info': true,
            "ajax":{
                "method": "GET",
                "url":"../app/Ajax/envatraAjax.php",
                "dataSrc": "",
                "data":{
                    getEnvatra:"enfermedades"
                }
            
            },
            "columns":[
                {"data":"id"},
                {"data":"enfermedad"},
                null,
                null
            ],
            "columnDefs":[
                {
                  "targets": -2,
                  "data":null,
                  "defaultContent":'<button type="button" class="btn_icono_tabla btnModEnfermedad" data-toggle="modal"  data-target="#modficarEnfermedad"><img src="../web/css/imagenes/icono_modificar_tabla.png"/></button>',
                  "orderable":false
                },
                {
                    "targets": -1,
                    "data":null,
                    "defaultContent":'<button type="button" class="btn_icono_tabla btnEliminarRegistro enfermedades"><img src="../web/css/imagenes/icono_borrar_tabla.png"/></button>',
                    "orderable":false
                },
                {
                    "targets":0,
                    "data":"id",
                    "searchable": false,
                    "className":"idOculto"
                }
                ]
    });

   

        $('#busquedaEnfermedad').on('keyup change clear', function() {
            tablaEnfermedades.search(this.value).draw();
           });
        

        // F - Datatable


    //I - Nueva enfermedad
    $('#btnNuevaEnfermedad').click(function(){

        $(".errorValidacion").remove();

    });

    $("#enviarNuevaEnfermedad").click(function(e){

        $('.errorValidacion').remove();

        comprobarObligatorios($(".obligatorio"));

        if($('#nombreEnfermedad').val()!=""){
            comprobarNombreEnfermedadRep($("#nombreEnfermedad"));
        }

        setTimeout(function() {
        
            if ($(".errorValidacion").length > 0) {

                e.stopPropagation();
              
            } else {
                             
                $('#formNuevaEnfermedad').submit();
              
            }
        }, 1000);

    });

    //F - Nueva enfermedad

    //I - Modificacion enfermedad

   tablaEnfermedades.on("click", ".btnModEnfermedad", function(){

        $('.errorValidacion').remove();

        var idEnfermedad = $(this).parent().parent().find("td:first-child").text();
        var nombreEnfermedad =$(this).parent().parent().children("td:nth-child(2)").text();

        $('#idEnfermedad').val(idEnfermedad);
        $('#modNombreEnfermedad').val(nombreEnfermedad);

    });

    $('#btnEnviarModEnfermedad').click(function(e){

        $('.errorValidacion').remove();

        comprobarObligatorios($(".modObligatorio"));

        if($('#modNombreEnfermedad').val()!=""){
            comprobarNombreEnfermedadRep($("#modNombreEnfermedad"));
        }

        setTimeout(function() {
        
            if ($(".errorValidacion").length > 0) {

                e.stopPropagation();
                             
            } else {
               
              $('#formModEnfermedad').submit();
              
            }
        }, 1000);

    });

     //F - Modificacion enfermedad

      //I- Eliminacion enfermedad 

    tablaEnfermedades.on("click", ".btnEliminarEnfermedad", function(){

        var id = $(this).parent().parent().children("td:first-child").text();
        var fila = $(this).parent().parent();

        $.ajax({
            type: "POST",
            url: "../app/Ajax/envatraAjax.php",
            cache: false,
            data: {
                idEnfermedadDelete: id
            },
            success: function() {
                   $(fila).remove();
                   $('#mensEliminado').prop("hidden", false);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });

    });

    //F- Eliminacion enfermedad 

    //*********************************************FIN*******ENFERMEDADES**************************************************************
    //************************************************************************************************************************************
    //************************************************************************************************************************************

    //*********************************************INICIO*******VACUNAS**************************************************************
    //************************************************************************************************************************************
    //************************************************************************************************************************************

     // I - Datatable

     var tablaVacunas = $("#tablaVacunas").DataTable({
      
        dom:"<'row filtrosVacunas'<'col-sm-12 col-md-2 'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      
      
        "language": {
            "lengthMenu": "Registos por página _MENU_ ",
            "search":         "Buscar:",
            "zeroRecords": "Cargando",
            "info": "Total registros: _TOTAL_",
            "infoEmpty": "No hay registros",
            "thousands": " ",
            "infoFiltered": "(de un total de _MAX_ registros)",
            "paginate": {
                "first":      "Primera",
                "last":       "Última",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        'info': true,
            "ajax":{
                "method": "GET",
                "url":"../app/Ajax/envatraAjax.php",
                "dataSrc": "",
                "data":{
                    getEnvatra:"vacunas"
                }
            
            },
            "columns":[
                {"data":"id"},
                {"data":"nombre"},
                null,
                null
            ],
            "columnDefs":[
                {
                  "targets": -2,
                  "data":null,
                  "defaultContent":'<button type="button" class="btn_icono_tabla btnModVacuna" data-toggle="modal"  data-target="#modficarVacuna"><img src="../web/css/imagenes/icono_modificar_tabla.png"/></button>',
                  "orderable":false
                },
                {
                    "targets": -1,
                    "data":null,
                    "defaultContent":'<button type="button" class="btn_icono_tabla btnEliminarRegistro vacunas" ><img src="../web/css/imagenes/icono_borrar_tabla.png"/></button>',
                    "orderable":false
                },
                {
                    "targets":0,
                    "data":"id",
                    "searchable": false,
                    "className":"idOculto"
                }
                ]
    });

   

        $('#busquedaVacuna').on('keyup change clear', function() {
            tablaVacunas.search(this.value).draw();
           });
        

        // F - Datatable

    //I - Nueva vacuna
    $('#btnNuevaVacuna').click(function(){

        $(".errorValidacion").remove();

    });

    $("#enviarNuevaVacuna").click(function(e){

        $('.errorValidacion').remove();

        comprobarObligatorios($(".obligatorio"));

        if($('#nombreVacuna').val()!=""){
            comprobarNombreEnfermedadRep($("#nombreVacuna"));
        }

        setTimeout(function() {
        
            if ($(".errorValidacion").length > 0) {

                e.stopPropagation();
              
            } else {
                             
                $('#formNuevaVacuna').submit();
              
            }
        }, 1000);

    });

    //F - Nueva vacuna

    //I - Modificacion vacuna

    tablaVacunas.on("click", ".btnModVacuna", function(){

        $('.errorValidacion').remove();

        var idVacuna = $(this).parent().parent().find("td:first-child").text();
        var nombreVacuna =$(this).parent().parent().children("td:nth-child(2)").text();

        $('#idVacuna').val(idVacuna);
        $('#modNombreVacuna').val(nombreVacuna);

    });

    $('#btnEnviarModVacuna').click(function(e){

        $('.errorValidacion').remove();

        comprobarObligatorios($(".modObligatorio"));

        if($('#modNombreVacuna').val()!=""){
            comprobarNombreVacunaRep($("#modNombreVacuna"));
           
        }

        setTimeout(function() {
        
            if ($(".errorValidacion").length > 0) {
               
                e.stopPropagation();
                             
            } else {
            
              $('#formModVacuna').submit();
              
            }
        }, 1000);

    });

     //F - Modificacion Vacuna

      //I- Eliminacion Vacuna 

     tablaVacunas.on("click", ".btnEliminarVacuna", function(){

        var id = $(this).parent().parent().children("td:first-child").text();
        var fila = $(this).parent().parent();


        $.ajax({
            type: "POST",
            url: "../app/Ajax/envatraAjax.php",
            cache: false,
            data: {
                idVacunaDelete: id
            },
            success: function() {
                   $(fila).remove();
                   $('#mensEliminado').prop("hidden", false);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });

    });

    //F- Eliminacion enfermedad 

    //*********************************************FIN*******ENFERMEDADES**************************************************************
    //************************************************************************************************************************************
    //************************************************************************************************************************************
});