$(function(){

    // I - Datatable

    var tabla = $("#tablaDonaciones").DataTable({
      
        dom:"<'row filtrosDonaciones'<'col-sm-12 col-md-2 'l>>" +
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
                "url":"../app/Ajax/donacionesAjax.php",
                "dataSrc": ""
            
            },
            "columns":[
                {"data":"id"},
                {"data":"nombre"},
                {"data":"apellidos"},
                {"data":"importe"},
                {"data":"fecha"},
                null,
                null
            ],
            "columnDefs":[
                {
                  "targets": -2,
                  "data":null,
                  "defaultContent":"  <button type='button' class='btn_icono_tabla btnModficarDonacion' data-toggle='modal'  data-target='#modificarDonacion'><img src='../web/css/imagenes/icono_modificar_tabla.png'/></button>",
                  "orderable":false
                },
                {
                    "targets": -1,
                    "data":null,
                    "defaultContent":"  <button type='button' class='btn_icono_tabla btnEliminarRegistro donaciones'><img src='../web/css/imagenes/icono_borrar_tabla.png'/></button>",
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

   

        $('#fechaDesde, #fechaHasta').change( function() {
          
           tabla.draw();
        });

        $('#busquedaDonaciones').on('keyup change clear', function() {
            tabla.search(this.value).draw();
           });


    
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {

                if ( settings.nTable.id !== 'tablaDonaciones' ) {
                    return true;
                  }

                  var clt = window.location.search;
                  //Solo ejecutará si se encuentra en la pagina de donaciones
                  if(clt.indexOf("donaciones")>-1){
                    var min = new Date($("#fechaDesde").val()).getTime()-86400000;

                    var max = new Date($("#fechaHasta").val()).getTime();
                   
                    var fechaSpliteada = data[4].split("-");
                   
                    var fechaTabla = new Date(fechaSpliteada[2], (fechaSpliteada[1]-1),fechaSpliteada[0]).getTime();
    
                    if(isNaN(min) && isNaN(max) ||
                    isNaN(max) && min<=fechaTabla ||
                    isNaN(min) && max>=fechaTabla ||
                    min<=fechaTabla && max>=fechaTabla){
                        return true;
                    }
                }
             
                
                return false;
            }
        );

        // F - Datatable

       
    // I - Nueva Donacion
     $('#btnNuevaDonacion').click(function(){

      eliminarErrorresInputsForm($('#formNuevaDonacion'));

        $('#fecha').val("");

     });

     $('#enviarNuevaDonacion').click(function(){

        eliminarErrorresInputsForm($('#formNuevaDonacion'));

        

        comprobarObligatorios($(".obligatorio"));
        
         var inputs = $("#formNuevaDonacion").find("input");

         $(inputs).each(function(){

           if($(this).val().length>0){
            
            switch($(this).prop("id")){

                case "fecha":
                    validarFechaSuperior($(this)); 
                    break;
                case "importe":
                    validarDecimal($(this));
                    break;
                }
           }
         });

         if($('.errorValidacion').length==0){
            $('#formNuevaDonacion').submit();
        }

     });
     // F - Nueva Donacion


     // I - Modificacion Donacion
        tabla.on('click', '.btnModficarDonacion',function(){
            
            $('.errorValidacion').remove();

            var idDonacion = $(this).parent().parent().find("td:first").text();

            var modal = $(document).find("formModDonacion");

            $.ajax({
                type: "GET",
                url: "../app/Ajax/donacionesAjax.php",
                dataType: 'json',
                cache: false,
                data: {
                    idDonacionMod: idDonacion
                },
                success: function(response) {
                    if (response) {
                        $(modal).find($("#idDonacionMod").val(response.id));
                        $(modal).find($("#nombreDonacionMod").val(response.nombre));
                        $(modal).find($("#apellidosDonacionMod").val(response.apellidos));
                        $(modal).find($("#fechaDonacionMod").val(response.fecha));
                        $(modal).find($("#importeDonacionMod").val(response.importe));
                    }
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + errorThrown);
                    console.warn(jqXHR.responseText);
                }
            });
       

          

        });

        $('#btnEnviarModDonacion').click(function(){

            $(".errorValidacion").remove();

            comprobarObligatorios($(".obligatorioMod"));
        
            var inputs = $("#formModDonacion").find("input");
   
            $(inputs).each(function(){
   
              if($(this).val().length>0){
               
               switch($(this).prop("id")){
   
                   case "fechaDonacionMod":
                       validarFechaSuperior($(this)); 
                       break;
                   case "importeDonacionMod":
                       validarDecimal($(this));
                       break;
                   }
              }
            });
   
            if($('.errorValidacion').length==0){
               console.log($("#fechaDonacionMod").val());
               $('#formModDonacion').submit();
           }

        })

        
     // F - Modificacion Donacion
     

     

});