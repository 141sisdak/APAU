$(function(){

     // I - Datatable

     var tablaSocios = $("#tablaSocios").DataTable({
      
        dom:"<'row filtrosSocios'<'col-sm-12 col-md-2 'l>>" +
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
                "url":"../app/Ajax/sociosAjax.php",
                "dataSrc": ""
            
            },
            "columns":[
                {"data":"id"},
                {"data":"nombre"},
                {"data":"apellidos"},
                {"data":"email"},
                {"data":"telefono"},
                {"data":"direccion"},
                {"data":"num_cuenta"},
                {"data":"aportacion"},
                {"data":"pago"},
                null,
                null
            ],
            "columnDefs":[
                {
                  "targets": -2,
                  "data":null,
                  "defaultContent":"  <button type='button' class='btn_icono_tabla btnModificarSocio' data-toggle='modal'  data-target='#modificarSocio'><img src='../web/css/imagenes/icono_modificar_tabla.png'/></button>",
                  "orderable":false
                },
                {
                    "targets": -1,
                    "data":null,
                    "defaultContent":"  <button type='button' class='btn_icono_tabla btnEliminarRegistro socios'><img src='../web/css/imagenes/icono_borrar_tabla.png'/></button>",
                    "orderable":false
                },
                {
                    "targets":0,
                    "data":"id",
                    "searchable": false,
                    "className":"idOculto"
                },
                {
                    "targets":[3,4,5,6,8],
                    "orderable":false
                }
                    
           
                ]
    });


   

        $('#selPagosTabla').on('change', function () {
            tablaSocios.columns(8).search( this.value ).draw();
        } );

        $('#busquedaSocios').on('keyup change clear', function() {
            tablaSocios.search(this.value).draw();
           });

      

        // F - Datatable

    $('#btnNuevoSocio').click(function(e){

        

        $(".errorValidacion").remove();

    });


    $('#enviarNuevoSocio').click(function(e){

        eliminarErrorresInputsForm($('#formNuevoSocio'))      

        comprobarObligatorios($("#formNuevoSocio .obligatorio"));

        if($('#selPago').val()==null){
            $('#selPago').css("border", "1px solid #FD7A7C")
            insertarTextoError($('#selPago'), "Debes selecciona un tipo de pago");
        }

       $('#selPago').change(function(){
           $(this).css("border", "1px solid #CCC");
           $(this).next().remove();

       });

        
         var inputs = $("#formNuevoSocio").find("input");

         $(inputs).each(function(){

           if($(this).val().length>0){
            
            switch($(this).prop("id")){

                case "emailSocio":
                    validarEmail($(this));
                    break;
                case "telefonoSocio":
                    validarTelf($(this));
                    break;
                case "num_cuentaSocio":
                    validarNumCuenta($(this));
                    break;
                case "aportacionSocio":
                 
                    validarDecimal($(this));
                    break;
                }
           }
         });

         if($(".errorValidacion").length==0){
           $('#formNuevoSocio').submit();
        }
    });


    tablaSocios.on('click', '.btnModificarSocio', function(){

        var idSocio = $(this).parent().parent().find("td:first").text();

        var modal = $(document).find("#formModSocio");

        $.ajax({
            type: "get",
            url: "../app/Ajax/sociosAjax.php",
            dataType: 'json',
            cache: false,
            data: {
                idSocioMod: idSocio
            },
            success: function(response) {
                if (response) {
                    $(modal).find($("#idSocio").val(response.id));
                    $(modal).find($("#nombreSocioMod").val(response.nombre));
                    $(modal).find($("#apellidosSocioMod").val(response.apellidos));
                    $(modal).find($("#emailSocioMod").val(response.email));
                    $(modal).find($("#telefonoSocioMod").val(response.telefono));
                    $(modal).find($("#direccionSocioMod").val(response.direccion));
                    $(modal).find($("#num_cuentaSocioMod").val(response.num_cuenta));
                    $(modal).find($("#aportacionSocioMod").val(response.aportacion));
                    $(modal).find($("#selPagoMod").val(response.pago));
                }
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (console && console.log) {
                console.log("La solicitud a fallado: " + errorThrown);
                console.warn(jqXHR.responseText);
            }
        });

    });

    $('#btnEnviarModSocio').click(function(){

        $(".errorValidacion").remove();       

        comprobarObligatorios($(".obligatorioMod"));

        var inputs = $("#formModSocio").find("input");

        $(inputs).each(function(){

          if($(this).val().length>0){
           
           switch($(this).prop("id")){

               case "emailSocioMod":
                   validarEmail($(this));
                   break;
               case "telefonoSocioMod":
                validarTelf($(this));
                   break;
               case "num_cuentaSocioMod":
                   validarNumCuenta($(this));
                   break;
               case "aportacionSocioMod":
                
                   validarDecimal($(this));
                   break;
               }
          }
        });

        if($(".errorValidacion").length==0){
           
            $('#formModSocio').submit();
         }
    });

    tablaSocios.on('click', '.btnEliminarSocio', function(){

      var idSocio = $(this).parent().parent().find("td:first").text();

      var fila = $(this).parent().parent().index();

      localStorage.setItem("idSocio", idSocio);

      localStorage.setItem("fila", fila)

     

      $('#modal_confirmacion').modal("show");

     

    });




});