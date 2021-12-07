$(function(){


// I - Datatable

 var tablaGastos = $("#tablaGeneralGastos").DataTable({
      
    dom:"<'row filtrosOldGastos'<'col-sm-12 col-md-2 'l>>" +
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
            "url":"../app/Ajax/gastosAjax.php",
            "dataSrc": ""
        
        },
        "order":[[1,"asc"]],
        "initComplete": function( settings, json ) {
            //I - Setear colores pagados/no pagados

            $("#tablaGeneralGastos tbody").children().each(function(){

                
     
                if($(this).find("td:nth-child(2)").text()=="0"){
                   
                    
                    $(this).css("color","red");
                   
                }else{
                    $(this).css("color","green");
                    $(this).find("button:last").prop("disabled", true);
                }
                
            });
            //F - Setear colores pagados/no pagados

            //I - Evento pagar
    $('.btnPagarGasto').click(function(){
       

        $('#modalMensajes').find(".mensaje").remove();

         var pagado = $(this).parent().parent().find("td:nth-child(2)").text();
         var idGasto = $(this).parent().parent().find("td:first").text();
         var btnPagado =$(this);
         var fila = $(this).parent().parent();
         if(pagado == "0"){

            $.ajax({
                type: "POST",
                url: "../app/Ajax/gastosAjax.php",
                cache: false,
                data: {
                    pagarGasto: idGasto
                },
                success: function(respuesta) {
                   if(respuesta){
                    $(btnPagado).prop("disabled", true);
                    $(fila).css("color", "green");
                    $("#modalMensajes").find(".cab-item-filtros").text("¡Gasto saldado!");
                    $('#modalMensajes').modal("show")
                   
                   }
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + errorThrown);
                    console.log(textStatus);
                    console.warn(jqXHR.responseText);
                }
            });
            
         }
       
    });
    
//F - Evento pagar

            $("input:checkbox[name=pagado]").on("change", function(){

                var pagados = $('input:checkbox[name=pagado]:checked').map(function(){
                   
                    return  this.value;
                    
                  }).get().join('|');
             
                  tablaGastos.column(1).search(pagados,true,false,false).draw();
        
            });
          },
        "columns":[
            {"data":"id"},
            {"data":"pagado"},
            {"data":"usuario"},
            {"data":"concepto"},
            {"data":"importe"},
           
            null,
            null
        ],
        
        "columnDefs":[
            {width: 200, targets: 0},
            {
              "targets": -2,
              "data":null,
              "defaultContent":'<button type="button" class="btn_icono_tabla" data-toggle="modal"  data-target="#verComentario"><img src="../web/css/imagenes/icono_comentario.png"/></button>',
              "orderable":false
            },
            {
                "targets": -1,
                "data":null,
                "defaultContent":'<button type="button" class="btn_icono_tabla btnPagarGasto" ><img src="../web/css/imagenes/icono_pagar.png"/></button>',
                "orderable":false
            },
            {
                "targets":0,
                "data":"id",
                "searchable": false,
                "className":"idOculto"
            },
            {
                "targets":1,
                "data":"pagado",               
                "className":"idOculto"
            },

            ]
          
});

$('#busquedaGastos').on('keyup change', function(){
    tablaGastos.search($(this).val()).draw() ;
});

// F - Datatable




//I - Modal Comentario
    $('#verComentario').on('show.bs.modal', function (e){

   var idGasto = $(e.relatedTarget).parent().parent().find("td:first").text();

  $(".comGasto").remove();

    $.ajax({
        type: "GET",
        url: "../app/Ajax/gastosAjax.php",
        cache: false,
        dataType: "json",
        data: {
            getGasto: idGasto
        },
        success: function(respuesta) {
            $('#verComentario').find(".modal-body").prepend(
                $("<p>",{
                    "text":respuesta[0].comentario,
                    "class":"comGasto"
                })
            )
             
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });
});

//F - Modal Comentario

//I - Evento pagar
    $('.btnPagarGasto').click(function(){

         var pagado = $(this).parent().parent().find("td:nth-child(2)").text();
         var idGasto = $(this).parent().parent().find("td:first").text();

         if(pagado == "0"){

            $.ajax({
                type: "POST",
                url: "../app/Ajax/gastosAjax.php",
                cache: false,
                data: {
                    pagarGasto: idGasto
                },
                success: function(respuesta) {
                   if(respuesta){
                   console.log('alskdjf');
                   
                   }
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + errorThrown);
                    console.log(textStatus);
                    console.warn(jqXHR.responseText);
                }
            });
         }
    });
    
//F - Evento pagar

//I - Nuevo gasto

$('#enviarNuevoGasto').click(function(){
   

    eliminarErrorresInputsForm($("#formNuevoGasto"));

    comprobarObligatorios($("#formNuevoGasto .obligatorio"));
    
    validarDecimal($("#importe"));
    console.log($(".errorValidacion"));
    if($(".errorValidacion").length==0){
        $('#formNuevoGasto').submit();
    }
});

$('#btnNuevoGasto').click(function(){

    $(".errorValidacion").remove();
    $('#importe').val("");

});

//F - Nuevo gasto

//Evento del boton OK de la ventana modal de mensaje
$('.btnOkMensaje').click(function(){
    $("#modalMensajes").modal("hide");
    window.location.href = "index.php?ctl=gastos";
 });

 var tablaGastosUsuario = $("#tablaGastosUsuario").DataTable({
      
    dom:"<'row filtrosOldGastos'<'col-sm-12 col-md-2 '>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
  
  
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
    }
});

 //I-  PANEL DE CONTROL********************************************************************************
 //****************************************************************************************************

