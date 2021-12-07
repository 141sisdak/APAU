$(function(){

    // I - Datatable

    var tablaRefugio = $("#tablaRefugios").DataTable({
      
        dom:"<'row filtrosRefugio'<'col-sm-12 col-md-2 'l>>" +
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
                "url":"../app/Ajax/refugiosAjax.php",
                "dataSrc": ""
            
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
                  "defaultContent":'<button type="button" class="btn_icono_tabla btnModRefugio" data-toggle="modal"  data-target="#modficarRefugio"><img src="../web/css/imagenes/icono_modificar_tabla.png"/></button>',
                  "orderable":false
                },
                {
                    "targets": -1,
                    "data":null,
                    "defaultContent":'<button type="button" class="btn_icono_tabla btnEliminarRegistro refugios" ><img src="../web/css/imagenes/icono_borrar_tabla.png"/></button>',
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

  

        $('#busquedaRefugio').on('keyup change clear', function() {
            tablaRefugio.search(this.value).draw();
           });
        

        // F - Datatable
       


   $('#enviarNuevoRefugio').click(function(e){

  $(".errorValidacion").remove();

    comprobarObligatorios($(".obligatorio"));

   comprobarNombreRefugioRep($("#nombreRefugio"));
   
    setTimeout(function() {
        
        if ($(".errorValidacion").length > 0) {
            e.stopPropagation();
           
          
        } else {
           
            e.stopPropagation();
            
            $('#formNuevoRefugio').submit();
          
        }
    }, 1000);
    

   });
  
   $('#btnNuevoRefugio').click(function(e){

    $(".errorValidacion").remove();

   });

tablaRefugio.on("click", ".btnModRefugio", function(e){

    var idRefugio = $(this).parent().parent().find("td:first-child").text();
    var nombreRefugio =$(this).parent().parent().children("td:nth-child(2)").text();

    $(".errorValidacion").remove();

    $('#modNombreRefugio').val(nombreRefugio);
    $('#idRefugio').val(idRefugio);
   

});

$('#btnEnviarModRefugio').click(function(e){

    $(".errorValidacion").remove();

    comprobarObligatorios($(".modObligatorio"));

    comprobarNombreRefugioRep($('#modNombreRefugio'));

    setTimeout(function() {
        
        if ($(".errorValidacion").length == 0) {
            console.log("SI se enviaria");
            $('#formModRefugio').submit();
          
        } else {
            console.log("NO se enviaria");
          
        }
    }, 1000);
    

});

tablaRefugio.on("click", ".btnEliminarRefugio", function() {
    
    var idRefugio = $(this).parent().parent().find("td:first-child").text();
    var fila = $(this).parent().parent();

    $.ajax({
        type: "POST",
        url: "../app/Ajax/refugiosAjax.php",
        cache: false,
        data: {
            idDelete: idRefugio
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

})



});