// I - Datatable

var tablaGastosPc = $("#tablaGeneralGastosMod").DataTable({
      
    dom:"<'row filtrosGastosPc'<'col-sm-12 col-md-2 'l>>" +
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
            "url":"../app/Ajax/gastosAjax.php",
            "dataSrc": ""
        
        },
        "order":[[1,"asc"]],
        "initComplete": function( settings, json ) {

         
            //I - Setear colores pagados/no pagados
            $("#tablaGeneralGastosMod tbody").children().each(function(){
     
                if($(this).find("td:nth-child(2)").text()=="0"){
                    $(this).find("button:last").prop("disabled", true);
                    $(this).css("color","red");
                   
                }else{
                    $(this).css("color","green");
                  
                }
                
            });

            //F - Setear colores pagados/no pagados

            $("input:checkbox[name=pagadoPc]").on("change", function(){

                var pagados = $('input:checkbox[name=pagadoPc]:checked').map(function(){
                   
                    return  "^" +this.value + "$";
                    
                  }).get().join('|');
             
                  tablaGastosPc.column(1).search(pagados,true,false,false).draw();
        
            });
          },
        "columns":[
            {"data":"id"},
            {"data":"pagado"},
            {"data":"usuario"},
            {"data":"concepto"},
            {"data":"importe"},
            null,
            null,
            null
        ],
        "columnDefs":[
            {
              "targets": -3,
              "data":null,
              "defaultContent":'<button type="button" class="btn_icono_tabla btnModGastoPc" data-toggle="modal"  data-target="#modficarGasto"><img src="../web/css/imagenes/icono_modificar_tabla.png"/></button>',
              "orderable":false
            },
            {
                "targets": -2,
                "data":null,
                "defaultContent":'<button type="button" class="btn_icono_tabla btnEliminarRegistro gastos"><img src="../web/css/imagenes/icono_borrar_tabla.png"/></button>',
                "orderable":false
            },
            {
                "targets": -1,
                "data":null,
                "defaultContent":'<button type="button" class="btn_icono_tabla btnDeshacerPagado"><img src="../web/css/imagenes/icono_deshacerPago.png"/></button>',
                "orderable":false
            },
            {
                "targets":0,
                "data":"id",
                "searchable": false,
                "className":"idOculto"
            },
            {
                "targets":1,
                "data":"pagado",               
                "className":"idOculto"
            },

            ]
          
});
  
    $('#busquedaGastosPc').on('keyup change', function(){
        tablaGastosPc.search($(this).val()).draw() ;
  });
// F - Datatable

 //I - Modificar gasto 

$('#btnEnviarModGasto').click(function(){

    $(".errorValidacion").remove();

    comprobarObligatorios($(".obligatorioMod"));
    if($("#importeMod").val()!=""){
        validarDecimal($("#importeMod"));
    }

    if($(".errorValidacion").length==0){
        console.log('alsdjkf');
      $('#formModGasto').submit();
      
    }else{
       
    }
});

tablaGastosPc.on("click", ".btnModGastoPc", function(){

    $(".errorValidacion").remove();

    var id = $(this).parent().parent().find("td:first-child").text();
    
    var modal = $(document).find("#formModGasto");

    $.ajax({
        type: "get",
        url: "../app/Ajax/gastosAjax.php",
        dataType: 'json',
        cache: false,
        data: {
            idGastoMod: id
        },
        success: function(response) {
            if (response) {
                $(modal).find($("#idGastoMod").val(id));
                $(modal).find($("#selUsu").val(response.usuario));
                $(modal).find($("#importeMod").val(response.importe));
                $(modal).find($("#comentarioMod").val(response.comentario));
                $(modal).find($("#conceptoMod").val(response.concepto));
                

            }
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });
});

//F - Modificar gasto

//I - Eliminar gasto

   tablaGastosPc.on("click", ".btnEliminarGasto", function(){

        var id = $(this).parent().parent().find("td:first-child").text();
        var fila = $(this).parent().parent();

        $.ajax({
            type: "POST",
            url: "../app/Ajax/gastosAjax.php",
            dataType: 'json',
            cache: false,
            data: {
                idGastoDelete: id
            },
            success: function(response) {
                if (response) {
                    $(fila).remove();
                    $("#modalMensajesGastosMod").find(".modal-body").append(
                        $("<p>",{
                            "text":"¡Pago eliminado!",
                            "class":"mensaje"
                        })
                    )
                    $("#modalMensajesGastosMod").modal("show");
                }
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });

    });

//F - Eliminar gasto


//I - Deshacer pagado

tablaGastosPc.on("click", ".btnDeshacerPagado", function(){

    var id = $(this).parent().parent().find("td:first-child").text();

   

    $('#modalMensajesGastosMod').find(".mensaje").remove();

    $.ajax({
        type: "POST",
        url: "../app/Ajax/gastosAjax.php",
        dataType: 'json',
        cache: false,
        data: {
            idGastoDesPago: id
        },
        success: function(response) {
            if (response) {
                
                $("#modalMensajesGastosMod").find(".modal-body").append(
                    $("<p>",{
                        "text":"¡Pago deshecho!",
                        "class":"mensaje"
                    })
                )
                $("#modalMensajesGastosMod").modal("show");
            }
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + errorThrown);
            console.warn(jqXHR.responseText);
        }
    });

});

$('#btnOkMensaje').click(function(){
    $("#modalMensajesGastosMod").modal("hide");
    window.location.href = "index.php?ctl=gastosPc";
 });



//F -  Deshacer pagado

 //F-  PANEL DE CONTROL********************************************************************************
 //****************************************************************************************************

});